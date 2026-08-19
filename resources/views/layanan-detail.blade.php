@extends('layouts.app')
@section('title', $layanan->judul)

@push('styles')
<style>
    .pd-breadcrumb { background:#f8fafc; border-bottom:1px solid #e2e8f0; padding:12px 0; }
    .pd-breadcrumb-inner {
        max-width:860px; margin:0 auto; padding:0 24px;
        display:flex; align-items:center; gap:8px;
        font-size:0.85rem; color:#64748b; flex-wrap:wrap;
    }
    .pd-breadcrumb a { color:#1a4a9e; text-decoration:none; font-weight:500; }
    .pd-breadcrumb a:hover { text-decoration:underline; }
    .pd-breadcrumb-sep { color:#cbd5e1; }
    .pd-breadcrumb-cur { color:#475569; font-weight:600; }

    .pd-single { max-width:860px; margin:40px auto 60px; padding:0 24px; }
    .pd-single-img {
        width:100%; border-radius:14px; margin-bottom:28px;
        box-shadow:0 4px 20px rgba(0,0,0,0.1); display:block;
        max-height:420px; object-fit:cover;
    }
    .pd-icon-badge {
        width:64px; height:64px; border-radius:16px;
        background:linear-gradient(135deg, var(--primary) 0%, #1a3a8a 100%);
        color:#fbbf24; display:flex; align-items:center; justify-content:center;
        font-size:1.7rem; margin-bottom:20px;
    }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<div class="pd-breadcrumb">
    <div class="pd-breadcrumb-inner">
        <a href="{{ route('beranda') }}"><i class="fas fa-home"></i> Beranda</a>
        <span class="pd-breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:0.7rem;"></i></span>
        <a href="{{ route('layanan') }}">Layanan</a>
        <span class="pd-breadcrumb-sep"><i class="fas fa-chevron-right" style="font-size:0.7rem;"></i></span>
        <span class="pd-breadcrumb-cur">{{ Str::limit($layanan->judul, 50) }}</span>
    </div>
</div>

<section class="section">
    <div class="pd-single">
        @if($layanan->gambar)
        <img src="{{ Storage::url($layanan->gambar) }}" alt="{{ $layanan->judul }}" class="pd-single-img">
        @else
        <div class="pd-icon-badge"><i class="{{ $layanan->ikon ?: 'fas fa-check-circle' }}"></i></div>
        @endif

        <h1 style="font-size:1.6rem;font-weight:800;color:#0d2b5e;margin-bottom:20px;line-height:1.35;">{{ $layanan->judul }}</h1>

        <div style="line-height:1.9;color:#2d3748;font-size:1.05rem;">
            {!! nl2br(e($layanan->detail ?: $layanan->deskripsi)) !!}
        </div>

        <div style="margin-top:40px;padding-top:24px;border-top:1px solid #e2e8f0;">
            <a href="{{ route('layanan') }}" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali ke Layanan</a>
            <a href="{{ route('kontak') }}" class="btn btn-primary" style="margin-left:10px;"><i class="fas fa-paper-plane"></i> Konsultasi Layanan Ini</a>
        </div>
    </div>
</section>

@endsection
