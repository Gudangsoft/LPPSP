@extends('layouts.admin')
@section('title', $tim->exists ? 'Edit Anggota Tim' : 'Tambah Anggota Tim')
@section('content')
<div class="admin-page-header">
    <h1>{{ $tim->exists ? 'Edit Anggota Tim' : 'Tambah Anggota Tim' }}</h1>
    <a href="{{ route('admin.tim-organisasi.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="admin-form-card" style="max-width:820px;">
    <form action="{{ $tim->exists ? route('admin.tim-organisasi.update', $tim) : route('admin.tim-organisasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($tim->exists) @method('PUT') @endif

        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Kelompok Tim <span>*</span></label>
                <select name="kelompok" class="form-control @error('kelompok') is-invalid @enderror" required>
                    @foreach(['Tim Pembina','Tim Pengurus','Tim Tenaga Ahli'] as $k)
                    <option value="{{ $k }}" {{ old('kelompok', $tim->kelompok) === $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kelompok')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Urutan Tampil</label>
                <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $tim->urutan ?? 0) }}" min="0" placeholder="0">
                <small style="color:#64748b;">Angka lebih kecil tampil lebih dulu.</small>
            </div>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span>*</span></label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $tim->nama) }}" required>
                @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan / Posisi <span>*</span></label>
                <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $tim->jabatan) }}" required placeholder="Contoh: Ketua, Sekretaris, Ahli Kebijakan">
                @error('jabatan')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Bio / Riwayat Singkat</label>
            <textarea name="bio" class="form-control" rows="6" placeholder="Tuliskan riwayat, pengalaman, dan latar belakang anggota...">{{ old('bio', $tim->bio) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Bidang Keahlian</label>
            <textarea name="keahlian" class="form-control" rows="3" placeholder="Pisahkan dengan koma. Contoh: Perencanaan Daerah, Evaluasi Program, Good Governance">{{ old('keahlian', $tim->keahlian) }}</textarea>
            <small style="color:#64748b;margin-top:4px;display:block;">Ditampilkan sebagai tag/badge di profil anggota.</small>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Email (Opsional)</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $tim->email) }}" placeholder="nama@domain.com">
                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL (Opsional)</label>
                <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $tim->linkedin) }}" placeholder="https://linkedin.com/in/...">
                @error('linkedin')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/*" data-preview="prevFoto">
            @if($tim->foto)
            <div style="margin-top:10px;display:flex;align-items:center;gap:12px;">
                <img id="prevFoto" src="{{ Storage::url($tim->foto) }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #e2e8f0;">
                <span style="font-size:0.82rem;color:#64748b;">Foto saat ini. Upload baru untuk mengganti.</span>
            </div>
            @else
            <img id="prevFoto" class="img-preview" style="display:none;width:80px;height:80px;border-radius:50%;object-fit:cover;margin-top:10px;">
            @endif
            <small style="color:#64748b;display:block;margin-top:6px;">Rekomendasi: foto persegi (1:1), min 300×300px. Maks 2MB.</small>
        </div>

        <div class="form-check" style="margin-bottom:8px;">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $tim->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di website</label>
        </div>

        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>
@endsection
