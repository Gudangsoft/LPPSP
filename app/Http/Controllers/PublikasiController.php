<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        $kategori   = $request->get('kategori', 'semua');
        $query      = Publikasi::aktif();

        if ($kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        $publikasis = $query->paginate(9)->appends(['kategori' => $kategori]);

        return view('publikasi', compact('publikasis', 'kategori'));
    }

    public function show(Publikasi $publikasi)
    {
        abort_if(! $publikasi->aktif, 404);
        return view('publikasi-detail', compact('publikasi'));
    }
}
