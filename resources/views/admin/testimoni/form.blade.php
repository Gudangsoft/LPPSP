@extends('layouts.admin')
@section('title', $testimoni->exists ? 'Edit Testimoni' : 'Tambah Testimoni')
@section('content')
<div class="admin-page-header">
    <h1>{{ $testimoni->exists ? 'Edit Testimoni' : 'Tambah Testimoni' }}</h1>
    <a href="{{ route('admin.testimoni.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="admin-form-card" style="max-width:760px;">
    <form action="{{ $testimoni->exists ? route('admin.testimoni.update', $testimoni) : route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($testimoni->exists) @method('PUT') @endif
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Nama <span>*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $testimoni->nama) }}" required>
                @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $testimoni->jabatan) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Instansi (Perusahaan / Organisasi)</label>
            <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $testimoni->instansi) }}">
        </div>
        <div class="form-group">
            <label class="form-label">Isi Testimoni</label>
            <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="4" placeholder="Tulis kutipan testimoni di sini... (opsional jika menggunakan video)">{{ old('isi', $testimoni->isi) }}</textarea>
            @error('isi')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label class="form-label"><i class="fab fa-youtube" style="color:#ff0000;margin-right:6px;"></i>Link Video YouTube <span style="font-weight:400;color:#64748b;font-size:0.85rem;">(opsional)</span></label>
            <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror"
                value="{{ old('video_url', $testimoni->video_url) }}"
                placeholder="https://www.youtube.com/watch?v=... atau https://youtu.be/...">
            @error('video_url')<span class="invalid-feedback">{{ $message }}</span>@enderror
            <small style="color:#64748b;margin-top:4px;display:block;">Jika diisi, video YouTube akan tampil di card testimoni. Teks testimoni tetap bisa ditampilkan bersama video.</small>
        </div>
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Rating (1-5) <span>*</span></label>
                <input type="number" name="rating" class="form-control" value="{{ old('rating', $testimoni->rating ?? 5) }}" min="1" max="5" required>
            </div>
            <div class="form-group">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*" data-preview="prevFoto">
                @if($testimoni->foto)
                <img id="prevFoto" src="{{ Storage::url($testimoni->foto) }}" class="img-preview" style="max-height: 100px; margin-top: 10px; border-radius: 50%;">
                @else
                <img id="prevFoto" class="img-preview" style="display:none; max-height: 100px; margin-top: 10px; border-radius: 50%;">
                @endif
            </div>
        </div>
        <div class="form-check">
            <input type="checkbox" name="unggulan" id="unggulan" value="1" {{ old('unggulan', $testimoni->unggulan) ? 'checked' : '' }}>
            <label for="unggulan">Jadikan Testimoni Unggulan</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $testimoni->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di website</label>
        </div>
        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
