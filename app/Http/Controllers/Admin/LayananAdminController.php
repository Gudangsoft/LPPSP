<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananAdminController extends Controller
{
    public function index()
    {
        $layanans = Layanan::orderBy('urutan')->get();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.form', ['layanan' => new Layanan]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:200',
            'ikon'      => 'nullable|string|max:100',
            'deskripsi' => 'required|string',
            'detail'    => 'nullable|string',
            'urutan'    => 'nullable|integer',
            'aktif'     => 'nullable|boolean',
            'gambar'    => 'nullable|image|max:2048',
        ]);
        $validated['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create($validated);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.form', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:200',
            'ikon'      => 'nullable|string|max:100',
            'deskripsi' => 'required|string',
            'detail'    => 'nullable|string',
            'urutan'    => 'nullable|integer',
            'aktif'     => 'nullable|boolean',
            'gambar'    => 'nullable|image|max:2048',
        ]);
        $validated['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar) Storage::disk('public')->delete($layanan->gambar);
            $validated['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->update($validated);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->gambar) Storage::disk('public')->delete($layanan->gambar);
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
