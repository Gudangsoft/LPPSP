<?php

namespace App\Http\Controllers;

use App\Models\GaleriSlider;
use App\Models\Kontak;
use App\Models\Profile;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $profile  = Profile::first();
        $sliders  = GaleriSlider::aktif()->get();
        return view('kontak', compact('profile', 'sliders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'subjek'  => 'required|string|max:200',
            'pesan'   => 'required|string|max:2000',
        ]);

        Kontak::create($validated);

        return redirect()->route('kontak')->with('success', 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
