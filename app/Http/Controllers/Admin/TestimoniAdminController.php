<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniAdminController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->paginate(15);
        return view('admin.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('admin.testimoni.form', ['testimoni' => new Testimoni]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:150',
            'jabatan'   => 'nullable|string|max:150',
            'instansi'  => 'nullable|string|max:200',
            'isi'       => 'nullable|string',
            'rating'    => 'required|integer|min:1|max:5',
            'unggulan'  => 'nullable|boolean',
            'aktif'     => 'nullable|boolean',
            'foto'      => 'nullable|image|max:1024',
            'video_url' => 'nullable|url|max:500',
        ]);
        $validated['unggulan'] = $request->boolean('unggulan');
        $validated['aktif']    = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        Testimoni::create($validated);
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.form', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:150',
            'jabatan'   => 'nullable|string|max:150',
            'instansi'  => 'nullable|string|max:200',
            'isi'       => 'nullable|string',
            'rating'    => 'required|integer|min:1|max:5',
            'unggulan'  => 'nullable|boolean',
            'aktif'     => 'nullable|boolean',
            'foto'      => 'nullable|image|max:1024',
            'video_url' => 'nullable|url|max:500',
        ]);
        $validated['unggulan'] = $request->boolean('unggulan');
        $validated['aktif']    = $request->boolean('aktif', true);

        if ($request->hasFile('foto')) {
            if ($testimoni->foto) Storage::disk('public')->delete($testimoni->foto);
            $validated['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        $testimoni->update($validated);
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto) Storage::disk('public')->delete($testimoni->foto);
        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
