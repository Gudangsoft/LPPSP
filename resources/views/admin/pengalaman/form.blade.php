@extends('layouts.admin')
@section('title', $pengalaman->exists ? 'Edit Pengalaman' : 'Tambah Pengalaman')
@section('content')
<div class="admin-page-header">
    <h1>{{ $pengalaman->exists ? 'Edit Pengalaman' : 'Tambah Pengalaman' }}</h1>
    <a href="{{ route('admin.pengalaman.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="admin-form-card" style="max-width:820px;">
    <form action="{{ $pengalaman->exists ? route('admin.pengalaman.update', $pengalaman) : route('admin.pengalaman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($pengalaman->exists) @method('PUT') @endif

        {{-- Baris 1: Layanan Utama --}}
        <div class="form-group">
            <label class="form-label">Layanan Utama</label>
            <select name="layanan_id" class="form-control @error('layanan_id') is-invalid @enderror">
                <option value="">— Pilih Layanan —</option>
                @foreach($layanans as $lay)
                <option value="{{ $lay->id }}" {{ old('layanan_id', $pengalaman->layanan_id) == $lay->id ? 'selected' : '' }}>
                    {{ $lay->judul }}
                </option>
                @endforeach
            </select>
            @error('layanan_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
            <small style="color:#64748b;">Pilih layanan yang sesuai agar pengalaman muncul di halaman layanan terkait.</small>
        </div>

        {{-- Baris 2: Judul Pekerjaan --}}
        <div class="form-group">
            <label class="form-label">Judul Pekerjaan / Kegiatan / Aktivitas <span>*</span></label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                value="{{ old('judul', $pengalaman->judul) }}" required
                placeholder="Contoh: Penyusunan Dokumen Ranwal RKPD Tahun 2027">
            @error('judul')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        {{-- Baris 3: Target & Klien --}}
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Target / Kelompok Sasaran</label>
                <input type="text" name="target_sasaran" class="form-control @error('target_sasaran') is-invalid @enderror"
                    value="{{ old('target_sasaran', $pengalaman->target_sasaran) }}"
                    placeholder="Contoh: Pemerintah daerah dan perangkat daerah">
                @error('target_sasaran')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Klien / Pemberi Pekerjaan <span>*</span></label>
                <select id="klienPicker" class="form-control" style="margin-bottom:8px;" onchange="document.getElementById('klienText').value=this.value;this.value='';">
                    <option value="">— Pilih dari daftar Klien/Mitra —</option>
                    @foreach($klienmitras as $km)
                    <option value="{{ $km->nama }}">{{ $km->nama }}</option>
                    @endforeach
                </select>
                <input type="text" name="klien" id="klienText"
                    class="form-control @error('klien') is-invalid @enderror"
                    value="{{ old('klien', $pengalaman->klien) }}" required
                    placeholder="Atau ketik nama klien / instansi secara manual...">
                @error('klien')<span class="invalid-feedback">{{ $message }}</span>@enderror
                <small style="color:#64748b;">Pilih dari dropdown untuk mengisi otomatis, atau ketik langsung di kolom bawah.</small>
            </div>
        </div>

        {{-- Baris 4: Lokasi & Tahun --}}
        <div class="form-row-2">
            <div class="form-group">
                <label class="form-label">Lokasi</label>
                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                    value="{{ old('lokasi', $pengalaman->lokasi) }}"
                    placeholder="Contoh: Kabupaten Merauke">
                @error('lokasi')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Tahun Pelaksanaan <span>*</span></label>
                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                    value="{{ old('tahun', $pengalaman->tahun ?? date('Y')) }}"
                    min="1990" max="2100" required>
                @error('tahun')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label class="form-label">Deskripsi Singkat Pekerjaan / Kegiatan / Aktivitas</label>
            <textarea name="deskripsi" class="form-control" rows="5"
                placeholder="Uraikan kegiatan, pendekatan, dan hasil yang dicapai...">{{ old('deskripsi', $pengalaman->deskripsi) }}</textarea>
        </div>

        {{-- Gambar Utama --}}
        <div class="form-group">
            <label class="form-label">Gambar Utama</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" data-preview="prevGambar">
            @if($pengalaman->gambar)
            <img id="prevGambar" src="{{ Storage::url($pengalaman->gambar) }}" class="img-preview" style="max-height:150px;margin-top:10px;">
            @else
            <img id="prevGambar" class="img-preview" style="display:none;max-height:150px;margin-top:10px;">
            @endif
        </div>

        {{-- Galeri --}}
        <div class="form-group" style="margin-top:24px;border-top:1px solid var(--border);padding-top:24px;">
            <label class="form-label"><i class="fas fa-images"></i> Galeri Kegiatan</label>
            <p style="font-size:0.85rem;color:#64748b;margin-bottom:16px;">Upload beberapa gambar sekaligus. Centang untuk menghapus gambar yang ada.</p>

            @php $galeri = is_array($pengalaman->galeri) ? $pengalaman->galeri : []; @endphp

            @if(count($galeri) > 0)
            <div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
                @foreach($galeri as $img)
                <div style="position:relative;width:120px;height:120px;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;">
                    <img src="{{ Storage::url($img) }}" style="width:100%;height:100%;object-fit:cover;">
                    <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,0.6);padding:4px;text-align:center;">
                        <label style="color:white;font-size:12px;cursor:pointer;display:block;margin:0;">
                            <input type="checkbox" name="remove_galeri[]" value="{{ $img }}"> Hapus
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <input type="file" name="galeri[]" class="form-control" accept="image/*" multiple id="galeriInput">
            <small style="color:var(--text-muted);display:block;margin-top:6px;">Bisa memilih banyak file. Maks 4MB per gambar.</small>
            <div id="galeriPreview" style="display:flex;flex-wrap:wrap;gap:12px;margin-top:16px;"></div>
        </div>

        <div class="form-check">
            <input type="checkbox" name="unggulan" id="unggulan" value="1" {{ old('unggulan', $pengalaman->unggulan) ? 'checked' : '' }}>
            <label for="unggulan">Jadikan Pengalaman Unggulan</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="aktif" id="aktif" value="1" {{ old('aktif', $pengalaman->aktif ?? true) ? 'checked' : '' }}>
            <label for="aktif">Tampilkan di website</label>
        </div>

        <div style="margin-top:24px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const galeriInput = document.getElementById('galeriInput');
    const galeriPreview = document.getElementById('galeriPreview');
    if (galeriInput) {
        galeriInput.addEventListener('change', function () {
            galeriPreview.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    Object.assign(img.style, { height:'100px', width:'120px', objectFit:'cover', borderRadius:'8px', border:'1px solid #cbd5e1' });
                    galeriPreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    }
</script>
@endpush
@endsection
