@extends('layouts.admin')
@section('title', $publikasi->exists ? 'Edit Publikasi' : 'Tambah Publikasi')
@section('content')
<div class="admin-page-header">
    <h1>{{ $publikasi->exists ? 'Edit Publikasi' : 'Tambah Publikasi' }}</h1>
    <a href="{{ route('admin.publikasi.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="admin-form-card" style="max-width:860px;">
    <form action="{{ $publikasi->exists ? route('admin.publikasi.update', $publikasi) : route('admin.publikasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($publikasi->exists) @method('PUT') @endif
        <div class="form-group">
            <label class="form-label">Judul Publikasi <span>*</span></label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $publikasi->judul) }}" required>
            @error('judul')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Kategori <span>*</span></label>
                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                    <option value="">Pilih Kategori...</option>
                    @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ old('kategori', $publikasi->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
                @error('kategori')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Penulis</label>
                <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $publikasi->penulis) }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Terbit</label>
            <input type="date" name="tanggal_terbit" class="form-control" value="{{ old('tanggal_terbit', $publikasi->tanggal_terbit ? $publikasi->tanggal_terbit->format('Y-m-d') : date('Y-m-d')) }}">
        </div>
        <div class="form-group">
            <label class="form-label">Deskripsi Singkat</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $publikasi->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Konten Lengkap</label>
            <textarea name="konten" class="form-control" rows="8">{{ old('konten', $publikasi->konten) }}</textarea>
            <small style="color:#718096;">Mendukung format HTML atau teks panjang.</small>
        </div>
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Gambar Sampul</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" data-preview="prevGambar">
                @if($publikasi->gambar)
                <img id="prevGambar" src="{{ Storage::url($publikasi->gambar) }}" class="img-preview" style="max-height: 150px; margin-top: 10px;">
                @else
                <img id="prevGambar" class="img-preview" style="display:none; max-height: 150px; margin-top: 10px;">
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">File Dokumen (PDF, doc, docx)</label>
                <input type="file" name="file_upload" class="form-control" accept=".pdf,.doc,.docx">
                @if($publikasi->file_url)
                <small style="color:#38a169;display:block;margin-top:5px;"><i class="fas fa-file"></i> File sudah diunggah — <a href="{{ Storage::url($publikasi->file_url) }}" target="_blank">Lihat File</a></small>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">URL Video (Opsional)</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $publikasi->video_url) }}" placeholder="https://youtube.com/...">
        </div>
        <div class="form-check">
            <input type="checkbox" name="unggulan" id="unggulan" value="1" {{ old('unggulan', $publikasi->unggulan) ? 'checked' : '' }}>
            <label for="unggulan">Jadikan Publikasi Unggulan</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $publikasi->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di website</label>
        </div>
        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
