<?php

namespace App\Http\Controllers;

use App\Models\KlienMitra;
use App\Models\Pengalaman;

class KlienMitraController extends Controller
{
    public function index()
    {
        $klienMitras = KlienMitra::aktif()
            ->orderBy('urutan')
            ->orderBy('nama')
            ->paginate(9);

        // Load pengalaman for clients on current page (eager load layanan)
        $names = $klienMitras->pluck('nama');
        $pengalamanMap = Pengalaman::where('aktif', true)
            ->whereIn('klien', $names)
            ->with('layanan')
            ->orderByDesc('tahun')
            ->get()
            ->groupBy('klien');

        return view('klien-mitra', compact('klienMitras', 'pengalamanMap'));
    }
}
