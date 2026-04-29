<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriSliderAdminController extends Controller
{
    public function index()
    {
        $sliders = GaleriSlider::orderBy('urutan')->orderBy('id')->get();
        return view('admin.galeri-slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.galeri-slider.form', ['slider' => new GaleriSlider]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:150',
            'jabatan'   => 'nullable|string|max:150',
            'judul'     => 'nullable|string|max:200',
            'deskripsi' => 'nullable|string',
            'foto'      => 'required|image|max:3072',
            'wa'        => 'nullable|string|max:20',
            'instagram' => 'nullable|url|max:300',
            'facebook'  => 'nullable|url|max:300',
            'linkedin'  => 'nullable|url|max:300',
            'urutan'    => 'nullable|integer|min:0',
            'aktif'     => 'nullable|boolean',
        ]);

        $validated['foto']   = $request->file('foto')->store('galeri-slider', 'public');
        $validated['aktif']  = $request->boolean('aktif', true);
        $validated['urutan'] = $request->input('urutan', 0);

        GaleriSlider::create($validated);
        return redirect()->route('admin.galeri-slider.index')->with('success', 'Foto slider berhasil ditambahkan.');
    }

    public function edit(GaleriSlider $galeriSlider)
    {
        return view('admin.galeri-slider.form', ['slider' => $galeriSlider]);
    }

    public function update(Request $request, GaleriSlider $galeriSlider)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:150',
            'jabatan'   => 'nullable|string|max:150',
            'judul'     => 'nullable|string|max:200',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|max:3072',
            'wa'        => 'nullable|string|max:20',
            'instagram' => 'nullable|url|max:300',
            'facebook'  => 'nullable|url|max:300',
            'linkedin'  => 'nullable|url|max:300',
            'urutan'    => 'nullable|integer|min:0',
            'aktif'     => 'nullable|boolean',
        ]);

        $validated['aktif']  = $request->boolean('aktif', true);
        $validated['urutan'] = $request->input('urutan', 0);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($galeriSlider->foto);
            $validated['foto'] = $request->file('foto')->store('galeri-slider', 'public');
        }

        $galeriSlider->update($validated);
        return redirect()->route('admin.galeri-slider.index')->with('success', 'Foto slider berhasil diperbarui.');
    }

    public function destroy(GaleriSlider $galeriSlider)
    {
        Storage::disk('public')->delete($galeriSlider->foto);
        $galeriSlider->delete();
        return redirect()->route('admin.galeri-slider.index')->with('success', 'Foto slider berhasil dihapus.');
    }
}
