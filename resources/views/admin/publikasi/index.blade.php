@extends('layouts.admin')
@section('title', 'Kelola Publikasi')
@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-book" style="color:#1a6fc4;margin-right:10px;"></i>Kelola Publikasi</h1>
    <a href="{{ route('admin.publikasi.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Publikasi</a>
</div>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>#</th><th>Judul</th><th>Kategori</th><th>Tanggal Terbit</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($publikasis as $i => $p)
        <tr>
            <td>{{ $i+1 }}</td>
            <td><strong>{{ $p->judul }}</strong><br><small style="color:#718096;">Oleh: {{ $p->penulis }}</small></td>
            <td>{{ $p->kategori }}</td>
            <td>{{ $p->tanggal_terbit ? $p->tanggal_terbit->format('d M Y') : '-' }}</td>
            <td><span class="badge {{ $p->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $p->aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.publikasi.edit', $p) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('admin.publikasi.destroy', $p) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" data-confirm="Hapus publikasi ini?"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:32px;color:#718096;">Belum ada data publikasi.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 15px;">
        {{ $publikasis->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection
