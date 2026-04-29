@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-envelope" style="color:#1a6fc4;margin-right:10px;"></i>Pesan Masuk</h1>
</div>
<div class="admin-table-wrap">
    <table class="admin-table">
        <thead><tr><th>#</th><th>Pengirim</th><th>Subjek</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($kontaks as $i => $k)
        <tr style="{{ !$k->sudah_dibaca ? 'background-color:#f0f7ff; font-weight:bold;' : '' }}">
            <td>{{ $i+1 }}</td>
            <td><strong>{{ $k->nama }}</strong><br><small><a href="mailto:{{ $k->email }}">{{ $k->email }}</a></small></td>
            <td>{{ Str::limit($k->subjek, 40) }}</td>
            <td>{{ $k->created_at->format('d M Y H:i') }}</td>
            <td>
                @if($k->sudah_dibaca)
                <span class="badge badge-nonaktif" style="background:#e2e8f0;color:#4a5568;"><i class="fas fa-check-double"></i> Dibaca</span>
                @else
                <span class="badge badge-aktif"><i class="fas fa-envelope"></i> Baru</span>
                @endif
            </td>
            <td>
                <div class="td-actions">
                    <a href="{{ route('admin.kontak.show', $k) }}" class="btn-icon btn-edit" style="background:#3182ce;color:#fff;"><i class="fas fa-eye"></i> Buka</a>
                    <form action="{{ route('admin.kontak.destroy', $k) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-icon btn-delete" data-confirm="Hapus pesan ini?"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;padding:32px;color:#718096;">Belum ada pesan masuk.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 15px;">
        {{ $kontaks->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection
