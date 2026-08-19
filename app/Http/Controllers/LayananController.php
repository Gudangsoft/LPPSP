<?php

namespace App\Http\Controllers;

use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::aktif()->get();
        $profile = \App\Models\Profile::first();
        return view('layanan', compact('layanans', 'profile'));
    }

    public function show(Layanan $layanan)
    {
        abort_if(! $layanan->aktif, 404);
        $profile = \App\Models\Profile::first();
        return view('layanan-detail', compact('layanan', 'profile'));
    }
}
