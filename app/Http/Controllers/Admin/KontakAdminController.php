<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;

class KontakAdminController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::latest()->paginate(20);
        return view('admin.kontak.index', compact('kontaks'));
    }

    public function show(Kontak $kontak)
    {
        if (! $kontak->sudah_dibaca) {
            $kontak->update(['sudah_dibaca' => true, 'dibaca_pada' => now()]);
        }
        return view('admin.kontak.show', compact('kontak'));
    }

    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
