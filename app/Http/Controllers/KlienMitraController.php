<?php

namespace App\Http\Controllers;

use App\Models\KlienMitra;
use App\Models\Pengalaman;

class KlienMitraController extends Controller
{
    public function index()
    {
        $kategoriOrder = [
            'Kementerian/Lembaga',
            'Pemerintah Daerah',
            'OPD/Instansi Teknis',
            'Lembaga Pendidikan',
            'Dunia Usaha',
            'Lembaga Mitra',
        ];

        // All active clients grouped by kategori
        $allKlien = KlienMitra::aktif()->orderBy('urutan')->orderBy('nama')->get();
        $grouped  = $allKlien->groupBy('kategori');

        // All pengalaman for modal projects
        $pengalamanMap = Pengalaman::where('aktif', true)
            ->with('layanan')
            ->orderByDesc('tahun')
            ->get()
            ->groupBy('klien');

        return view('klien-mitra', compact('grouped', 'kategoriOrder', 'pengalamanMap'));
    }
}
