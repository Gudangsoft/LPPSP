@extends('layouts.admin')
@section('title', 'Kelola Layanan')
@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-concierge-bell" style="color:#1a6fc4;margin-right:10px;"></i>Kelola Layanan</h1>
    <a href="{{ route('admin.layanan.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Layanan</a>
</div>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>#</th><th>Judul</th><th>Ikon</th><th>Urutan</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($layanans as $i => $l)
        <tr>
            <td>{{ $i+1 }}</td>
            <td><strong>{{ $l->judul }}</strong><br><small style="color:#718096;">{{ Str::limit($l->deskripsi, 60) }}</small></td>
            <td><i class="fas {{ $l->ikon ?? 'fa-cogs' }}"></i> {{ $l->ikon }}</td>
            <td>{{ $l->urutan }}</td>
            <td><span class="badge {{ $l->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $l->aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.layanan.edit', $l) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('admin.layanan.destroy', $l) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" data-confirm="Hapus layanan ini?"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:32px;color:#718096;">Belum ada data layanan.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
