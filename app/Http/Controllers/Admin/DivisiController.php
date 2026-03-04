<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DivisiController extends Controller
{
    // ================== INDEX ==================
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        $divisi = Divisi::with(['mahasiswa' => function($query) use ($today) {
            // Sama seperti di MahasiswaController
            $query->where('is_active', true)
                  ->where(function($q) use ($today) {
                      $q->whereNull('tanggal_selesai')
                        ->orWhere('tanggal_selesai', '>=', $today);
                  });
        }])->latest()->get();
        
        $totalKuota = 0;
        $totalMahasiswaAktif = 0;
        
        foreach ($divisi as $d) {
            // Hitung mahasiswa aktif untuk divisi ini
            $mahasiswaAktif = $d->mahasiswa->count();
            
            // Simpan ke properti objek
            $d->mahasiswa_aktif_count = $mahasiswaAktif;
            $d->sisa_kuota = $d->kuota - $mahasiswaAktif;
            
            // Hitung total
            $totalKuota += $d->kuota;
            $totalMahasiswaAktif += $mahasiswaAktif;
        }
        
        $totalSisaKuota = $totalKuota - $totalMahasiswaAktif;
        
        return view('admin.divisi.index', compact(
            'divisi', 
            'totalKuota', 
            'totalMahasiswaAktif', 
            'totalSisaKuota'
        ));
    }

    // ================== CREATE ==================
    public function create()
    {
        return view('admin.divisi.create');
    }

    // ================== STORE ==================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_divisi' => 'required|string|max:255|unique:divisi,nama_divisi',
            'deskripsi'   => 'required|string|min:20',
            'kuota'       => 'required|integer|min:1|max:50'
        ]);

        Divisi::create($validated);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil ditambahkan!');
    }

    // ================== SHOW ==================
    // DivisiController.php
public function show($id)
{
    $divisi = Divisi::with(['mahasiswa' => function($query) {
        $query->where('is_active', true); // Hanya mahasiswa aktif
    }])->findOrFail($id);
    
    return view('admin.divisi.show', compact('divisi'));
}

    // ================== EDIT ==================
    // DivisiController.php
public function edit($id)
{
    $divisi = Divisi::withCount(['mahasiswa' => function($query) {
        $query->where('is_active', true); // Hanya mahasiswa aktif
    }])->findOrFail($id);
    
    return view('admin.divisi.edit', compact('divisi'));
}

    // ================== UPDATE ==================
    public function update(Request $request, $id)
    {
        $divisi = Divisi::withCount('mahasiswa')->findOrFail($id);

        $validated = $request->validate([
            'nama_divisi' => 'required|string|max:255|unique:divisi,nama_divisi,' . $divisi->id,
            'deskripsi'   => 'required|string|min:20',
            'kuota'       => 'required|integer|min:1|max:50'
        ]);

        if ($validated['kuota'] < $divisi->mahasiswa_count) {
            return back()->withErrors([
                'kuota' => "Kuota tidak bisa dikurangi karena sudah ada {$divisi->mahasiswa_count} mahasiswa terdaftar!"
            ])->withInput();
        }

        $divisi->update($validated);

        return redirect()->route('admin.divisi.index')
            ->with('success', 'Divisi berhasil diupdate!');
    }

    // ================== DESTROY ==================
    public function destroy($id)
    {
        $divisi = Divisi::withCount('mahasiswa')->findOrFail($id);

        if ($divisi->mahasiswa_count > 0) {
            return back()->with('error', 'Tidak dapat menghapus divisi yang masih memiliki mahasiswa!');
        }

        $nama_divisi = $divisi->nama_divisi;
        $divisi->delete();

        return redirect()->route('admin.divisi.index')
            ->with('success', "Divisi {$nama_divisi} berhasil dihapus!");
    }
}