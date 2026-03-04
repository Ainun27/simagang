<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index(Request $request)
{
    // ================================================
    // 1. OTOMATIS UPDATE STATUS SETIAP KALI DIAKSES
    // ================================================
    $this->autoUpdateStatus();
    
    // ================================================
    // 2. QUERY DASAR DENGAN RELASI
    // ================================================
    $query = Mahasiswa::with('divisi');
    
    // ================================================
    // 3. FILTER BERDASARKAN STATUS
    // ================================================
    if ($request->has('status') && $request->status != 'semua') {
        if ($request->status == 'aktif') {
            // MAHASISWA AKTIF: is_active = true DAN tanggal belum lewat
            $query->where('is_active', true)
                  ->where(function($q) {
                      $today = Carbon::today()->toDateString();
                      $q->whereNull('tanggal_selesai')
                        ->orWhere('tanggal_selesai', '>=', $today);
                  });
        } elseif ($request->status == 'nonaktif') {
            // MAHASISWA NONAKTIF: is_active = false ATAU tanggal sudah lewat
            $query->where(function($q) {
                $today = Carbon::today()->toDateString();
                $q->where('is_active', false)
                  ->orWhere(function($q2) use ($today) {
                      $q2->whereNotNull('tanggal_selesai')
                         ->where('tanggal_selesai', '<', $today);
                  });
            });
        } elseif ($request->status == 'selesai') {
            // SUDAH SELESAI MAGANG: tanggal sudah lewat
            $query->whereNotNull('tanggal_selesai')
                  ->where('tanggal_selesai', '<', Carbon::today()->toDateString());
        }
    }
    
    // ================================================
    // 4. SEARCH FUNCTIONALITY (FIXED FOR ENCRYPTED DATA)
    // ================================================
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('universitas', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
            
            // JIKA NIM TIDAK TERENKRIPSI, uncomment baris ini:
            // ->orWhere('nim', 'like', "%{$search}%");
            
            // NOTE: Jika NIM terenkripsi, search NIM tidak bisa dengan LIKE
            // Solusi: decrypt semua NIM lalu filter di collection (tidak efisien)
            // Atau: simpan juga versi plain NIM di kolom terpisah untuk search
        });
    }
    
    // ================================================
    // 5. SORTING - Urutkan berdasarkan yang masih aktif dulu
    // ================================================
    $query->orderByRaw("
        CASE 
            WHEN is_active = true AND (tanggal_selesai IS NULL OR tanggal_selesai >= CURDATE()) THEN 1
            WHEN is_active = false AND (tanggal_selesai IS NULL OR tanggal_selesai >= CURDATE()) THEN 2
            ELSE 3
        END
    ")->latest();
    
    $mahasiswa = $query->paginate(15);
    
    // ================================================
    // 6. STATISTIK MAHASISWA
    // ================================================
    $today = Carbon::today()->toDateString();
    
    // Total mahasiswa
    $totalMahasiswa = Mahasiswa::count();
    
    // Mahasiswa aktif (is_active = true AND tanggal belum lewat)
    $mahasiswaAktif = Mahasiswa::where('is_active', true)
        ->where(function($q) use ($today) {
            $q->whereNull('tanggal_selesai')
              ->orWhere('tanggal_selesai', '>=', $today);
        })->count();
    
    // Mahasiswa nonaktif (is_active = false OR tanggal sudah lewat)
    $mahasiswaNonaktif = Mahasiswa::where(function($q) use ($today) {
        $q->where('is_active', false)
          ->orWhere(function($q2) use ($today) {
              $q2->whereNotNull('tanggal_selesai')
                 ->where('tanggal_selesai', '<', $today);
          });
    })->count();
    
    // Mahasiswa yang sudah selesai (tanggal sudah lewat)
    $mahasiswaSelesai = Mahasiswa::whereNotNull('tanggal_selesai')
        ->where('tanggal_selesai', '<', $today)
        ->count();
    
    // Persentase
    $persentaseAktif = $totalMahasiswa > 0 ? round(($mahasiswaAktif / $totalMahasiswa) * 100) : 0;
    $persentaseNonaktif = $totalMahasiswa > 0 ? round(($mahasiswaNonaktif / $totalMahasiswa) * 100) : 0;
    
    return view('admin.mahasiswa.index', compact(
        'mahasiswa',
        'totalMahasiswa',
        'mahasiswaAktif',
        'mahasiswaNonaktif',
        'mahasiswaSelesai',
        'persentaseAktif',
        'persentaseNonaktif'
    ));
}
    
    // ================================================
    // AUTO-UPDATE STATUS BERDASARKAN TANGGAL SELESAI
    // ================================================
    private function autoUpdateStatus()
    {
        $today = Carbon::today()->toDateString();
        
        // 1. NONAKTIFKAN yang tanggal selesai sudah lewat TAPI masih aktif
        Mahasiswa::where('is_active', true)
            ->whereNotNull('tanggal_selesai')
            ->whereDate('tanggal_selesai', '<', $today)
            ->update([
                'is_active' => false,
                'updated_at' => now()
            ]);
            
        // 2. AKTIFKAN KEMBALI yang tanggal selesai MASIH BERLAKU TAPI status nonaktif
        // (Kecuali jika admin sengaja nonaktifkan)
        Mahasiswa::where('is_active', false)
            ->whereNotNull('tanggal_selesai')
            ->whereDate('tanggal_selesai', '>=', $today)
            ->update([
                'is_active' => true,
                'updated_at' => now()
            ]);
    }
    
    // ================================================
    // BATCH UPDATE STATUS MANUAL
    // ================================================
    public function batchUpdateStatus()
    {
        $beforeActive = Mahasiswa::where('is_active', true)->count();
        $this->autoUpdateStatus();
        $afterActive = Mahasiswa::where('is_active', true)->count();
        
        $diff = $beforeActive - $afterActive;
        
        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 
                "Status telah disinkronisasi! {$diff} mahasiswa dinonaktifkan otomatis karena masa magang berakhir.");
    }

    // ================================================
    // CREATE - TAMPILKAN FORM TAMBAH
    // ================================================
    public function create()
    {
        $divisi = Divisi::all();
        return view('admin.mahasiswa.create', compact('divisi'));
    }

    // ================================================
    // STORE - SIMPAN DATA BARU (FIXED VERSION)
    // ================================================
    public function store(Request $request)
{
    $validated = $request->validate([
        'nim' => 'required|string|min:5|max:20|unique:mahasiswa,nim',
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:mahasiswa,email',
        'no_hp' => 'required|string|min:10|max:15',
        'universitas' => 'required|string|max:255',
        'divisi_id' => 'required|exists:divisi,id',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after:tanggal_mulai'
    ]);
    
    // CEK KUOTA DIVISI
    $divisi = Divisi::find($validated['divisi_id']);
    $terisi = $divisi->mahasiswa()->where('is_active', true)->count();
    
    if ($terisi >= $divisi->kuota) {
        return back()->withErrors([
            'divisi_id' => "Kuota divisi {$divisi->nama_divisi} sudah penuh! (Terisi: {$terisi}/{$divisi->kuota})"
        ])->withInput();
    }

    // SET STATUS OTOMATIS
    $today = Carbon::today();
    $tanggalSelesai = Carbon::parse($validated['tanggal_selesai']);
    $validated['is_active'] = $tanggalSelesai->greaterThanOrEqualTo($today);
    
    // SIMPAN (Enkripsi otomatis di Model jika ada)
    $mahasiswa = Mahasiswa::create($validated);
    
    return redirect()->route('admin.mahasiswa.index')
        ->with('success', "Mahasiswa {$validated['nama']} berhasil ditambahkan!");
}

    // ================================================
    // SHOW - TAMPILKAN DETAIL
    // ================================================
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('divisi');
        
        // Hitung masa magang untuk ditampilkan
        $masaMagang = null;
        if ($mahasiswa->tanggal_mulai && $mahasiswa->tanggal_selesai) {
            $mulai = Carbon::parse($mahasiswa->tanggal_mulai);
            $selesai = Carbon::parse($mahasiswa->tanggal_selesai);
            $masaMagang = $mulai->diffInDays($selesai);
        }
        
        return view('admin.mahasiswa.show', compact('mahasiswa', 'masaMagang'));
    }

    // ================================================
    // EDIT - TAMPILKAN FORM EDIT
    // ================================================
    public function edit(Mahasiswa $mahasiswa)
{
    $divisi = Divisi::all();
    
    // Hitung sisa kuota divisi - HANYA MAHASISWA AKTIF
    foreach ($divisi as $d) {
        $terisi = $d->mahasiswa()->where('is_active', true)->count();
        $d->terisi = $terisi;
        $d->sisa_kuota = $d->kuota - $terisi;
    }
        
        // Hitung masa magang untuk ditampilkan di form
        $masaMagang = null;
        if ($mahasiswa->tanggal_mulai && $mahasiswa->tanggal_selesai) {
            $mulai = Carbon::parse($mahasiswa->tanggal_mulai);
            $selesai = Carbon::parse($mahasiswa->tanggal_selesai);
            $masaMagang = $mulai->diffInDays($selesai);
        }
        
        return view('admin.mahasiswa.edit', compact('mahasiswa', 'divisi', 'masaMagang'));
    }

    // ================================================
    // UPDATE - UPDATE DATA
    // ================================================
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nim' => 'required|string|min:5|max:20|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email,' . $mahasiswa->id,
            'no_hp' => 'required|string|min:10|max:15',
            'universitas' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisi,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'is_active' => 'required|boolean'
        ]);

        // CEK KUOTA JIKA PINDAH DIVISI ATAU STATUS BERUBAH
        if (($mahasiswa->divisi_id != $validated['divisi_id'] || 
             $mahasiswa->is_active != $validated['is_active']) && 
            $validated['is_active'] == true) {
            
            $divisi = Divisi::find($validated['divisi_id']);
            $terisi = $divisi->mahasiswa()
                ->where('is_active', true)
                ->where('id', '!=', $mahasiswa->id)
                ->count();
            
            if ($terisi >= $divisi->kuota) {
                return back()->withErrors([
                    'divisi_id' => "Kuota divisi {$divisi->nama_divisi} sudah penuh! (Terisi: {$terisi}/{$divisi->kuota})"
                ])->withInput();
            }
        }

        // VALIDASI LOGIKA STATUS vs TANGGAL
        $today = Carbon::today();
        $tanggalSelesai = Carbon::parse($validated['tanggal_selesai']);
        
        if ($validated['is_active'] == true && $tanggalSelesai->lessThan($today)) {
            return back()->withErrors([
                'is_active' => "Tidak bisa mengaktifkan karena tanggal selesai ({$validated['tanggal_selesai']}) sudah lewat. Perpanjang tanggal selesai terlebih dahulu."
            ])->withInput();
        }
        
        if ($validated['is_active'] == false && $tanggalSelesai->greaterThanOrEqualTo($today)) {
            $request->session()->flash('warning', 
                "PERHATIAN: Anda menonaktifkan mahasiswa meskipun tanggal selesai masih berlaku. Ini adalah override manual.");
        }

        // UPDATE DATA
        $mahasiswa->update($validated);
        
        // HITUNG ULANG MASA MAGANG
        $mulai = Carbon::parse($validated['tanggal_mulai']);
        $selesai = Carbon::parse($validated['tanggal_selesai']);
        $masaMagangHari = $mulai->diffInDays($selesai);
        $masaMagangText = $this->formatMasaMagang($masaMagangHari);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 
                "Data mahasiswa {$validated['nama']} berhasil diupdate! 
                Tanggal Selesai: " . date('d M Y', strtotime($validated['tanggal_selesai'])) . "
                Masa magang: {$masaMagangText}. 
                Status: " . ($validated['is_active'] ? 'AKTIF' : 'NONAKTIF'));
    }

    // ================================================
    // DESTROY - HAPUS DATA
    // ================================================
    public function destroy(Mahasiswa $mahasiswa)
    {
        $nama = $mahasiswa->nama;
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', "Mahasiswa {$nama} berhasil dihapus!");
    }

    // ================================================
    // TOGGLE STATUS - ALTERNATIF DARI FORM
    // ================================================
    public function toggleStatus(Mahasiswa $mahasiswa)
    {
        $today = Carbon::today();
        
        // JIKA MAU AKTIFKAN TAPI TANGGAL SUDAH LEWAT
        if (!$mahasiswa->is_active && $mahasiswa->tanggal_selesai) {
            $tanggalSelesai = Carbon::parse($mahasiswa->tanggal_selesai);
            
            if ($tanggalSelesai->lessThan($today)) {
                return back()->with('error', 
                    "Tidak bisa mengaktifkan karena tanggal selesai ({$mahasiswa->tanggal_selesai}) sudah lewat. 
                    Edit data dan perpanjang tanggal selesai terlebih dahulu.");
            }
        }
        
        // TOGGLE STATUS
        $mahasiswa->is_active = !$mahasiswa->is_active;
        $mahasiswa->save();

        $status = $mahasiswa->is_active ? 'diaktifkan' : 'dinonaktifkan';
        $note = '';
        
        if (!$mahasiswa->is_active && $mahasiswa->tanggal_selesai) {
            $tanggalSelesai = Carbon::parse($mahasiswa->tanggal_selesai);
            if ($tanggalSelesai->greaterThanOrEqualTo($today)) {
                $note = ' (override manual - tanggal masih berlaku)';
            }
        }

        return back()->with('success', "Mahasiswa {$mahasiswa->nama} berhasil {$status}{$note}!");
    }
    
    // ================================================
    // HELPER METHOD: FORMAT MASA MAGANG
    // ================================================
    private function formatMasaMagang($hari)
    {
        if ($hari >= 365) {
            $tahun = floor($hari / 365);
            $sisaHari = $hari % 365;
            
            if ($sisaHari >= 30) {
                $bulan = floor($sisaHari / 30);
                return "{$tahun} tahun {$bulan} bulan";
            }
            return "{$tahun} tahun";
        }
        
        if ($hari >= 30) {
            $bulan = floor($hari / 30);
            $sisaHari = $hari % 30;
            
            if ($sisaHari > 0) {
                return "{$bulan} bulan {$sisaHari} hari";
            }
            return "{$bulan} bulan";
        }
        
        return "{$hari} hari";
    }
    
    // ================================================
    // METHOD UNTUK HITUNG MASA MAGANG AJAX
    // ================================================
    public function hitungMasaMagang(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai'
        ]);
        
        $mulai = Carbon::parse($request->tanggal_mulai);
        $selesai = Carbon::parse($request->tanggal_selesai);
        $hari = $mulai->diffInDays($selesai);
        
        $today = Carbon::today();
        $isActive = $selesai->greaterThanOrEqualTo($today);
        
        return response()->json([
            'success' => true,
            'masa_magang_hari' => $hari,
            'masa_magang_text' => $this->formatMasaMagang($hari),
            'status_otomatis' => $isActive ? 'AKTIF' : 'NONAKTIF',
            'status_warning' => $selesai->lessThan($today) ? 'Tanggal selesai sudah lewat!' : ''
        ]);
    }
}