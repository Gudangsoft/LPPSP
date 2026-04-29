@extends('layouts.app')
@section('title', 'Klien & Mitra')
@section('description', 'Jejaring kerjasama LPPSP bersama Kementerian/Lembaga, Pemerintah Daerah, Lembaga Pendidikan, Dunia Usaha, dan mitra pembangunan lainnya.')

@push('styles')
<style>
/* ── Page ────────────────────────────────────────── */
.km-page { padding-bottom: 80px; background: #f5f7fb; min-height: 80vh; }

/* ── Hero ────────────────────────────────────────── */
.km-hero {
    background: linear-gradient(135deg, #0d2b5e 0%, #1a4a9e 60%, #0f4c81 100%);
    padding: 64px 0 48px;
    position: relative; overflow: hidden;
}
.km-hero::before {
    content: '\f2b5';
    font-family: 'Font Awesome 6 Free'; font-weight: 900;
    position: absolute; right: 7%; top: 50%; transform: translateY(-50%);
    font-size: 13rem; color: rgba(255,255,255,0.04); line-height: 1;
}
.km-hero .container { max-width: 1160px; margin: 0 auto; padding: 0 24px; }
.km-hero-label {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.9); font-size: 0.77rem; font-weight: 700;
    letter-spacing: 1.5px; text-transform: uppercase;
    padding: 6px 18px; border-radius: 50px; margin-bottom: 18px;
}
.km-hero h1 {
    font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 800;
    color: #fff; margin: 0 0 14px; line-height: 1.25;
}
.km-hero p {
    font-size: 1rem; color: rgba(255,255,255,0.75);
    line-height: 1.75; max-width: 580px; margin: 0;
}

/* ── Stats ───────────────────────────────────────── */
.km-stats {
    background: #fff; border-bottom: 1px solid #e8edf5; padding: 18px 0;
}
.km-stats .container {
    max-width: 1160px; margin: 0 auto; padding: 0 24px;
    display: flex; align-items: center; gap: 36px; flex-wrap: wrap;
}
.km-stat-num { font-size: 1.5rem; font-weight: 800; color: #0d2b5e; line-height: 1; }
.km-stat-lbl { font-size: 0.77rem; color: #64748b; font-weight: 600; line-height: 1.3; margin-top: 2px; }
.km-stat-div { width: 1px; height: 34px; background: #e2e8f0; }

/* ── Content ─────────────────────────────────────── */
.km-content { max-width: 1160px; margin: 0 auto; padding: 48px 24px 0; }
.km-section-head {
    margin-bottom: 32px;
}
.km-section-head h2 {
    font-size: 1.6rem; font-weight: 800; color: #0d2b5e; margin: 0 0 6px;
    border-left: 4px solid #1a6fc4; padding-left: 16px;
}
.km-section-head p { font-size: 0.88rem; color: #64748b; margin: 0 0 0 20px; }

/* ── Category grid ───────────────────────────────── */
.km-cat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

/* ── Category card (reference style) ────────────── */
.km-cat-card {
    background: #fff;
    border: 1px solid #e8edf5;
    border-radius: 14px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    cursor: pointer;
    transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}
.km-cat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(13,43,94,0.12);
    border-color: #bae6fd;
}
.km-cat-card::after {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #1a6fc4, #0d2b5e);
    border-radius: 14px 0 0 14px;
    opacity: 0;
    transition: opacity 0.22s;
}
.km-cat-card:hover::after { opacity: 1; }

/* Logo box */
.km-cat-logo {
    width: 64px; height: 64px;
    background: #e8f0fb;
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
    border: 1px solid #dbeafe;
    position: relative;
}
.km-cat-logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
.km-cat-logo-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 3px;
    width: 100%; height: 100%; padding: 6px;
}
.km-cat-logo-grid img {
    width: 100%; height: 100%; object-fit: contain;
    border-radius: 3px;
}
.km-cat-logo-icon {
    font-size: 1.6rem; color: #1a6fc4;
}
.km-cat-count {
    position: absolute; bottom: -3px; right: -3px;
    background: #1a6fc4; color: #fff;
    font-size: 0.6rem; font-weight: 800;
    width: 20px; height: 20px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #fff;
}

/* Text side */
.km-cat-text { flex: 1; min-width: 0; }
.km-cat-name {
    font-size: 0.97rem; font-weight: 800;
    color: #0d2b5e; margin: 0 0 4px;
    line-height: 1.3;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.km-cat-sub {
    font-size: 0.78rem; color: #94a3b8; margin: 0 0 6px;
}
.km-cat-link {
    font-size: 0.78rem; font-weight: 700; color: #1a6fc4;
    display: inline-flex; align-items: center; gap: 4px;
    text-decoration: none;
}
.km-cat-card:hover .km-cat-link { color: #0d2b5e; }

/* ── Client modal ────────────────────────────────── */
.km-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(13,43,94,0.5); backdrop-filter: blur(4px);
    z-index: 8000; align-items: center; justify-content: center; padding: 20px;
}
.km-overlay.open { display: flex; }
.km-modal {
    background: #fff; border-radius: 20px;
    max-width: 780px; width: 100%;
    max-height: 88vh; overflow-y: auto;
    box-shadow: 0 24px 60px rgba(0,0,0,0.22);
    position: relative;
    animation: kmIn 0.26s ease;
}
@keyframes kmIn {
    from { opacity:0; transform:scale(0.94) translateY(16px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}
.km-modal-close {
    position: absolute; top: 14px; right: 14px;
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(0,0,0,0.07); border: none;
    cursor: pointer; display: flex; align-items: center; justify-content: center;
    font-size: 0.9rem; color: #334155; z-index: 2;
    transition: background 0.2s;
}
.km-modal-close:hover { background: rgba(0,0,0,0.14); }

/* Category modal header */
.km-modal-head {
    padding: 26px 28px 18px;
    border-bottom: 1px solid #f1f5f9;
    display: flex; align-items: center; gap: 16px;
}
.km-modal-head-icon {
    width: 52px; height: 52px; border-radius: 12px;
    background: #e8f0fb; display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: #1a6fc4; flex-shrink: 0;
}
.km-modal-head h3 { font-size: 1.2rem; font-weight: 800; color: #0d2b5e; margin: 0 0 4px; }
.km-modal-head p  { font-size: 0.82rem; color: #64748b; margin: 0; }

/* Client list in modal */
.km-client-grid {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px;
    padding: 22px 28px 28px;
}
.km-client-item {
    background: #f8fafc; border: 1px solid #e8edf5; border-radius: 12px;
    padding: 14px 16px;
    display: flex; align-items: center; gap: 14px;
    cursor: pointer; transition: all 0.2s;
}
.km-client-item:hover {
    border-color: #bae6fd; background: #e8f0fb;
    transform: translateY(-2px); box-shadow: 0 6px 18px rgba(13,43,94,0.08);
}
.km-client-logo {
    width: 52px; height: 52px; flex-shrink: 0;
    background: #fff; border-radius: 10px; border: 1px solid #e2eaf8;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.km-client-logo img { max-width: 100%; max-height: 100%; object-fit: contain; }
.km-client-logo-txt { font-size: 1.2rem; font-weight: 800; color: #1a6fc4; }
.km-client-info { flex: 1; min-width: 0; }
.km-client-name {
    font-size: 0.88rem; font-weight: 700; color: #0d2b5e;
    margin: 0 0 3px; line-height: 1.3;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.km-client-proj {
    font-size: 0.74rem; color: #64748b;
    display: flex; align-items: center; gap: 4px;
}
.km-client-arrow {
    color: #cbd5e1; font-size: 0.75rem; flex-shrink: 0;
    transition: color 0.2s, transform 0.2s;
}
.km-client-item:hover .km-client-arrow { color: #1a6fc4; transform: translateX(3px); }

/* ── Project modal ───────────────────────────────── */
.km-proj-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(13,43,94,0.6); backdrop-filter: blur(6px);
    z-index: 9000; align-items: center; justify-content: center; padding: 20px;
}
.km-proj-overlay.open { display: flex; }
.km-proj-modal {
    background: #fff; border-radius: 20px;
    max-width: 720px; width: 100%;
    max-height: 88vh; overflow-y: auto;
    box-shadow: 0 24px 60px rgba(0,0,0,0.25);
    position: relative;
    animation: kmIn 0.26s ease;
}
.km-proj-header {
    display: flex; gap: 18px; align-items: center;
    padding: 26px 28px 20px; border-bottom: 1px solid #f1f5f9;
}
.km-proj-logo-box {
    width: 68px; height: 68px; background: #f0f6ff; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; overflow: hidden; border: 1px solid #e2eaf8;
}
.km-proj-logo-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
.km-proj-modal-name { font-size: 1.2rem; font-weight: 800; color: #0d2b5e; margin: 0 0 5px; }
.km-proj-modal-kat {
    font-size: 0.7rem; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase;
    color: #1a6fc4; background: #e8f0fb; padding: 3px 11px; border-radius: 50px;
    display: inline-block;
}
.km-proj-body { padding: 22px 28px 30px; }
.km-proj-sec-title {
    font-size: 0.73rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
    color: #94a3b8; margin: 0 0 14px; display: flex; align-items: center; gap: 8px;
}
.km-proj-list { display: flex; flex-direction: column; gap: 12px; }
.km-proj-item {
    background: #f8fafc; border: 1px solid #e8edf5; border-radius: 12px; padding: 14px 18px;
}
.km-proj-title-text { font-size: 0.9rem; font-weight: 700; color: #0d2b5e; margin: 0 0 6px; line-height: 1.4; }
.km-proj-meta { display: flex; gap: 12px; flex-wrap: wrap; font-size: 0.77rem; color: #64748b; }
.km-proj-meta span { display: flex; align-items: center; gap: 4px; }
.km-proj-desc { font-size: 0.81rem; color: #64748b; line-height: 1.6; margin-top: 8px; }
.km-no-proj { text-align: center; padding: 32px; color: #94a3b8; }
.km-no-proj i { font-size: 2rem; display: block; margin-bottom: 10px; color: #cbd5e1; }

/* ── Responsive ──────────────────────────────────── */
@media (max-width: 900px) {
    .km-cat-grid { grid-template-columns: repeat(2, 1fr); }
    .km-client-grid { grid-template-columns: 1fr; }
}
@media (max-width: 580px) {
    .km-cat-grid { grid-template-columns: 1fr; }
    .km-cat-card { padding: 14px 16px; }
    .km-modal-head, .km-proj-header { flex-direction: column; text-align: center; }
    .km-client-grid { padding: 16px 18px 22px; }
    .km-proj-body { padding: 16px 18px 24px; }
}
</style>
@endpush

@section('content')

@php
    $iconMap = [
        'Kementerian/Lembaga' => 'landmark',
        'Pemerintah Daerah'   => 'city',
        'OPD/Instansi Teknis' => 'sitemap',
        'Lembaga Pendidikan'  => 'graduation-cap',
        'Dunia Usaha'         => 'briefcase',
        'Lembaga Mitra'       => 'handshake',
    ];

    // Build all client data for JS
    $allClientData = [];
    foreach($grouped as $kat => $clients) {
        foreach($clients as $klien) {
            $proyek = $pengalamanMap[$klien->nama] ?? collect();
            $allClientData[$klien->id] = [
                'nama'     => $klien->nama,
                'kategori' => $klien->kategori,
                'logo'     => $klien->logo ? Storage::url($klien->logo) : '',
                'inisial'  => strtoupper(substr($klien->nama, 0, 1)),
                'proyek'   => $proyek->map(fn($p) => [
                    'judul'     => $p->judul,
                    'tahun'     => $p->tahun,
                    'lokasi'    => $p->lokasi,
                    'layanan'   => $p->layanan?->judul,
                    'deskripsi' => $p->deskripsi,
                ])->values()->toArray(),
            ];
        }
    }
@endphp

<div class="km-page">

    {{-- ── HERO ──────────────────────────────────── --}}
    <section class="km-hero">
        <div class="container">
            <div class="km-hero-label"><i class="fas fa-handshake"></i> Jejaring Kerjasama</div>
            <h1>Klien & Mitra LPPSP</h1>
            <p>LPPSP membuka ruang kolaborasi bersama Kementerian/Lembaga, Pemerintah Daerah, OPD/Instansi Teknis, Lembaga Pendidikan, Dunia Usaha, dan Lembaga Mitra Pembangunan.</p>
        </div>
    </section>

    {{-- ── STATS ──────────────────────────────────── --}}
    @php $totalKlien = $grouped->flatten()->count(); @endphp
    <div class="km-stats">
        <div class="container">
            <div>
                <div class="km-stat-num">{{ $totalKlien }}</div>
                <div class="km-stat-lbl">Total Klien<br>& Mitra</div>
            </div>
            <div class="km-stat-div"></div>
            <div>
                <div class="km-stat-num">{{ $grouped->count() }}</div>
                <div class="km-stat-lbl">Kategori<br>Kerjasama</div>
            </div>
            @php $totalProyek = collect($allClientData)->sum(function($c) { return count($c['proyek']); }); @endphp
            @if($totalProyek)
            <div class="km-stat-div"></div>
            <div>
                <div class="km-stat-num">{{ $totalProyek }}+</div>
                <div class="km-stat-lbl">Proyek<br>Terdokumentasi</div>
            </div>
            @endif
        </div>
    </div>

    {{-- ── CATEGORY GRID ───────────────────────────── --}}
    <div class="km-content">
        <div class="km-section-head">
            <h2>Jejaring Kerjasama</h2>
        </div>

        @if($grouped->isEmpty())
        <div style="text-align:center;padding:60px 20px;color:#64748b;">
            <i class="fas fa-handshake" style="font-size:3rem;color:#cbd5e1;display:block;margin-bottom:16px;"></i>
            Belum ada data klien & mitra.
        </div>
        @else
        <div class="km-cat-grid">
            @foreach($kategoriOrder as $kat)
            @php $clients = $grouped->get($kat, collect()); @endphp
            @if($clients->isEmpty()) @continue @endif
            @php $icon = $iconMap[$kat] ?? 'handshake'; @endphp

            <div class="km-cat-card" onclick="openCatModal('{{ addslashes($kat) }}', '{{ $icon }}', {{ $clients->count() }})">
                {{-- Logo box --}}
                <div class="km-cat-logo">
                    <i class="fas fa-{{ $icon }} km-cat-logo-icon"></i>
                    <span class="km-cat-count">{{ $clients->count() }}</span>
                </div>

                {{-- Text --}}
                <div class="km-cat-text">
                    <p class="km-cat-name">{{ $kat }}</p>
                    <p class="km-cat-sub">{{ $clients->count() }} instansi / lembaga</p>
                    <span class="km-cat-link">Lihat selengkapnya <i class="fas fa-arrow-right" style="font-size:0.65rem;"></i></span>
                </div>
            </div>

            {{-- Hidden client data for this category --}}
            @php
                $catJsonData = $clients->map(function($c) use ($allClientData) {
                    return [
                        'id'          => $c->id,
                        'nama'        => $c->nama,
                        'logo'        => $c->logo ? Storage::url($c->logo) : '',
                        'inisial'     => strtoupper(substr($c->nama, 0, 1)),
                        'proyek_count'=> count($allClientData[$c->id]['proyek'] ?? []),
                    ];
                })->values();
            @endphp
            <script type="application/json" id="cat-data-{{ Str::slug($kat) }}">@json($catJsonData)</script>

            @endforeach
        </div>
        @endif
    </div>

</div>

{{-- ── CATEGORY MODAL ──────────────────────────────── --}}
<div class="km-overlay" id="kmCatOverlay" onclick="if(event.target===this)closeCatModal()">
    <div class="km-modal">
        <button class="km-modal-close" onclick="closeCatModal()"><i class="fas fa-times"></i></button>
        <div class="km-modal-head">
            <div class="km-modal-head-icon" id="catModalIcon"><i class="fas fa-handshake"></i></div>
            <div>
                <h3 id="catModalTitle"></h3>
                <p id="catModalSub"></p>
            </div>
        </div>
        <div class="km-client-grid" id="catClientGrid"></div>
    </div>
</div>

{{-- ── PROJECT MODAL ───────────────────────────────── --}}
<div class="km-proj-overlay" id="kmProjOverlay" onclick="if(event.target===this)closeProjModal()">
    <div class="km-proj-modal">
        <button class="km-modal-close" onclick="closeProjModal()"><i class="fas fa-times"></i></button>
        <div class="km-proj-header">
            <div class="km-proj-logo-box" id="projModalLogo"></div>
            <div>
                <p class="km-proj-modal-name" id="projModalName"></p>
                <span class="km-proj-modal-kat" id="projModalKat"></span>
            </div>
        </div>
        <div class="km-proj-body">
            <p class="km-proj-sec-title"><i class="fas fa-briefcase"></i> Proyek / Kegiatan yang Dikerjakan</p>
            <div class="km-proj-list" id="projList"></div>
        </div>
    </div>
</div>

{{-- All client data for JS --}}
<script type="application/json" id="all-client-data">@json($allClientData)</script>

@push('scripts')
<script>
const allData = JSON.parse(document.getElementById('all-client-data').textContent);

/* ── Category modal ─────────────────────────── */
function openCatModal(kat, icon, count) {
    const slug = kat.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    const raw  = document.getElementById('cat-data-' + slug);
    if (!raw) return;
    const clients = JSON.parse(raw.textContent);

    document.getElementById('catModalIcon').innerHTML = `<i class="fas fa-${icon}"></i>`;
    document.getElementById('catModalTitle').textContent = kat;
    document.getElementById('catModalSub').textContent   = count + ' instansi / lembaga terdaftar';

    const grid = document.getElementById('catClientGrid');
    grid.innerHTML = clients.map(c => `
        <div class="km-client-item" onclick="openProjModal(${c.id})">
            <div class="km-client-logo">
                ${c.logo
                    ? `<img src="${c.logo}" alt="${c.nama}">`
                    : `<span class="km-client-logo-txt">${c.inisial}</span>`}
            </div>
            <div class="km-client-info">
                <p class="km-client-name">${c.nama}</p>
                <span class="km-client-proj">
                    <i class="fas fa-briefcase" style="font-size:.65rem;"></i>
                    ${c.proyek_count > 0 ? c.proyek_count + ' proyek' : 'Lihat detail'}
                </span>
            </div>
            <i class="fas fa-chevron-right km-client-arrow"></i>
        </div>
    `).join('');

    document.getElementById('kmCatOverlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeCatModal() {
    document.getElementById('kmCatOverlay').classList.remove('open');
    document.body.style.overflow = '';
}

/* ── Project modal ──────────────────────────── */
function openProjModal(id) {
    const data = allData[id];
    if (!data) return;

    const logoEl = document.getElementById('projModalLogo');
    logoEl.innerHTML = data.logo
        ? `<img src="${data.logo}" alt="${data.nama}">`
        : `<span style="font-size:1.8rem;font-weight:800;color:#1a6fc4;">${data.inisial}</span>`;

    document.getElementById('projModalName').textContent = data.nama;
    document.getElementById('projModalKat').textContent  = data.kategori;

    const list = document.getElementById('projList');
    if (!data.proyek.length) {
        list.innerHTML = `<div class="km-no-proj"><i class="fas fa-folder-open"></i>Belum ada data proyek.</div>`;
    } else {
        list.innerHTML = data.proyek.map(p => `
            <div class="km-proj-item">
                <p class="km-proj-title-text">${p.judul}</p>
                <div class="km-proj-meta">
                    <span><i class="fas fa-calendar-alt"></i> ${p.tahun ?? '-'}</span>
                    ${p.lokasi  ? `<span><i class="fas fa-map-marker-alt"></i> ${p.lokasi}</span>` : ''}
                    ${p.layanan ? `<span><i class="fas fa-tag"></i> ${p.layanan}</span>` : ''}
                </div>
                ${p.deskripsi ? `<p class="km-proj-desc">${p.deskripsi}</p>` : ''}
            </div>
        `).join('');
    }

    document.getElementById('kmProjOverlay').classList.add('open');
}

function closeProjModal() {
    document.getElementById('kmProjOverlay').classList.remove('open');
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeProjModal(); closeCatModal(); }
});
</script>
@endpush

@endsection
