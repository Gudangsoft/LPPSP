@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('content')
<div class="admin-page-header">
    <h1>Detail Pesan</h1>
    <a href="{{ route('admin.kontak.index') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div class="admin-form-card" style="max-width:760px;">
    <div style="margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <h2 style="margin:0 0 10px; font-size: 1.5rem;">{{ $kontak->subjek }}</h2>
        <div style="display: flex; justify-content: space-between; align-items: center; color: #718096;">
            <div>
                <strong>Dari:</strong> {{ $kontak->nama }} &lt;<a href="mailto:{{ $kontak->email }}">{{ $kontak->email }}</a>&gt;<br>
                <strong>Telepon:</strong> {{ $kontak->telepon ?? '-' }}
            </div>
            <div style="text-align: right;">
                <i class="far fa-calendar-alt"></i> {{ $kontak->created_at->format('d F Y, H:i') }}
            </div>
        </div>
    </div>
    
    <div style="min-height: 200px; padding: 20px; background: #f8fafc; border-radius: 8px; white-space: pre-line; line-height: 1.6;">
        {{ $kontak->pesan }}
    </div>

    <div style="margin-top:24px; text-align: right;">
        <a href="mailto:{{ $kontak->email }}?subject=Balasan: {{ $kontak->subjek }}" class="btn btn-success"><i class="fas fa-reply"></i> Balas via Email</a>
        <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-delete" data-confirm="Hapus pesan ini?" style="background:#e53e3e;color:#fff;border:none;padding:10px 20px;border-radius:4px;cursor:pointer;"><i class="fas fa-trash"></i> Hapus Pesan</button>
        </form>
    </div>
</div>
@endsection
