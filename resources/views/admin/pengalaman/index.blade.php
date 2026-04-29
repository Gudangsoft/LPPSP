@extends('layouts.admin')
@section('title', 'Kelola Pengalaman')

@push('styles')
<style>
    .peng-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .peng-stat-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 2px 8px rgba(13,43,94,0.05);
    }
    .peng-stat-icon {
        width: 44px; height: 44px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .peng-stat-val { font-size: 1.6rem; font-weight: 800; color: #0d2b5e; line-height: 1; }
    .peng-stat-lbl { font-size: 0.75rem; color: #64748b; margin-top: 3px; }

    .peng-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }
    .peng-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(13,43,94,0.05);
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .peng-card:hover {
        box-shadow: 0 8px 28px rgba(13,43,94,0.11);
        transform: translateY(-2px);
    }
    .peng-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px 0;
        flex-wrap: wrap;
        gap: 8px;
    }
    .peng-layanan-badge {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #1a56db;
        background: #e8f0fb;
        padding: 3px 12px;
        border-radius: 50px;
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .peng-tahun-badge {
        font-size: 0.78rem;
        font-weight: 700;
        color: #0d2b5e;
        background: #f1f5f9;
        padding: 3px 12px;
        border-radius: 50px;
        display: flex; align-items: center; gap: 4px;
    }
    .peng-card-body { padding: 12px 18px 16px; }
    .peng-card-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0d2b5e;
        line-height: 1.4;
        margin: 0 0 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .peng-meta { display: flex; flex-direction: column; gap: 5px; }
    .peng-meta-row {
        display: flex; align-items: flex-start; gap: 7px;
        font-size: 0.8rem; color: #475569; line-height: 1.4;
    }
    .peng-meta-row i { color: #94a3b8; width: 14px; flex-shrink: 0; margin-top: 2px; }
    .peng-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        border-top: 1px solid #f1f5f9;
        background: #fafbfc;
    }
    .peng-badge-aktif   { background: #dcfce7; color: #16a34a; font-size: 0.7rem; font-weight: 700; padding: 3px 10px; border-radius: 50px; }
    .peng-badge-nonaktif{ background: #fee2e2; color: #dc2626; font-size: 0.7rem; font-weight: 700; padding: 3px 10px; border-radius: 50px; }
    .peng-badge-unggulan{ background: #fef3c7; color: #d97706; font-size: 0.7rem; font-weight: 700; padding: 3px 10px; border-radius: 50px; margin-left: 4px; }
    .peng-actions { display: flex; gap: 8px; }
    .peng-btn-edit {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 600;
        padding: 5px 12px; border-radius: 8px;
        background: #e8f0fb; color: #1a56db;
        text-decoration: none; transition: background 0.2s;
        border: none; cursor: pointer;
    }
    .peng-btn-edit:hover { background: #dbeafe; }
    .peng-btn-del {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 0.75rem; font-weight: 600;
        padding: 5px 12px; border-radius: 8px;
        background: #fee2e2; color: #dc2626;
        border: none; cursor: pointer; transition: background 0.2s;
    }
    .peng-btn-del:hover { background: #fecaca; }
    .peng-empty {
        grid-column: 1 / -1;
        text-align: center; padding: 60px 20px;
        color: #94a3b8;
    }
    .peng-empty i { font-size: 3rem; display: block; margin-bottom: 14px; color: #cbd5e1; }

    /* Checkbox select */
    .peng-card { position: relative; }
    .peng-check-wrap {
        position: absolute;
        top: 12px; left: 12px;
        z-index: 2;
    }
    .peng-check-wrap input[type=checkbox] {
        width: 18px; height: 18px;
        accent-color: #1a56db;
        cursor: pointer;
    }
    .peng-card.selected {
        border-color: #1a56db;
        box-shadow: 0 0 0 2px rgba(26,86,219,0.18), 0 8px 28px rgba(13,43,94,0.11);
    }

    /* Bulk toolbar */
    #bulkToolbar {
        display: none;
        align-items: center;
        gap: 14px;
        background: #fff;
        border: 1px solid #1a56db;
        border-radius: 12px;
        padding: 12px 20px;
        margin-bottom: 16px;
        box-shadow: 0 4px 16px rgba(26,86,219,0.1);
    }
    #bulkToolbar.visible { display: flex; }
    .bulk-count {
        font-size: 0.9rem; font-weight: 700; color: #0d2b5e;
    }
    .bulk-btn-del {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 18px; border-radius: 8px;
        background: #dc2626; color: #fff;
        font-size: 0.85rem; font-weight: 700;
        border: none; cursor: pointer; transition: background 0.2s;
    }
    .bulk-btn-del:hover { background: #b91c1c; }
    .bulk-btn-cancel {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 16px; border-radius: 8px;
        background: #f1f5f9; color: #64748b;
        font-size: 0.85rem; font-weight: 600;
        border: none; cursor: pointer; transition: background 0.2s;
    }
    .bulk-btn-cancel:hover { background: #e2e8f0; }

    @media (max-width: 900px) { .peng-grid { grid-template-columns: 1fr; } }
    @media (max-width: 700px) { .peng-stats { grid-template-columns: repeat(2, 1fr); } }
</style>
@endpush

@section('content')

<div class="admin-page-header">
    <h1><i class="fas fa-briefcase" style="color:#1a6fc4;margin-right:10px;"></i>Kelola Pengalaman</h1>
    <div style="display:flex;gap:10px;">
        <button id="btnSelectMode" onclick="toggleSelectMode()" class="btn btn-outline">
            <i class="fas fa-check-square"></i> Pilih
        </button>
        <button onclick="document.getElementById('importModal').style.display='flex'" class="btn btn-outline">
            <i class="fas fa-file-excel"></i> Import Excel
        </button>
        <a href="{{ route('admin.pengalaman.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</a>
    </div>
</div>

{{-- Flash messages --}}
@if(session('success'))
<div style="background:#dcfce7;border:1px solid #86efac;color:#16a34a;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif
@if(session('warning'))
<div style="background:#fef3c7;border:1px solid #fcd34d;color:#d97706;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
</div>
@endif

{{-- Stats --}}
@php
    $total    = $pengalamans->total();
    $aktif    = \App\Models\Pengalaman::where('aktif', true)->count();
    $unggulan = \App\Models\Pengalaman::where('unggulan', true)->count();
    $tahunMin = \App\Models\Pengalaman::min('tahun');
@endphp
<div class="peng-stats">
    <div class="peng-stat-card">
        <div class="peng-stat-icon" style="background:#e8f0fb;">
            <i class="fas fa-briefcase" style="color:#1a56db;"></i>
        </div>
        <div>
            <div class="peng-stat-val">{{ \App\Models\Pengalaman::count() }}</div>
            <div class="peng-stat-lbl">Total Pengalaman</div>
        </div>
    </div>
    <div class="peng-stat-card">
        <div class="peng-stat-icon" style="background:#dcfce7;">
            <i class="fas fa-check-circle" style="color:#16a34a;"></i>
        </div>
        <div>
            <div class="peng-stat-val">{{ $aktif }}</div>
            <div class="peng-stat-lbl">Aktif di Website</div>
        </div>
    </div>
    <div class="peng-stat-card">
        <div class="peng-stat-icon" style="background:#fef3c7;">
            <i class="fas fa-star" style="color:#d97706;"></i>
        </div>
        <div>
            <div class="peng-stat-val">{{ $unggulan }}</div>
            <div class="peng-stat-lbl">Unggulan</div>
        </div>
    </div>
    <div class="peng-stat-card">
        <div class="peng-stat-icon" style="background:#f3e8ff;">
            <i class="fas fa-calendar-alt" style="color:#7c3aed;"></i>
        </div>
        <div>
            <div class="peng-stat-val">{{ $tahunMin ?? '—' }}</div>
            <div class="peng-stat-lbl">Tahun Pertama</div>
        </div>
    </div>
</div>

{{-- Search & Filter Bar --}}
<form method="GET" action="{{ route('admin.pengalaman.index') }}" id="searchForm">
<div style="background:#fff;border:1px solid #e8edf5;border-radius:14px;padding:16px 20px;margin-bottom:20px;box-shadow:0 2px 8px rgba(13,43,94,0.05);">
    <div style="display:grid;grid-template-columns:1fr 180px 180px auto;gap:12px;align-items:end;">

        {{-- Keyword --}}
        <div>
            <label style="font-size:0.75rem;font-weight:700;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.5px;">Cari</label>
            <div style="position:relative;">
                <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:0.85rem;"></i>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Judul, klien, lokasi..."
                    style="width:100%;padding:9px 12px 9px 34px;border:1px solid #e2e8f0;border-radius:8px;font-size:0.88rem;outline:none;transition:border 0.2s;box-sizing:border-box;"
                    onfocus="this.style.borderColor='#1a6fc4'" onblur="this.style.borderColor='#e2e8f0'">
            </div>
        </div>

        {{-- Filter Layanan --}}
        <div>
            <label style="font-size:0.75rem;font-weight:700;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.5px;">Layanan</label>
            <select name="layanan_id" onchange="this.form.submit()"
                style="width:100%;padding:9px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:0.88rem;outline:none;background:#fff;box-sizing:border-box;">
                <option value="">Semua Layanan</option>
                @foreach($layanans as $lay)
                <option value="{{ $lay->id }}" {{ request('layanan_id') == $lay->id ? 'selected' : '' }}>
                    {{ Str::limit($lay->judul, 28) }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Tahun --}}
        <div>
            <label style="font-size:0.75rem;font-weight:700;color:#64748b;display:block;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.5px;">Tahun</label>
            <select name="tahun" onchange="this.form.submit()"
                style="width:100%;padding:9px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:0.88rem;outline:none;background:#fff;box-sizing:border-box;">
                <option value="">Semua Tahun</option>
                @foreach($tahunList as $t)
                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tombol --}}
        <div style="display:flex;gap:8px;">
            <button type="submit" style="display:inline-flex;align-items:center;gap:6px;padding:9px 18px;background:linear-gradient(135deg,#0d2b5e,#1a6fc4);color:#fff;border:none;border-radius:8px;font-size:0.85rem;font-weight:600;cursor:pointer;white-space:nowrap;">
                <i class="fas fa-search"></i> Cari
            </button>
            @if(request('q') || request('layanan_id') || request('tahun'))
            <a href="{{ route('admin.pengalaman.index') }}" style="display:inline-flex;align-items:center;gap:6px;padding:9px 14px;background:#f1f5f9;color:#64748b;border-radius:8px;font-size:0.85rem;font-weight:600;text-decoration:none;white-space:nowrap;">
                <i class="fas fa-times"></i>
            </a>
            @endif
        </div>
    </div>

    {{-- Active filters summary --}}
    @if(request('q') || request('layanan_id') || request('tahun'))
    <div style="margin-top:12px;padding-top:12px;border-top:1px solid #f1f5f9;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
        <span style="font-size:0.75rem;color:#94a3b8;font-weight:600;">Filter aktif:</span>
        @if(request('q'))
        <span style="background:#e8f0fb;color:#1a56db;font-size:0.75rem;font-weight:600;padding:3px 12px;border-radius:50px;">
            "{{ request('q') }}"
        </span>
        @endif
        @if(request('layanan_id'))
        <span style="background:#dcfce7;color:#16a34a;font-size:0.75rem;font-weight:600;padding:3px 12px;border-radius:50px;">
            {{ $layanans->firstWhere('id', request('layanan_id'))?->judul ?? 'Layanan' }}
        </span>
        @endif
        @if(request('tahun'))
        <span style="background:#fef3c7;color:#d97706;font-size:0.75rem;font-weight:600;padding:3px 12px;border-radius:50px;">
            {{ request('tahun') }}
        </span>
        @endif
        <span style="font-size:0.78rem;color:#64748b;">— {{ $pengalamans->total() }} hasil ditemukan</span>
    </div>
    @endif
</div>
</form>

{{-- Bulk Toolbar --}}
<form id="bulkForm" action="{{ route('admin.pengalaman.bulk-destroy') }}" method="POST" style="margin:0;">
    @csrf @method('DELETE')
    <div id="bulkToolbar">
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:0.85rem;color:#64748b;font-weight:600;">
            <input type="checkbox" id="checkAll" style="width:17px;height:17px;accent-color:#1a56db;" onchange="toggleAll(this)">
            Pilih Semua
        </label>
        <span class="bulk-count" id="bulkCount">0 dipilih</span>
        <button type="button" class="bulk-btn-del" onclick="confirmBulkDelete()">
            <i class="fas fa-trash"></i> Hapus yang Dipilih
        </button>
        <button type="button" class="bulk-btn-cancel" onclick="cancelSelectMode()">
            <i class="fas fa-times"></i> Batal
        </button>
    </div>
</form>

{{-- Card Grid --}}
<div class="peng-grid" id="pengGrid">
    @forelse($pengalamans as $p)
    <div class="peng-card" data-id="{{ $p->id }}">
        <div class="peng-check-wrap" style="display:none;">
            <input type="checkbox" name="ids[]" value="{{ $p->id }}" form="bulkForm" class="card-check" onchange="updateBulkCount()">
        </div>
        <div class="peng-card-top">
            @if($p->layanan)
                <span class="peng-layanan-badge"><i class="fas fa-tag" style="margin-right:4px;"></i>{{ $p->layanan->judul }}</span>
            @else
                <span style="color:#cbd5e1;font-size:0.75rem;font-style:italic;">Belum dikategorikan</span>
            @endif
            <span class="peng-tahun-badge"><i class="fas fa-calendar"></i> {{ $p->tahun }}</span>
        </div>

        <div class="peng-card-body">
            <h4 class="peng-card-title" title="{{ $p->judul }}">{{ $p->judul }}</h4>
            <div class="peng-meta">
                <div class="peng-meta-row">
                    <i class="fas fa-building"></i>
                    <span>{{ $p->klien }}</span>
                </div>
                @if($p->lokasi)
                <div class="peng-meta-row">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $p->lokasi }}</span>
                </div>
                @endif
                @if($p->target_sasaran)
                <div class="peng-meta-row">
                    <i class="fas fa-users"></i>
                    <span>{{ Str::limit($p->target_sasaran, 70) }}</span>
                </div>
                @endif
            </div>
        </div>

        <div class="peng-card-footer">
            <div style="display:flex;align-items:center;gap:4px;">
                <span class="{{ $p->aktif ? 'peng-badge-aktif' : 'peng-badge-nonaktif' }}">
                    {{ $p->aktif ? 'Aktif' : 'Nonaktif' }}
                </span>
                @if($p->unggulan)
                <span class="peng-badge-unggulan"><i class="fas fa-star" style="font-size:0.65rem;"></i> Unggulan</span>
                @endif
            </div>
            <div class="peng-actions">
                <a href="{{ route('admin.pengalaman.edit', $p) }}" class="peng-btn-edit">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.pengalaman.destroy', $p) }}" method="POST" style="margin:0;">
                    @csrf @method('DELETE')
                    <button type="submit" class="peng-btn-del" data-confirm="Hapus pengalaman ini?">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="peng-empty">
        <i class="fas fa-folder-open"></i>
        <p style="font-weight:600;margin:0 0 6px;">Belum ada data pengalaman</p>
        <p style="font-size:0.85rem;margin:0;">Klik <strong>Tambah</strong> atau <strong>Import Excel</strong> untuk memulai.</p>
    </div>
    @endforelse
</div>

@push('scripts')
<script>
let selectMode = false;

function toggleSelectMode() {
    selectMode = !selectMode;
    const toolbar  = document.getElementById('bulkToolbar');
    const checks   = document.querySelectorAll('.peng-check-wrap');
    const btnMode  = document.getElementById('btnSelectMode');

    if (selectMode) {
        toolbar.classList.add('visible');
        checks.forEach(c => c.style.display = 'block');
        btnMode.innerHTML = '<i class="fas fa-times"></i> Batal';
        btnMode.style.background = '#fee2e2';
        btnMode.style.color = '#dc2626';
        btnMode.style.borderColor = '#fca5a5';
    } else {
        cancelSelectMode();
    }
}

function cancelSelectMode() {
    selectMode = false;
    document.getElementById('bulkToolbar').classList.remove('visible');
    document.querySelectorAll('.peng-check-wrap').forEach(c => c.style.display = 'none');
    document.querySelectorAll('.card-check').forEach(c => c.checked = false);
    document.querySelectorAll('.peng-card').forEach(c => c.classList.remove('selected'));
    document.getElementById('checkAll').checked = false;
    updateBulkCount();
    const btnMode = document.getElementById('btnSelectMode');
    btnMode.innerHTML = '<i class="fas fa-check-square"></i> Pilih';
    btnMode.style.background = '';
    btnMode.style.color = '';
    btnMode.style.borderColor = '';
}

function toggleAll(cb) {
    document.querySelectorAll('.card-check').forEach(c => {
        c.checked = cb.checked;
        c.closest('.peng-card').classList.toggle('selected', cb.checked);
    });
    updateBulkCount();
}

function updateBulkCount() {
    const checked = document.querySelectorAll('.card-check:checked').length;
    document.getElementById('bulkCount').textContent = checked + ' dipilih';
    document.getElementById('checkAll').indeterminate =
        checked > 0 && checked < document.querySelectorAll('.card-check').length;
    if (checked === document.querySelectorAll('.card-check').length && checked > 0)
        document.getElementById('checkAll').checked = true;
    else if (checked === 0)
        document.getElementById('checkAll').checked = false;
}

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('card-check')) {
        e.target.closest('.peng-card').classList.toggle('selected', e.target.checked);
        updateBulkCount();
    }
});

function confirmBulkDelete() {
    const count = document.querySelectorAll('.card-check:checked').length;
    if (count === 0) { alert('Pilih minimal 1 data terlebih dahulu.'); return; }
    if (confirm(count + ' data pengalaman akan dihapus permanen. Lanjutkan?')) {
        document.getElementById('bulkForm').submit();
    }
}
</script>
@endpush

{{-- Pagination --}}
@if($pengalamans->lastPage() > 1)
<div style="margin-top:28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <span style="font-size:0.85rem;color:#64748b;">
        Menampilkan {{ $pengalamans->firstItem() }}–{{ $pengalamans->lastItem() }} dari {{ $pengalamans->total() }} data
    </span>
    <div style="display:flex;gap:6px;align-items:center;">
        @if(!$pengalamans->onFirstPage())
        <a href="{{ $pengalamans->previousPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;border:1px solid #e2e8f0;color:#374151;text-decoration:none;font-size:0.85rem;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a6fc4';this.style.color='#1a6fc4'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151'">
            <i class="fas fa-chevron-left"></i>
        </a>
        @endif
        @for($i = max(1,$pengalamans->currentPage()-2); $i <= min($pengalamans->lastPage(),$pengalamans->currentPage()+2); $i++)
        <a href="{{ $pengalamans->url($i) }}" style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;font-size:0.85rem;font-weight:600;text-decoration:none;transition:all 0.2s;{{ $i === $pengalamans->currentPage() ? 'background:linear-gradient(135deg,#0d2b5e,#1a6fc4);color:#fff;border:none;box-shadow:0 4px 10px rgba(13,43,94,0.25);' : 'border:1px solid #e2e8f0;color:#374151;' }}">{{ $i }}</a>
        @endfor
        @if($pengalamans->hasMorePages())
        <a href="{{ $pengalamans->nextPageUrl() }}" style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;border:1px solid #e2e8f0;color:#374151;text-decoration:none;font-size:0.85rem;transition:all 0.2s;" onmouseover="this.style.borderColor='#1a6fc4';this.style.color='#1a6fc4'" onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151'">
            <i class="fas fa-chevron-right"></i>
        </a>
        @endif
    </div>
</div>
@endif

{{-- Import Modal --}}
<div id="importModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;padding:20px;">
    <div style="background:#fff;border-radius:16px;max-width:540px;width:100%;box-shadow:0 24px 60px rgba(0,0,0,0.2);overflow:hidden;">
        <div style="background:linear-gradient(135deg,#0d2b5e,#1a6fc4);padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
            <h3 style="color:#fff;margin:0;font-size:1.1rem;"><i class="fas fa-file-excel" style="margin-right:8px;"></i>Import Pengalaman dari Excel</h3>
            <button onclick="document.getElementById('importModal').style.display='none'" style="background:none;border:none;color:#fff;font-size:1.3rem;cursor:pointer;">&times;</button>
        </div>
        <div style="padding:24px;">
            <div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:10px;padding:16px;margin-bottom:20px;">
                <p style="font-weight:700;color:#0369a1;margin:0 0 10px;font-size:0.9rem;"><i class="fas fa-info-circle"></i> Format Kolom Excel (urutan wajib)</p>
                <table style="width:100%;font-size:0.8rem;border-collapse:collapse;">
                    <tr style="background:#e0f2fe;">
                        <th style="padding:5px 8px;text-align:left;">Kolom</th>
                        <th style="padding:5px 8px;text-align:left;">Field</th>
                        <th style="padding:5px 8px;text-align:left;">Ket.</th>
                    </tr>
                    <tr><td style="padding:5px 8px;color:#64748b;">A</td><td style="padding:5px 8px;">No</td><td style="padding:5px 8px;color:#94a3b8;">Diabaikan</td></tr>
                    <tr style="background:#f8fafc;"><td style="padding:5px 8px;color:#64748b;">B</td><td style="padding:5px 8px;">Layanan Utama</td><td style="padding:5px 8px;color:#94a3b8;">Opsional</td></tr>
                    <tr><td style="padding:5px 8px;color:#64748b;">C</td><td style="padding:5px 8px;">Judul Pekerjaan</td><td style="padding:5px 8px;color:#e11d48;font-weight:600;">Wajib</td></tr>
                    <tr style="background:#f8fafc;"><td style="padding:5px 8px;color:#64748b;">D</td><td style="padding:5px 8px;">Target/Kelompok Sasaran</td><td style="padding:5px 8px;color:#94a3b8;">Opsional</td></tr>
                    <tr><td style="padding:5px 8px;color:#64748b;">E</td><td style="padding:5px 8px;">Klien/Pemberi Pekerjaan</td><td style="padding:5px 8px;color:#e11d48;font-weight:600;">Wajib</td></tr>
                    <tr style="background:#f8fafc;"><td style="padding:5px 8px;color:#64748b;">F</td><td style="padding:5px 8px;">Lokasi</td><td style="padding:5px 8px;color:#94a3b8;">Opsional</td></tr>
                    <tr><td style="padding:5px 8px;color:#64748b;">G</td><td style="padding:5px 8px;">Tahun Pelaksanaan</td><td style="padding:5px 8px;color:#e11d48;font-weight:600;">Wajib</td></tr>
                    <tr style="background:#f8fafc;"><td style="padding:5px 8px;color:#64748b;">H</td><td style="padding:5px 8px;">Deskripsi Singkat</td><td style="padding:5px 8px;color:#94a3b8;">Opsional</td></tr>
                </table>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;flex-wrap:wrap;gap:8px;">
                    <p style="margin:0;font-size:0.78rem;color:#64748b;"><i class="fas fa-lightbulb"></i> Baris 1 = header, akan dilewati. Format: <strong>.xlsx / .xls / .csv</strong></p>
                    <a href="{{ route('admin.pengalaman.template') }}" style="display:inline-flex;align-items:center;gap:6px;color:#16a34a;font-size:0.8rem;font-weight:600;text-decoration:none;">
                        <i class="fas fa-download"></i> Download Template
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.pengalaman.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Pilih File Excel</label>
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                </div>
                <div style="display:flex;gap:10px;margin-top:16px;">
                    <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Import Sekarang</button>
                    <button type="button" onclick="document.getElementById('importModal').style.display='none'" class="btn btn-outline">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
