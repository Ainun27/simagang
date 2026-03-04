<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with('divisi');

        // Filter untuk tampilan tabel agar sinkron dengan yang ada di Blade
        if ($request->filled('divisi_id')) {
            $query->where('divisi_id', $request->divisi_id);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $mahasiswas = $query->paginate(10); 
        
        $total = Mahasiswa::count();
        $bulan_ini = Mahasiswa::whereMonth('created_at', date('m'))->count();
        $divisi = Divisi::all();
        
        $tahun_list = Mahasiswa::selectRaw('YEAR(created_at) as tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');

        return view('admin.laporan.index', compact(
            'mahasiswas', 
            'total', 
            'bulan_ini', 
            'divisi', 
            'tahun_list'
        ));
    }

    public function exportPage()
    {
        $divisi = Divisi::all();
        $tahun_list = Mahasiswa::selectRaw('YEAR(created_at) as tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');

        return view('admin.laporan.export_page', compact('divisi', 'tahun_list'));
    }

    public function exportPdf(Request $request)
    {
        // Gunakan query baru agar tidak tercampur dengan pagination
        $query = Mahasiswa::with('divisi');

        // Terapkan filter yang dikirim dari form export_page
        if ($request->filled('divisi_id')) {
            $query->where('divisi_id', $request->divisi_id);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $data = $query->get();

        // Pastikan view 'admin.laporan.pdf_template' sudah menggunakan variabel $data
        $pdf = Pdf::loadView('admin.laporan.pdf_template', compact('data'))
                  ->setPaper('a4', 'landscape'); // Landscape biar tabel lega
        
        return $pdf->download('Laporan_Mahasiswa_'.now()->format('d_m_Y').'.pdf');
    }

    public function exportExcel(Request $request)
    {
        // Pastikan di construct MahasiswaExport kamu sudah menangkap $request untuk memfilter
        return Excel::download(new MahasiswaExport($request), 'Laporan_Mahasiswa_'.now()->format('d_m_Y').'.xlsx');
    }
}