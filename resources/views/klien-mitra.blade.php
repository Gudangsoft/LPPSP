@extends('layouts.app')
@section('title', 'Klien & Mitra')

@push('styles')
<style>
    .km-container {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    /* Hero */
    .km-hero {
        background: linear-gradient(135deg, #0d2b5e 0%, #1e3a8a 60%, #1a6fc4 100%);
        border-radius: 16px;
        padding: 48px 40px;
        text-align: center;
        box-shadow: 0 8px 32px rgba(13,43,94,0.2);
    }
    .km-hero h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 12px;
    }
    .km-hero p {
        color: rgba(255,255,255,0.85);
        font-size: 1.05rem;
        line-height: 1.75;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Grid */
    .km-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    /* Card */
    .km-card {
        background: #fff;
        border-radius: 16px;
        padding: 28px 20px 22px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 12px;
        border: 1px solid #e8edf5;
        box-shadow: 0 4px 16px rgba(13,43,94,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .km-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(13,43,94,0.13);
    }
    .km-logo {
        width: 88px;
        height: 88px;
        background: #f0f6ff;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #e2eaf8;
        flex-shrink: 0;
    }
    .km-logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
    .km-logo-placeholder {
        font-size: 2rem;
        font-weight: 800;
        color: #1a6fc4;
    }
    .km-name {
        font-size: 1rem;
        font-weight: 700;
        color: #0d2b5e;
        line-height: 1.35;
        margin: 0;
    }
    .km-kategori {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #1a6fc4;
        background: #e8f0fb;
        padding: 3px 12px;
        border-radius: 50px;
    }
    .km-btn {
        margin-top: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #0d2b5e, #1a6fc4);
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
    }
    .km-btn:hover { opacity: 0.88; transform: translateY(-1px); }
    .km-btn-ghost {
        background: transparent;
        color: #64748b;
        border: 1.5px solid #e2e8f0;
        font-size: 0.78rem;
        padding: 6px 14px;
    }
    .km-btn-ghost:hover { border-color: #1a6fc4; color: #1a6fc4; opacity: 1; }

    /* Pagination */
    .km-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .km-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 14px;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        border: 1.5px solid #e2e8f0;
        color: #374151;
        background: #fff;
        transition: all 0.2s;
    }
    .km-page-btn:hover { border-color: #1a6fc4; color: #1a6fc4; }
    .km-page-btn.active {
        background: linear-gradient(135deg, #0d2b5e, #1a6fc4);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(13,43,94,0.25);
    }
    .km-page-btn.disabled { opacity: 0.4; pointer-events: none; }
    .km-page-info {
        font-size: 0.85rem;
        color: #64748b;
        text-align: center;
        margin-top: 4px;
    }

    /* Modal */
    .km-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(13,43,94,0.55);
        backdrop-filter: blur(4px);
        z-index: 9000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .km-modal-overlay.open { display: flex; }
    .km-modal {
        background: #fff;
        border-radius: 20px;
        max-width: 720px;
        width: 100%;
        max-height: 88vh;
        overflow-y: auto;
        box-shadow: 0 24px 60px rgba(0,0,0,0.22);
        position: relative;
        animation: kmIn 0.28s ease;
    }
    @keyframes kmIn {
        from { opacity:0; transform: scale(0.94) translateY(16px); }
        to   { opacity:1; transform: scale(1) translateY(0); }
    }
    .km-modal-close {
        position: absolute;
        top: 16px; right: 16px;
        width: 36px; height: 36px;
        border-radius: 50%;
        background: rgba(0,0,0,0.07);
        border: none;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #334155;
        transition: background 0.2s;
        z-index: 2;
    }
    .km-modal-close:hover { background: rgba(0,0,0,0.14); }
    .km-modal-header {
        display: flex;
        gap: 20px;
        align-items: center;
        padding: 28px 28px 20px;
        border-bottom: 1px solid #f1f5f9;
    }
    .km-modal-logo {
        width: 72px; height: 72px;
        background: #f0f6ff;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
        border: 1px solid #e2eaf8;
    }
    .km-modal-logo img { max-width:100%; max-height:100%; object-fit:contain; }
    .km-modal-info { flex: 1; }
    .km-modal-name { font-size: 1.3rem; font-weight: 800; color: #0d2b5e; margin: 0 0 6px; }
    .km-modal-kat {
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.8px;
        text-transform: uppercase; color: #1a6fc4; background: #e8f0fb;
        padding: 3px 12px; border-radius: 50px; display: inline-block;
    }
    .km-modal-body { padding: 24px 28px 32px; }
    .km-proj-title {
        font-size: 0.75rem; font-weight: 700; letter-spacing: 1px;
        text-transform: uppercase; color: #94a3b8; margin: 0 0 16px;
    }
    .km-proj-list { display: flex; flex-direction: column; gap: 14px; }
    .km-proj-item {
        background: #f8fafc;
        border: 1px solid #e8edf5;
        border-radius: 12px;
        padding: 14px 18px;
        text-align: left;
    }
    .km-proj-item-title {
        font-size: 0.92rem; font-weight: 700; color: #0d2b5e;
        margin: 0 0 6px; line-height: 1.4;
    }
    .km-proj-meta {
        display: flex; gap: 12px; flex-wrap: wrap;
        font-size: 0.78rem; color: #64748b;
    }
    .km-proj-meta span { display: flex; align-items: center; gap: 4px; }
    .km-proj-desc { font-size: 0.82rem; color: #64748b; line-height: 1.6; margin-top: 8px; }
    .km-empty {
        text-align: center; padding: 32px;
        color: #94a3b8; font-size: 0.9rem;
    }
    .km-empty i { font-size: 2rem; display: block; margin-bottom: 10px; color: #cbd5e1; }

    @media (max-width: 992px) { .km-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px) {
        .km-grid { grid-template-columns: 1fr; }
        .km-hero { padding: 32px 24px; }
        .km-hero h2 { font-size: 1.5rem; }
        .km-modal-header { flex-direction: column; text-align: center; }
    }
</style>
@endpush

@section('content')

<div class="km-container">

    {{-- Hero --}}
    <div class="km-hero">
        <h2>Klien dan Mitra LPPSP</h2>
        <p>LPPSP membuka ruang kolaborasi dengan Kementerian/Lembaga, Pemerintah Daerah, OPD/Instansi Teknis, Lembaga Pendidikan, Dunia Usaha, dan Lembaga Mitra Pembangunan lainnya.</p>
    </div>

    {{-- Grid Klien --}}
    @if($klienMitras->total() > 0)
    <div>
        <div class="km-grid">
            @foreach($klienMitras as $klien)
            @php $proyek = $pengalamanMap[$klien->nama] ?? collect(); @endphp
            <div class="km-card">
                <div class="km-logo">
                    @if($klien->logo)
                        <img src="{{ Storage::url($klien->logo) }}" alt="{{ $klien->nama }}">
                    @else
                        <span class="km-logo-placeholder">{{ strtoupper(substr($klien->nama, 0, 1)) }}</span>
                    @endif
                </div>
                <h4 class="km-name">{{ $klien->nama }}</h4>
                <span class="km-kategori">{{ $klien->kategori }}</span>
                <button class="km-btn" onclick="openKmModal({{ $klien->id }})">
                    <i class="fas fa-folder-open"></i> Lihat Selengkapnya
                </button>

                {{-- Pengalaman data for modal --}}
                @php
                    $kmModalData = [
                        'nama'     => $klien->nama,
                        'kategori' => $klien->kategori,
                        'logo'     => $klien->logo ? Storage::url($klien->logo) : '',
                        'inisial'  => strtoupper(substr($klien->nama, 0, 1)),
                        'proyek'   => $proyek->map(function($p) {
                            return [
                                'judul'     => $p->judul,
                                'tahun'     => $p->tahun,
                                'lokasi'    => $p->lokasi,
                                'layanan'   => $p->layanan ? $p->layanan->judul : null,
                                'deskripsi' => $p->deskripsi,
                            ];
                        })->values()->toArray(),
                    ];
                @endphp
                <script type="application/json" id="km-data-{{ $klien->id }}">@json($kmModalData)</script>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($klienMitras->lastPage() > 1)
        <div style="margin-top: 40px;">
            <div class="km-pagination">
                {{-- Prev --}}
                @if($klienMitras->onFirstPage())
                    <span class="km-page-btn disabled"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $klienMitras->previousPageUrl() }}" class="km-page-btn"><i class="fas fa-chevron-left"></i></a>
                @endif

                {{-- Page numbers --}}
                @php
                    $current = $klienMitras->currentPage();
                    $last    = $klienMitras->lastPage();
                    $start   = max(1, $current - 2);
                    $end     = min($last, $current + 2);
                @endphp

                @if($start > 1)
                    <a href="{{ $klienMitras->url(1) }}" class="km-page-btn">1</a>
                    @if($start > 2)<span style="color:#94a3b8;padding:0 4px;">…</span>@endif
                @endif

                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ $klienMitras->url($i) }}" class="km-page-btn {{ $i === $current ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if($end < $last)
                    @if($end < $last - 1)<span style="color:#94a3b8;padding:0 4px;">…</span>@endif
                    <a href="{{ $klienMitras->url($last) }}" class="km-page-btn">{{ $last }}</a>
                @endif

                {{-- Next --}}
                @if($klienMitras->hasMorePages())
                    <a href="{{ $klienMitras->nextPageUrl() }}" class="km-page-btn"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span class="km-page-btn disabled"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
            <p class="km-page-info">
                Menampilkan {{ $klienMitras->firstItem() }}–{{ $klienMitras->lastItem() }} dari {{ $klienMitras->total() }} klien & mitra
            </p>
        </div>
        @endif
    </div>
    @else
    <div style="text-align:center;padding:60px 20px;color:#64748b;">
        <i class="fas fa-handshake" style="font-size:3rem;color:#cbd5e1;display:block;margin-bottom:16px;"></i>
        Belum ada data klien & mitra.
    </div>
    @endif

</div>

{{-- Modal --}}
<div class="km-modal-overlay" id="kmModalOverlay" onclick="if(event.target===this)closeKmModal()">
    <div class="km-modal">
        <button class="km-modal-close" onclick="closeKmModal()"><i class="fas fa-times"></i></button>
        <div class="km-modal-header">
            <div class="km-modal-logo" id="kmModalLogo"></div>
            <div class="km-modal-info">
                <h3 class="km-modal-name" id="kmModalName"></h3>
                <span class="km-modal-kat" id="kmModalKat"></span>
            </div>
        </div>
        <div class="km-modal-body">
            <p class="km-proj-title"><i class="fas fa-briefcase" style="margin-right:6px;"></i>Proyek / Kegiatan yang Dikerjakan</p>
            <div class="km-proj-list" id="kmProjList"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openKmModal(id) {
    const raw = document.getElementById('km-data-' + id);
    if (!raw) return;
    const data = JSON.parse(raw.textContent);

    // Logo
    const logoEl = document.getElementById('kmModalLogo');
    logoEl.innerHTML = data.logo
        ? `<img src="${data.logo}" alt="${data.nama}">`
        : `<span style="font-size:2rem;font-weight:800;color:#1a6fc4;">${data.inisial}</span>`;

    document.getElementById('kmModalName').textContent = data.nama;
    document.getElementById('kmModalKat').textContent  = data.kategori;

    // Projects
    const list = document.getElementById('kmProjList');
    if (data.proyek.length === 0) {
        list.innerHTML = `<div class="km-empty"><i class="fas fa-folder-open"></i>Belum ada data proyek untuk klien ini.</div>`;
    } else {
        list.innerHTML = data.proyek.map(p => `
            <div class="km-proj-item">
                <p class="km-proj-item-title">${p.judul}</p>
                <div class="km-proj-meta">
                    <span><i class="fas fa-calendar-alt"></i> ${p.tahun}</span>
                    ${p.lokasi ? `<span><i class="fas fa-map-marker-alt"></i> ${p.lokasi}</span>` : ''}
                    ${p.layanan ? `<span><i class="fas fa-tag"></i> ${p.layanan}</span>` : ''}
                </div>
                ${p.deskripsi ? `<p class="km-proj-desc">${p.deskripsi}</p>` : ''}
            </div>
        `).join('');
    }

    document.getElementById('kmModalOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeKmModal() {
    document.getElementById('kmModalOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeKmModal(); });
</script>
@endpush

@endsection
