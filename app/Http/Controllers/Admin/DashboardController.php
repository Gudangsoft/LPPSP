<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\Layanan;
use App\Models\Pengalaman;
use App\Models\Publikasi;
use App\Models\Testimoni;
use App\Models\KlienMitra;
use App\Models\GaleriSlider;
use App\Models\TimOrganisasi;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'layanans'     => Layanan::count(),
            'pengalamans'  => Pengalaman::count(),
            'testimonis'   => Testimoni::count(),
            'publikasis'   => Publikasi::count(),
            'klien_mitras' => KlienMitra::count(),
            'kontaks'      => Kontak::count(),
            'pesan_baru'   => Kontak::where('sudah_dibaca', false)->count(),
            'tim_organisasi'=> TimOrganisasi::count(),
            'tim_admin'    => GaleriSlider::count(),
        ];

        $pesan_terbaru   = Kontak::latest()->take(6)->get();
        $publikasi_terbaru = Publikasi::latest()->take(4)->get();
        $profile         = Profile::first();

        return view('admin.dashboard', compact('stats', 'pesan_terbaru', 'publikasi_terbaru', 'profile'));
    }
}
