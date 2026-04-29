@extends('layouts.admin')
@section('title', 'Kelola Testimoni')
@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-comments" style="color:#1a6fc4;margin-right:10px;"></i>Kelola Testimoni</h1>
    <a href="{{ route('admin.testimoni.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Testimoni</a>
</div>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>#</th><th>Foto</th><th>Nama / Instansi</th><th>Isi Testimoni</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($testimonis as $i => $t)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>
                @if($t->foto)
                <img src="{{ Storage::url($t->foto) }}" alt="Foto" style="height:40px; border-radius: 50%;">
                @else
                <i class="fas fa-user-circle fa-2x" style="color: #cbd5e0;"></i>
                @endif
            </td>
            <td><strong>{{ $t->nama }}</strong><br><small>{{ $t->jabatan ? $t->jabatan . ' - ' : '' }}{{ $t->instansi }}</small></td>
            <td>{{ Str::limit($t->isi, 60) }}<br><small style="color:#f6ad55;"><i class="fas fa-star"></i> {{ $t->rating }}</small></td>
            <td><span class="badge {{ $t->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $t->aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.testimoni.edit', $t) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('admin.testimoni.destroy', $t) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" data-confirm="Hapus testimoni ini?"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:32px;color:#718096;">Belum ada data testimoni.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 15px;">
        {{ $testimonis->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection
