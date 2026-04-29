<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pengalaman;

class PengalamanController extends Controller
{
    public function index()
    {
        $profile   = \App\Models\Profile::first();
        $layanans  = Layanan::where('aktif', true)->orderBy('urutan')->get();

        // Group active pengalaman by layanan_id for modal data
        $pengalamanByLayanan = Pengalaman::aktif()
            ->whereNotNull('layanan_id')
            ->orderByDesc('tahun')
            ->get()
            ->groupBy('layanan_id');

        // Pengalaman without layanan (ungrouped)
        $pengalamanLain = Pengalaman::aktif()
            ->whereNull('layanan_id')
            ->orderByDesc('tahun')
            ->get();

        return view('pengalaman', compact('profile', 'layanans', 'pengalamanByLayanan', 'pengalamanLain'));
    }

    public function show(Pengalaman $pengalaman)
    {
        abort_if(!$pengalaman->aktif, 404);
        $profile = \App\Models\Profile::first();
        return view('pengalaman-detail', compact('pengalaman', 'profile'));
    }
}
