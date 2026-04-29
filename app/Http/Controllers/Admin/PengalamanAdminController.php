<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\PengalamanTemplateExport;
use App\Imports\PengalamanImport;
use App\Models\KlienMitra;
use App\Models\Layanan;
use App\Models\Pengalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PengalamanAdminController extends Controller
{
    public function index(Request $request)
    {
        $q          = $request->input('q');
        $filterTahun   = $request->input('tahun');
        $filterLayanan = $request->input('layanan_id');

        $pengalamans = Pengalaman::with('layanan')
            ->when($q, fn($query) => $query->where(function($sub) use ($q) {
                $sub->where('judul', 'like', "%{$q}%")
                    ->orWhere('klien', 'like', "%{$q}%")
                    ->orWhere('lokasi', 'like', "%{$q}%")
                    ->orWhere('target_sasaran', 'like', "%{$q}%");
            }))
            ->when($filterTahun, fn($query) => $query->where('tahun', $filterTahun))
            ->when($filterLayanan, fn($query) => $query->where('layanan_id', $filterLayanan))
            ->orderByDesc('tahun')
            ->paginate(12)
            ->withQueryString();

        $layanans  = Layanan::orderBy('urutan')->get();
        $tahunList = Pengalaman::selectRaw('DISTINCT tahun')->orderByDesc('tahun')->pluck('tahun');

        return view('admin.pengalaman.index', compact('pengalamans', 'layanans', 'tahunList'));
    }

    public function create()
    {
        $layanans    = Layanan::orderBy('urutan')->get();
        $klienmitras = KlienMitra::orderBy('nama')->get();
        return view('admin.pengalaman.form', [
            'pengalaman'  => new Pengalaman,
            'layanans'    => $layanans,
            'klienmitras' => $klienmitras,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'layanan_id'     => 'nullable|exists:layanans,id',
            'judul'          => 'required|string|max:300',
            'klien'          => 'required|string|max:200',
            'target_sasaran' => 'nullable|string|max:300',
            'jenis_klien'    => 'nullable|string|max:100',
            'lokasi'         => 'nullable|string|max:200',
            'tahun'          => 'required|integer|min:1990|max:2100',
            'deskripsi'      => 'nullable|string',
            'unggulan'       => 'nullable|boolean',
            'aktif'          => 'nullable|boolean',
            'gambar'         => 'nullable|image|max:2048',
            'galeri.*'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);
        $validated['unggulan'] = $request->boolean('unggulan');
        $validated['aktif']    = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('pengalaman', 'public');
        }

        $galeri = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeri[] = $file->store('pengalaman/galeri', 'public');
            }
        }
        $validated['galeri'] = empty($galeri) ? null : $galeri;

        Pengalaman::create($validated);
        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function edit(Pengalaman $pengalaman)
    {
        $layanans    = Layanan::orderBy('urutan')->get();
        $klienmitras = KlienMitra::orderBy('nama')->get();
        return view('admin.pengalaman.form', compact('pengalaman', 'layanans', 'klienmitras'));
    }

    public function update(Request $request, Pengalaman $pengalaman)
    {
        $validated = $request->validate([
            'layanan_id'     => 'nullable|exists:layanans,id',
            'judul'          => 'required|string|max:300',
            'klien'          => 'required|string|max:200',
            'target_sasaran' => 'nullable|string|max:300',
            'jenis_klien'    => 'nullable|string|max:100',
            'lokasi'         => 'nullable|string|max:200',
            'tahun'          => 'required|integer|min:1990|max:2100',
            'deskripsi'      => 'nullable|string',
            'unggulan'       => 'nullable|boolean',
            'aktif'          => 'nullable|boolean',
            'gambar'         => 'nullable|image|max:2048',
            'galeri.*'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'remove_galeri'  => 'nullable|array',
        ]);
        $validated['unggulan'] = $request->boolean('unggulan');
        $validated['aktif']    = $request->boolean('aktif', true);

        if ($request->hasFile('gambar')) {
            if ($pengalaman->gambar) Storage::disk('public')->delete($pengalaman->gambar);
            $validated['gambar'] = $request->file('gambar')->store('pengalaman', 'public');
        }

        $galeri = is_array($pengalaman->galeri) ? $pengalaman->galeri : [];

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
                $galeri[] = $file->store('pengalaman/galeri', 'public');
            }
        }
        $validated['galeri'] = empty($galeri) ? null : $galeri;

        $pengalaman->update($validated);
        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function template()
    {
        return Excel::download(new PengalamanTemplateExport(), 'data-pengalaman-' . date('Ymd') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $import = new PengalamanImport();
        Excel::import($import, $request->file('file'));

        $errors = $import->errors();
        $count  = $import->importedCount;

        if ($errors->count() > 0) {
            $errorMessages = $errors->map(fn($e) => $e->getMessage())->implode(', ');
            return redirect()->route('admin.pengalaman.index')
                ->with('warning', "Import selesai: {$count} data berhasil diimport. Beberapa baris dilewati: {$errorMessages}");
        }

        return redirect()->route('admin.pengalaman.index')
            ->with('success', "{$count} data pengalaman berhasil diimport dari Excel.");
    }

    public function destroy(Pengalaman $pengalaman)
    {
        if ($pengalaman->gambar) Storage::disk('public')->delete($pengalaman->gambar);

        foreach ((is_array($pengalaman->galeri) ? $pengalaman->galeri : []) as $img) {
            Storage::disk('public')->delete($img);
        }

        $pengalaman->delete();
        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil dihapus.');
    }

    public function destroyBulk(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer|exists:pengalamans,id']);

        $pengalamans = Pengalaman::whereIn('id', $request->ids)->get();

        foreach ($pengalamans as $p) {
            if ($p->gambar) Storage::disk('public')->delete($p->gambar);
            foreach ((is_array($p->galeri) ? $p->galeri : []) as $img) {
                Storage::disk('public')->delete($img);
            }
            $p->delete();
        }

        return redirect()->route('admin.pengalaman.index')
            ->with('success', $pengalamans->count() . ' data pengalaman berhasil dihapus.');
    }
}
