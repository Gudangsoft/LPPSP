<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\TimOrganisasi;

class TentangKamiController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $tims = TimOrganisasi::aktif()->get()->groupBy('kelompok');
        return view('tentang-kami', compact('profile', 'tims'));
    }
}
