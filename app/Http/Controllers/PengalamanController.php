<?php

namespace App\Http\Controllers;

use App\Models\Pengalaman;

class PengalamanController extends Controller
{
    public function index()
    {
        $pengalamans = Pengalaman::aktif()->paginate(12);
        $kategori    = Pengalaman::select('kategori')->distinct()->pluck('kategori');
        $profile     = \App\Models\Profile::first();

        return view('pengalaman', compact('pengalamans', 'kategori', 'profile'));
    }

    public function show(Pengalaman $pengalaman)
    {
        abort_if(!$pengalaman->aktif, 404);
        $profile = \App\Models\Profile::first();
        return view('pengalaman-detail', compact('pengalaman', 'profile'));
    }
}
