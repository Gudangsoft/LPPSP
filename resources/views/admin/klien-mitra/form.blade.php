@extends('layouts.admin')
@section('title', $klienMitra->exists ? 'Edit Klien & Mitra' : 'Tambah Klien & Mitra')
@section('content')
<div class="admin-page-header">
    <h1>{{ $klienMitra->exists ? 'Edit Klien & Mitra' : 'Tambah Klien & Mitra' }}</h1>
    <a href="{{ route('admin.klien-mitra.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="admin-form-card" style="max-width:760px;">
    <form action="{{ $klienMitra->exists ? route('admin.klien-mitra.update', $klienMitra) : route('admin.klien-mitra.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($klienMitra->exists) @method('PUT') @endif
        <div class="form-group">
            <label class="form-label">Nama Klien / Mitra <span>*</span></label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $klienMitra->nama) }}" required>
            @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Kategori <span>*</span></label>
                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                    <option value="">Pilih Kategori...</option>
                    @foreach($kategoriList as $kategori)
                    <option value="{{ $kategori }}" {{ old('kategori', $klienMitra->kategori) == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                    @endforeach
                </select>
                @error('kategori')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Website (opsional)</label>
                <input type="url" name="website" class="form-control" value="{{ old('website', $klienMitra->website) }}" placeholder="https://...">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Urutan</label>
            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $klienMitra->urutan ?? 0) }}" min="0">
        </div>
        <div class="form-group">
            <label class="form-label">Logo Klien</label>
            <input type="file" name="logo" class="form-control" accept="image/*" data-preview="prevLogo">
            @if($klienMitra->logo)
            <img id="prevLogo" src="{{ Storage::url($klienMitra->logo) }}" class="img-preview" style="max-height: 100px; margin-top: 10px; background:#f8fafc; padding:10px;">
            @else
            <img id="prevLogo" class="img-preview" style="display:none; max-height: 100px; margin-top: 10px; background:#f8fafc; padding:10px;">
            @endif
        </div>
        <div class="form-check">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $klienMitra->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di website</label>
        </div>
        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
