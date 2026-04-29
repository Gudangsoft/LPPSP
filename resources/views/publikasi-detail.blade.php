@extends('layouts.app')
@section('title', $publikasi->judul)
@section('content')
<section class="section">
    <div class="container" style="max-width:860px;">
        @if($publikasi->gambar)
        <img src="{{ Storage::url($publikasi->gambar) }}" alt="{{ $publikasi->judul }}" style="width:100%;border-radius:16px;margin-bottom:32px;max-height:400px;object-fit:cover;">
        @endif
        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:24px;">
            <span class="card-badge">{{ $publikasi->kategori }}</span>
            @if($publikasi->penulis)<span class="card-badge" style="background:#f0fff4;color:#38a169;"><i class="fas fa-user"></i> {{ $publikasi->penulis }}</span>@endif
            @if($publikasi->tanggal_terbit)<span class="card-badge" style="background:#fff3cd;color:#856404;"><i class="fas fa-calendar"></i> {{ $publikasi->tanggal_terbit->format('d M Y') }}</span>@endif
        </div>
        @if($publikasi->video_url)
        <div style="margin-bottom:24px;"><iframe src="{{ $publikasi->video_url }}" style="width:100%;height:400px;border-radius:12px;border:0;" allowfullscreen></iframe></div>
        @endif
        <div style="line-height:1.9;color:#2d3748;font-size:1.05rem;">{!! nl2br(e($publikasi->konten ?? $publikasi->deskripsi)) !!}</div>
        @if($publikasi->file_url)
        <div style="margin-top:32px;">
            <a href="{{ Storage::url($publikasi->file_url) }}" download class="btn btn-primary"><i class="fas fa-download"></i> Unduh File</a>
        </div>
        @endif
        <div style="margin-top:40px;padding-top:24px;border-top:1px solid #e2e8f0;">
            <a href="{{ route('publikasi') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</section>
@endsection
