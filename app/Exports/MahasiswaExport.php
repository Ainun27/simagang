<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request) {
        $this->request = $request;
    }

    public function query()
    {
        $query = Mahasiswa::query()->with('divisi');

        if ($this->request->filled('divisi_id')) $query->where('divisi_id', $this->request->divisi_id);
        if ($this->request->filled('status')) $query->where('is_active', $this->request->status);
        if ($this->request->filled('bulan')) $query->whereMonth('created_at', $this->request->bulan);
        if ($this->request->filled('tahun')) $query->whereYear('created_at', $this->request->tahun);

        return $query;
    }

    public function headings(): array {
        return ['NIM', 'Nama', 'Universitas', 'Divisi', 'Status', 'Tanggal Daftar'];
    }

    public function map($mhs): array {
        return [
            $mhs->nim,
            $mhs->nama,
            $mhs->universitas,
            $mhs->divisi->nama_divisi ?? '-',
            $mhs->is_active ? 'Aktif' : 'Tidak Aktif',
            $mhs->created_at->format('d-m-Y')
        ];
    }
}