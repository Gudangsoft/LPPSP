@extends('layouts.app')
@section('title', 'Detail Pengalaman')

@push('styles')
<style>
    .detail-container {
        max-width: 900px;
        margin: 60px auto;
        padding: 0 20px;
    }
    
    .detail-card {
        background: var(--white);
        border-radius: var(--radius);
        padding: 40px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .detail-header {
        margin-bottom: 24px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border);
    }

    .detail-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1.3;
        margin-bottom: 16px;
    }

    .detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .detail-meta span {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .detail-meta i {
        color: var(--primary-light);
    }

    .detail-image {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
        border-radius: calc(var(--radius) - 4px);
        margin-bottom: 32px;
    }

    .detail-content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: var(--text);
        text-align: justify;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 24px;
        transition: var(--transition);
    }
    
    .back-btn:hover {
        color: var(--primary-dark);
        transform: translateX(-5px);
    }
</style>
@endpush

@section('content')


<div class="detail-container">
    <a href="{{ route('pengalaman') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengalaman
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <h2 class="detail-title">{{ $pengalaman->judul }}</h2>
            <div class="detail-meta">
                @if($pengalaman->kategori)
                <span><i class="fas fa-tag"></i> {{ $pengalaman->kategori }}</span>
                @endif
                @if($pengalaman->klien)
                <span><i class="fas fa-building"></i> {{ $pengalaman->klien }}</span>
                @endif
                @if($pengalaman->tahun)
                <span><i class="fas fa-calendar-alt"></i> Tahun {{ $pengalaman->tahun }}</span>
                @endif
            </div>
        </div>

        @if($pengalaman->gambar)
            <img src="{{ Storage::url($pengalaman->gambar) }}" alt="{{ $pengalaman->judul }}" class="detail-image">
        @endif

        <div class="detail-content">
            @if($pengalaman->deskripsi)
                {!! nl2br(e($pengalaman->deskripsi)) !!}
            @else
                <p style="color: var(--text-muted); font-style: italic;">Tidak ada deskripsi rinci untuk pengalaman ini.</p>
            @endif
        </div>

        @php
            $galeri = is_array($pengalaman->galeri) ? $pengalaman->galeri : json_decode($pengalaman->galeri, true) ?? [];
        @endphp
        
        @if(count($galeri) > 0)
        <div style="margin-top: 40px; border-top: 1px solid var(--border); padding-top: 32px;">
            <h3 style="font-size: 1.4rem; color: var(--primary); margin-bottom: 20px;">Galeri Kegiatan</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px;">
                @foreach($galeri as $img)
                    <a href="{{ Storage::url($img) }}" target="_blank" style="display: block; border-radius: 8px; overflow: hidden; box-shadow: var(--shadow-sm);">
                        <img src="{{ Storage::url($img) }}" alt="Galeri" style="width: 100%; height: 160px; object-fit: cover; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
