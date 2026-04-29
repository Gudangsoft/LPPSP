@extends('layouts.admin')
@section('title', 'Kelola Klien & Mitra')
@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-handshake" style="color:#1a6fc4;margin-right:10px;"></i>Kelola Klien & Mitra</h1>
    <a href="{{ route('admin.klien-mitra.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Klien/Mitra</a>
</div>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>#</th><th>Logo</th><th>Nama Instansi</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($klienMitras as $i => $km)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>
                @if($km->logo)
                <img src="{{ Storage::url($km->logo) }}" alt="Logo" style="height:40px;">
                @else
                <span style="color:#a0aec0;font-size:0.8rem;">Tidak ada logo</span>
                @endif
            </td>
            <td><strong>{{ $km->nama }}</strong><br><small><a href="{{ $km->website }}" target="_blank" style="color:#1a6fc4;">{{ $km->website }}</a></small></td>
            <td>{{ $km->kategori }}</td>
            <td><span class="badge {{ $km->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">{{ $km->aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.klien-mitra.edit', $km) }}" class="btn-icon btn-edit"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ route('admin.klien-mitra.destroy', $km) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" data-confirm="Hapus klien/mitra ini?"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:32px;color:#718096;">Belum ada data klien & mitra.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 15px;">
        {{ $klienMitras->links() }}
    </div>
</div>
@endsection
