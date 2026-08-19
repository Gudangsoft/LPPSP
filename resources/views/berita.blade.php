@extends('layouts.app')
@section('title', 'Berita')

@push('styles')
<style>
    .brt-hero {
        background: linear-gradient(135deg, #0d2b5e 0%, #1a4a9e 60%, #1a6fc4 100%);
        padding: 36px 0 44px; position: relative; overflow: hidden;
    }
    .brt-hero::before {
        content:''; position:absolute; top:-80px; right:-80px;
        width:300px; height:300px; border-radius:50%;
        background:rgba(255,255,255,0.05);
    }
    .brt-hero-inner {
        max-width:1200px; margin:0 auto; padding:0 24px;
        position:relative; z-index:1;
    }
    .brt-hero h1 { font-size:1.9rem; font-weight:800; color:#fff; margin-bottom:6px; }
    .brt-hero p  { font-size:0.92rem; color:rgba(255,255,255,0.75); margin-bottom:22px; }
    .brt-search-bar {
        display:flex; max-width:520px;
        background:#fff; border-radius:10px;
        box-shadow:0 4px 20px rgba(0,0,0,0.15); overflow:hidden;
    }
    .brt-search-bar input {
        flex:1; padding:12px 18px; border:none; outline:none;
        font-size:0.93rem; color:#0d2b5e;
    }
    .brt-search-bar button {
        background:#f59e0b; color:#fff; border:none; padding:0 20px;
        font-weight:700; font-size:0.88rem; cursor:pointer;
        display:flex; align-items:center; gap:6px; transition:background 0.2s;
    }
    .brt-search-bar button:hover { background:#d97706; }

    .brt-body { max-width:1200px; margin:36px auto 60px; padding:0 24px; }
    .brt-toolbar {
        display:flex; align-items:center; justify-content:space-between;
        margin-bottom:22px; padding-bottom:14px; border-bottom:2px solid #f1f5f9;
        flex-wrap:wrap; gap:10px;
    }
    .brt-toolbar-title {
        font-size:1.1rem; font-weight:800; color:#0d2b5e;
        display:flex; align-items:center; gap:10px;
    }
    .brt-toolbar-title .badge {
        background:linear-gradient(135deg,#1a4a9e,#1a6fc4);
        color:#fff; font-size:0.68rem; padding:3px 10px;
        border-radius:20px; font-weight:700;
    }

    .brt-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:24px; }
    .brt-card {
        background:#fff; border-radius:12px; overflow:hidden; text-decoration:none;
        border:1px solid #e2e8f0; box-shadow:0 2px 8px rgba(0,0,0,0.04);
        display:flex; flex-direction:column; transition:all 0.2s;
    }
    .brt-card:hover { transform:translateY(-5px); box-shadow:0 10px 28px rgba(13,43,94,0.1); border-color:#93c5fd; }
    .brt-card-img { width:100%; height:190px; background:#f8fafc; overflow:hidden; border-bottom:1px solid #e2e8f0; }
    .brt-card-img img { width:100%; height:100%; object-fit:cover; }
    .brt-card-img-placeholder {
        width:100%; height:190px; display:flex; align-items:center; justify-content:center;
        color:#93c5fd; font-size:2.5rem; background:rgba(26,111,196,0.05); border-bottom:1px solid #e2e8f0;
    }
    .brt-card-body { padding:20px; flex-grow:1; display:flex; flex-direction:column; }
    .brt-card-date { font-size:0.76rem; color:#94a3b8; font-weight:600; margin-bottom:8px; display:flex; align-items:center; gap:6px; }
    .brt-card-title {
        font-size:1.05rem; font-weight:800; color:#0d2b5e; margin:0 0 10px; line-height:1.4;
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .brt-card-desc {
        font-size:0.88rem; color:#64748b; line-height:1.6; margin:0 0 16px; flex-grow:1;
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
    }
    .brt-card-cta { font-size:0.85rem; font-weight:700; color:#1a4a9e; display:flex; align-items:center; gap:8px; }

    .brt-empty {
        text-align:center; padding:56px 20px; color:#94a3b8;
        background:#fafafa; border-radius:12px; border:1px dashed #e2e8f0;
    }
    .brt-empty i { font-size:2.5rem; display:block; margin-bottom:12px; color:#cbd5e1; }

    @media (max-width:768px) {
        .brt-grid { grid-template-columns:1fr; }
    }
</style>
@endpush

@section('content')

<div class="brt-hero">
    <div class="brt-hero-inner">
        <h1><i class="fas fa-bullhorn" style="margin-right:10px;opacity:0.8;"></i>Berita & Kegiatan</h1>
        <p>Informasi kegiatan, pelatihan, pendampingan, dan kolaborasi {{ isset($profile) && $profile->singkatan ? $profile->singkatan : 'LPPSP' }}.</p>
        <form method="GET" action="{{ route('berita') }}" class="brt-search-bar">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul berita...">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
        </form>
    </div>
</div>

<div class="brt-body">
    <div class="brt-toolbar">
        <div class="brt-toolbar-title">
            <i class="fas fa-bullhorn" style="color:#1a6fc4;"></i> Berita
            <span class="badge">{{ $beritas->total() }} berita</span>
        </div>
        @if($q)
        <a href="{{ route('berita') }}" style="font-size:0.82rem;color:#64748b;text-decoration:none;display:flex;align-items:center;gap:5px;">
            <i class="fas fa-times-circle"></i> Reset pencarian
        </a>
        @endif
    </div>

    @if($beritas->isEmpty())
    <div class="brt-empty">
        <i class="fas fa-inbox"></i>
        <p style="font-size:1rem;font-weight:600;margin-bottom:4px;">Belum ada berita</p>
        <p style="font-size:0.85rem;">Coba kata kunci lain atau kembali lagi nanti.</p>
    </div>
    @else
    <div class="brt-grid">
        @foreach($beritas as $b)
        <a href="{{ route('berita.show', $b) }}" class="brt-card">
            <div class="brt-card-img">
                @if($b->gambar)
                <img src="{{ Storage::url($b->gambar) }}" alt="{{ $b->judul }}">
                @else
                <div class="brt-card-img-placeholder"><i class="fas fa-newspaper"></i></div>
                @endif
            </div>
            <div class="brt-card-body">
                <div class="brt-card-date">
                    <i class="fas fa-calendar-alt"></i>
                    {{ $b->tanggal_terbit ? $b->tanggal_terbit->translatedFormat('d F Y') : $b->created_at->translatedFormat('d F Y') }}
                </div>
                <h3 class="brt-card-title">{{ $b->judul }}</h3>
                @if($b->deskripsi)
                <p class="brt-card-desc">{{ $b->deskripsi }}</p>
                @endif
                <span class="brt-card-cta">Baca Selengkapnya <i class="fas fa-arrow-right" style="font-size:0.8em;"></i></span>
            </div>
        </a>
        @endforeach
    </div>
    @endif

    @if($beritas->hasPages())
    <div style="margin-top:32px;display:flex;justify-content:center;">
        {{ $beritas->appends(['q' => $q])->links() }}
    </div>
    @endif
</div>

@endsection
