@extends('layouts.admin')
@section('title', $slider->exists ? 'Edit Anggota Tim Admin' : 'Tambah Anggota Tim Admin')
@section('content')

<div class="admin-page-header">
    <h1>{{ $slider->exists ? 'Edit Anggota Tim Admin' : 'Tambah Anggota Tim Admin' }}</h1>
    <a href="{{ route('admin.galeri-slider.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="admin-form-card" style="max-width:760px;">
    <form action="{{ $slider->exists ? route('admin.galeri-slider.update', $slider) : route('admin.galeri-slider.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if($slider->exists) @method('PUT') @endif

        {{-- Foto --}}
        <div class="form-group">
            <label class="form-label">Foto <span>*</span></label>
            <input type="file" name="foto" class="form-control" accept="image/*" data-preview="prevFoto"
                {{ $slider->exists ? '' : 'required' }}>
            @if($slider->foto)
            <div style="margin-top:10px;display:flex;align-items:center;gap:14px;">
                <img id="prevFoto" src="{{ Storage::url($slider->foto) }}"
                    style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #e2e8f0;">
                <span style="font-size:0.82rem;color:#64748b;">Foto saat ini. Upload baru untuk mengganti.</span>
            </div>
            @else
            <img id="prevFoto" class="img-preview"
                style="display:none;width:90px;height:90px;border-radius:50%;object-fit:cover;margin-top:10px;">
            @endif
            <small style="color:#64748b;display:block;margin-top:6px;">Rekomendasi: foto persegi (1:1). Maks 3MB.</small>
        </div>

        {{-- Nama & Jabatan --}}
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span>*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $slider->nama) }}" required placeholder="Contoh: Ahmad Fauzi, S.T.">
                @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan / Posisi</label>
                <input type="text" name="jabatan" class="form-control"
                    value="{{ old('jabatan', $slider->jabatan) }}" placeholder="Contoh: Koordinator Admin">
            </div>
        </div>

        {{-- Deskripsi & Urutan --}}
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Deskripsi / Bio Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="3"
                    placeholder="Keterangan singkat...">{{ old('deskripsi', $slider->deskripsi) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control"
                    value="{{ old('urutan', $slider->urutan ?? 0) }}" min="0">
                <small style="color:#64748b;">Angka lebih kecil tampil lebih dulu.</small>
            </div>
        </div>

        {{-- Divider --}}
        <div style="border-top:1px solid #f1f5f9;margin:8px 0 20px;padding-top:20px;">
            <p style="font-weight:700;color:#0d2b5e;margin:0 0 16px;font-size:0.9rem;">
                <i class="fas fa-address-card" style="color:#1a6fc4;margin-right:6px;"></i>Kontak & Media Sosial
            </p>

            {{-- WA & Instagram --}}
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label"><i class="fab fa-whatsapp" style="color:#16a34a;"></i> WhatsApp</label>
                    <input type="text" name="wa" class="form-control"
                        value="{{ old('wa', $slider->wa) }}" placeholder="Contoh: 628123456789">
                    <small style="color:#64748b;">Format internasional tanpa + (62xxx)</small>
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fab fa-instagram" style="color:#db2777;"></i> Instagram</label>
                    <input type="url" name="instagram" class="form-control @error('instagram') is-invalid @enderror"
                        value="{{ old('instagram', $slider->instagram) }}" placeholder="https://instagram.com/...">
                    @error('instagram')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Facebook & LinkedIn --}}
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label"><i class="fab fa-facebook" style="color:#1d4ed8;"></i> Facebook</label>
                    <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror"
                        value="{{ old('facebook', $slider->facebook) }}" placeholder="https://facebook.com/...">
                    @error('facebook')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label"><i class="fab fa-linkedin" style="color:#0284c7;"></i> LinkedIn</label>
                    <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror"
                        value="{{ old('linkedin', $slider->linkedin) }}" placeholder="https://linkedin.com/in/...">
                    @error('linkedin')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="form-check" style="margin-bottom:8px;">
            <input type="checkbox" name="aktif" id="aktif" value="1"
                {{ old('aktif', $slider->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di halaman Kontak</label>
        </div>

        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>

@endsection
