<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::aktif()->paginate(9);
        return view('testimoni', compact('testimonis'));
    }
}
