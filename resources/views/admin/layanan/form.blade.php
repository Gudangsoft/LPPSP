@extends('layouts.admin')
@section('title', $layanan->exists ? 'Edit Layanan' : 'Tambah Layanan')
@section('content')
<div class="admin-page-header">
    <h1>{{ $layanan->exists ? 'Edit Layanan' : 'Tambah Layanan' }}</h1>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="admin-form-card" style="max-width:760px;">
    <form action="{{ $layanan->exists ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($layanan->exists) @method('PUT') @endif
        <div class="form-group">
            <label class="form-label">Judul Layanan <span>*</span></label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $layanan->judul) }}" required>
            @error('judul')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Ikon (FontAwesome class)</label>
                <input type="text" name="ikon" class="form-control" value="{{ old('ikon', $layanan->ikon) }}" placeholder="fa-search">
                <small style="color:#718096;font-size:.8rem;">Contoh: fa-search, fa-chart-bar, fa-users</small>
            </div>
            <div class="form-group">
                <label class="form-label">Urutan</label>
                <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $layanan->urutan ?? 0) }}" min="0">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Deskripsi <span>*</span></label>
            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
            @error('deskripsi')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label class="form-label">Detail (opsional)</label>
            <textarea name="detail" class="form-control" rows="5">{{ old('detail', $layanan->detail) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" data-preview="prevGambar">
            @if($layanan->gambar)
            <img id="prevGambar" src="{{ Storage::url($layanan->gambar) }}" class="img-preview">
            @else
            <img id="prevGambar" class="img-preview" style="display:none;">
            @endif
        </div>
        <div class="form-check">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $layanan->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di website</label>
        </div>
        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
