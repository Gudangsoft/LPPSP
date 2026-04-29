@extends('layouts.admin')
@section('title', 'Tim Admin')
@section('content')

<div class="admin-page-header">
    <h1><i class="fas fa-id-badge" style="color:#1a6fc4;margin-right:10px;"></i>Tim Admin</h1>
    <a href="{{ route('admin.galeri-slider.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Anggota</a>
</div>

@if(session('success'))
<div style="background:#dcfce7;border:1px solid #86efac;color:#16a34a;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div style="background:#f0f6ff;border:1px solid #bae6fd;border-radius:10px;padding:14px 18px;margin-bottom:24px;font-size:0.88rem;color:#0369a1;">
    <i class="fas fa-info-circle"></i> Data Tim Admin ditampilkan di halaman <strong>Kontak</strong> sebagai slider profil anggota.
    Urutan angka lebih kecil tampil lebih dulu.
</div>

@if($sliders->isEmpty())
<div style="text-align:center;padding:60px 20px;background:#fff;border-radius:14px;border:1px solid #e8edf5;">
    <i class="fas fa-id-badge" style="font-size:3rem;color:#cbd5e1;display:block;margin-bottom:14px;"></i>
    <p style="font-weight:600;color:#64748b;margin:0 0 6px;">Belum ada anggota Tim Admin</p>
    <a href="{{ route('admin.galeri-slider.create') }}" class="btn btn-success" style="margin-top:16px;"><i class="fas fa-plus"></i> Tambah Anggota Pertama</a>
</div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;">
    @foreach($sliders as $s)
    <div style="background:#fff;border:1px solid #e8edf5;border-radius:16px;overflow:hidden;box-shadow:0 2px 10px rgba(13,43,94,0.06);">
        {{-- Foto --}}
        <div style="position:relative;aspect-ratio:1/1;overflow:hidden;background:#e8f0fb;">
            <img src="{{ Storage::url($s->foto) }}" alt="{{ $s->nama }}"
                style="width:100%;height:100%;object-fit:cover;">
            <div style="position:absolute;top:10px;right:10px;">
                <span style="font-size:0.7rem;font-weight:700;padding:3px 10px;border-radius:50px;{{ $s->aktif ? 'background:#dcfce7;color:#16a34a;' : 'background:#fee2e2;color:#dc2626;' }}">
                    {{ $s->aktif ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <div style="position:absolute;top:10px;left:10px;">
                <span style="background:rgba(0,0,0,0.5);color:#fff;font-size:0.68rem;font-weight:700;padding:3px 9px;border-radius:50px;">
                    #{{ $s->urutan }}
                </span>
            </div>
        </div>
        {{-- Info --}}
        <div style="padding:16px;">
            <p style="font-weight:800;color:#0d2b5e;margin:0 0 2px;font-size:1rem;">{{ $s->nama }}</p>
            @if($s->jabatan)
            <p style="font-size:0.78rem;color:#1a6fc4;font-weight:600;margin:0 0 10px;">{{ $s->jabatan }}</p>
            @endif
            {{-- Kontak badges --}}
            <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:14px;">
                @if($s->wa)
                <span style="display:inline-flex;align-items:center;gap:4px;background:#dcfce7;color:#16a34a;font-size:0.7rem;font-weight:700;padding:3px 9px;border-radius:50px;">
                    <i class="fab fa-whatsapp"></i> WA
                </span>
                @endif
                @if($s->instagram)
                <span style="display:inline-flex;align-items:center;gap:4px;background:#fce7f3;color:#db2777;font-size:0.7rem;font-weight:700;padding:3px 9px;border-radius:50px;">
                    <i class="fab fa-instagram"></i> IG
                </span>
                @endif
                @if($s->facebook)
                <span style="display:inline-flex;align-items:center;gap:4px;background:#dbeafe;color:#1d4ed8;font-size:0.7rem;font-weight:700;padding:3px 9px;border-radius:50px;">
                    <i class="fab fa-facebook"></i> FB
                </span>
                @endif
                @if($s->linkedin)
                <span style="display:inline-flex;align-items:center;gap:4px;background:#e0f2fe;color:#0284c7;font-size:0.7rem;font-weight:700;padding:3px 9px;border-radius:50px;">
                    <i class="fab fa-linkedin"></i> LI
                </span>
                @endif
            </div>
            <div style="display:flex;gap:8px;">
                <a href="{{ route('admin.galeri-slider.edit', $s) }}"
                    style="flex:1;display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:8px;border-radius:8px;background:#e8f0fb;color:#1a56db;font-size:0.78rem;font-weight:600;text-decoration:none;">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.galeri-slider.destroy', $s) }}" method="POST" style="flex:1;">
                    @csrf @method('DELETE')
                    <button type="submit" data-confirm="Hapus anggota ini?"
                        style="width:100%;display:inline-flex;align-items:center;justify-content:center;gap:5px;padding:8px;border-radius:8px;background:#fee2e2;color:#dc2626;font-size:0.78rem;font-weight:600;border:none;cursor:pointer;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
