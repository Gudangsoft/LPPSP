<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KlienMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KlienMitraAdminController extends Controller
{
    private array $kategoriList = [
        'Kementerian/Lembaga',
        'Pemerintah Daerah',
        'OPD/Instansi Teknis',
        'Lembaga Pendidikan',
        'Dunia Usaha',
        'Lembaga Mitra',
    ];

    public function index()
    {
        $klienMitras  = KlienMitra::orderBy('urutan')->paginate(15);
        $kategoriList = $this->kategoriList;
        return view('admin.klien-mitra.index', compact('klienMitras', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = $this->kategoriList;
        return view('admin.klien-mitra.form', ['klienMitra' => new KlienMitra, 'kategoriList' => $kategoriList]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:200',
            'kategori'  => 'required|in:' . implode(',', $this->kategoriList),
            'website'   => 'nullable|url|max:200',
            'urutan'    => 'nullable|integer',
            'aktif'     => 'nullable|boolean',
            'logo'      => 'nullable|image|max:2048',
        ]);
        $validated['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('klien', 'public');
        }

        KlienMitra::create($validated);
        return redirect()->route('admin.klien-mitra.index')->with('success', 'Klien/Mitra berhasil ditambahkan.');
    }

    public function edit(KlienMitra $klienMitra)
    {
        $kategoriList = $this->kategoriList;
        return view('admin.klien-mitra.form', compact('klienMitra', 'kategoriList'));
    }

    public function update(Request $request, KlienMitra $klienMitra)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:200',
            'kategori'  => 'required|in:' . implode(',', $this->kategoriList),
            'website'   => 'nullable|url|max:200',
            'urutan'    => 'nullable|integer',
            'aktif'     => 'nullable|boolean',
            'logo'      => 'nullable|image|max:2048',
        ]);
        $validated['aktif'] = $request->boolean('aktif', true);

        if ($request->hasFile('logo')) {
            if ($klienMitra->logo) Storage::disk('public')->delete($klienMitra->logo);
            $validated['logo'] = $request->file('logo')->store('klien', 'public');
        }

        $klienMitra->update($validated);
        return redirect()->route('admin.klien-mitra.index')->with('success', 'Klien/Mitra berhasil diperbarui.');
    }

    public function destroy(KlienMitra $klienMitra)
    {
        if ($klienMitra->logo) Storage::disk('public')->delete($klienMitra->logo);
        $klienMitra->delete();
        return redirect()->route('admin.klien-mitra.index')->with('success', 'Klien/Mitra berhasil dihapus.');
    }
}
