@extends('layouts.admin')
@section('title', 'Berita')
@section('content')

<div class="admin-page-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <h1 style="margin:0;"><i class="fas fa-bullhorn" style="color:#1a6fc4;margin-right:10px;"></i>Berita</h1>
        <span style="background:#e8f0fb;color:#1a4a9e;font-size:0.75rem;font-weight:700;padding:4px 12px;border-radius:20px;">Berita Kegiatan</span>
    </div>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Berita</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Search --}}
<form method="GET" action="{{ route('admin.berita.index') }}" style="margin-bottom:16px;display:flex;gap:10px;">
    <input type="text" name="q" value="{{ $q }}" class="form-control" style="max-width:320px;" placeholder="Cari judul berita...">
    <button type="submit" class="btn btn-outline"><i class="fas fa-search"></i> Cari</button>
    @if($q)<a href="{{ route('admin.berita.index') }}" class="btn btn-outline">Reset</a>@endif
</form>

<div class="admin-table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th style="width:40px;">#</th>
                <th>Judul</th>
                <th>Tanggal Terbit</th>
                <th style="width:80px;">Status</th>
                <th style="width:120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($berita as $i => $p)
        <tr>
            <td>{{ $berita->firstItem() + $i }}</td>
            <td>
                @if($p->gambar)
                <img src="{{ Storage::url($p->gambar) }}" style="width:42px;height:42px;object-fit:cover;border-radius:6px;float:left;margin-right:10px;border:1px solid #e2e8f0;">
                @endif
                <strong>{{ $p->judul }}</strong>
                @if($p->unggulan)
                <span style="background:#fef9c3;color:#92400e;font-size:0.65rem;font-weight:700;padding:2px 7px;border-radius:50px;margin-left:4px;">Unggulan</span>
                @endif
            </td>
            <td style="color:#64748b;font-size:0.83rem;">{{ $p->tanggal_terbit ? $p->tanggal_terbit->format('d M Y') : '-' }}</td>
            <td><span class="badge {{ $p->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $p->aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.berita.edit', $p) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('admin.berita.destroy', $p) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" data-confirm="Hapus berita ini?"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align:center;padding:40px;color:#94a3b8;">
                <i class="fas fa-bullhorn" style="font-size:2rem;display:block;margin-bottom:10px;color:#cbd5e1;"></i>
                Belum ada berita.
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top:15px;">{{ $berita->links('vendor.pagination.admin') }}</div>
</div>
@endsection
