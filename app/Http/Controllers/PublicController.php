<?php

namespace App\Http\Controllers;

use App\Models\Divisi;

class PublicController extends Controller
{
    public function divisi()
    {
        $divisi = Divisi::withCount('mahasiswa')
            ->get()
            ->map(function($divisi) {
                $divisi->sisa = $divisi->kuota - $divisi->mahasiswa_count;
                $divisi->persentase = $divisi->kuota > 0 
                    ? ($divisi->mahasiswa_count / $divisi->kuota) * 100 
                    : 0;
                return $divisi;
            });
        
        return view('public.divisi', compact('divisi'));
    }

    public function informasi()
    {
        $divisi = Divisi::all();
        return view('public.informasi', compact('divisi'));
    }

    public function syarat()
    {
        return view('public.syarat');
    }

    public function alur()
    {
        return view('public.alur');
    }
}