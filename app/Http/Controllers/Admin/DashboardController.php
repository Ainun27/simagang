<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Mahasiswa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        // 1. Hitung dengan cara yang SAMA seperti di DivisiController
        $allDivisi = Divisi::all();
        
        $total_divisi = $allDivisi->count(); // Variable yang DIPERLUKAN oleh Blade
        $total_kuota = 0;
        $total_mahasiswa_aktif = 0;
        
        foreach ($allDivisi as $divisi) {
            // Hitung mahasiswa aktif dengan kriteria SAMA
            $mahasiswa_count = $divisi->mahasiswa()
                ->where('is_active', 1)
                ->where(function($q) use ($today) {
                    $q->whereNull('tanggal_selesai')
                      ->orWhere('tanggal_selesai', '>=', $today);
                })->count();
            
            // Simpan ke objek divisi
            $divisi->mahasiswa_count = $mahasiswa_count;
            $divisi->sisa = $divisi->kuota - $mahasiswa_count;
            $divisi->persentase = $divisi->kuota > 0 ? 
                ($mahasiswa_count / $divisi->kuota) * 100 : 0;
            
            // Akumulasi total
            $total_kuota += $divisi->kuota;
            $total_mahasiswa_aktif += $mahasiswa_count;
        }
        
        $sisa_kuota = $total_kuota - $total_mahasiswa_aktif;
        
        // 2. Filter divisi berdasarkan status kuota
        $divisi_hampir_penuh = $allDivisi->filter(function($divisi) {
            return $divisi->sisa > 0 && $divisi->sisa <= 2;
        });
        
        $divisi_penuh = $allDivisi->filter(function($divisi) {
            return $divisi->sisa == 0;
        });
        
        // 3. Untuk monitoring progress bar
        $divisi_list = $allDivisi;
        
        return view('admin.dashboard', compact(
            'total_divisi',    // DIPERLUKAN oleh Blade
            'total_kuota',     // DIPERLUKAN oleh Blade
            'sisa_kuota',      // DIPERLUKAN oleh Blade
            'total_mahasiswa_aktif',
            'divisi_list',
            'divisi_hampir_penuh',
            'divisi_penuh'
        ));
    }
}