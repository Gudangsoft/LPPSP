<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use App\Models\Profile;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    private const KATEGORI = 'Berita Kegiatan';

    public function index(Request $request)
    {
        $q       = $request->get('q');
        $query   = Publikasi::aktif()->where('kategori', self::KATEGORI);

        if ($q) {
            $query->where('judul', 'like', '%' . $q . '%');
        }

        $beritas = $query->paginate(9)->appends(['q' => $q]);
        $profile = Profile::first();

        return view('berita', compact('beritas', 'q', 'profile'));
    }

    public function show(Publikasi $berita)
    {
        abort_if(! $berita->aktif || $berita->kategori !== self::KATEGORI, 404);

        $related = Publikasi::aktif()
            ->where('kategori', self::KATEGORI)
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_terbit')
            ->take(3)
            ->get();

        return view('berita-detail', ['berita' => $berita, 'related' => $related]);
    }
}
