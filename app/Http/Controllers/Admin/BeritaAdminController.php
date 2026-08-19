<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaAdminController extends Controller
{
    private const KATEGORI = 'Berita Kegiatan';

    public function index(Request $request)
    {
        $q = $request->input('q');
        $berita = Publikasi::where('kategori', self::KATEGORI)
            ->when($q, fn($query) => $query->where('judul', 'like', "%{$q}%"))
            ->latest('tanggal_terbit')
            ->paginate(15)
            ->withQueryString();

        return view('admin.berita.index', compact('berita', 'q'));
    }

    public function create()
    {
        return view('admin.berita.form', [
            'publikasi' => new Publikasi,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:300',
            'deskripsi'      => 'nullable|string',
            'konten'         => 'nullable|string',
            'tanggal_terbit' => 'nullable|date',
            'video_url'      => 'nullable|url|max:300',
            'unggulan'       => 'nullable|boolean',
            'aktif'          => 'nullable|boolean',
            'gambar'         => 'nullable|image|max:4096',
            'galeri.*'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $validated['kategori']  = self::KATEGORI;
        $validated['unggulan']  = $request->boolean('unggulan');
        $validated['aktif']     = $request->boolean('aktif', true);
        $validated['slug']      = Str::slug($request->judul) . '-' . time();

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('publikasi/berita', 'public');
        }

        $galeri = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('publikasi/galeri', 'public');
            }
        }
        $validated['galeri'] = empty($galeri) ? null : $galeri;

        Publikasi::create($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Publikasi $berita)
    {
        return view('admin.berita.form', ['publikasi' => $berita]);
    }

    public function update(Request $request, Publikasi $berita)
    {
        $validated = $request->validate([
            'judul'          => 'required|string|max:300',
            'deskripsi'      => 'nullable|string',
            'konten'         => 'nullable|string',
            'tanggal_terbit' => 'nullable|date',
            'video_url'      => 'nullable|url|max:300',
            'unggulan'       => 'nullable|boolean',
            'aktif'          => 'nullable|boolean',
            'gambar'         => 'nullable|image|max:4096',
            'galeri.*'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'remove_galeri'  => 'nullable|array',
        ]);

        $validated['kategori'] = self::KATEGORI;
        $validated['unggulan'] = $request->boolean('unggulan');
        $validated['aktif']    = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar) Storage::disk('public')->delete($berita->gambar);
            $validated['gambar'] = $request->file('gambar')->store('publikasi/berita', 'public');
        }

        $galeri = is_array($berita->galeri) ? $berita->galeri : [];
        if ($request->has('remove_galeri')) {
            foreach ($request->input('remove_galeri') as $fileToRemove) {
                if (($key = array_search($fileToRemove, $galeri)) !== false) {
                    Storage::disk('public')->delete($fileToRemove);
                    unset($galeri[$key]);
                }
            }
            $galeri = array_values($galeri);
        }
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('publikasi/galeri', 'public');
            }
        }
        $validated['galeri'] = empty($galeri) ? null : $galeri;

        $berita->update($validated);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Publikasi $berita)
    {
        if ($berita->gambar) Storage::disk('public')->delete($berita->gambar);
        foreach ((is_array($berita->galeri) ? $berita->galeri : []) as $img) {
            Storage::disk('public')->delete($img);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
