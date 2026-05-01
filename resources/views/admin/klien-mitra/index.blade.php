@extends('layouts.admin')
@section('title', 'Kelola Klien & Mitra')
@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-handshake" style="color:#1a6fc4;margin-right:10px;"></i>Kelola Klien & Mitra</h1>
    <div style="display:flex;gap:10px;">
        <button id="btnSelectMode" onclick="toggleSelectMode()" class="btn btn-outline" style="border:1px solid #1a56db;color:#1a56db;background:transparent;padding:8px 16px;border-radius:8px;cursor:pointer;font-weight:600;font-size:0.85rem;">
            <i class="fas fa-check-square"></i> Pilih
        </button>
        <a href="{{ route('admin.klien-mitra.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah Klien/Mitra</a>
    </div>
</div>

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

<form id="bulkForm" action="{{ route('admin.klien-mitra.bulk-destroy') }}" method="POST" style="margin:0;">
    @csrf @method('DELETE')
    <div id="bulkToolbar" style="display:none;align-items:center;gap:14px;background:#fff;border:1px solid #1a56db;border-radius:12px;padding:12px 20px;margin-bottom:16px;box-shadow:0 4px 16px rgba(26,86,219,0.1);">
        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:0.85rem;color:#64748b;font-weight:600;">
            <input type="checkbox" id="checkAll" style="width:17px;height:17px;accent-color:#1a56db;" onchange="toggleAll(this)">
            Pilih Semua
        </label>
        <span class="bulk-count" id="bulkCount" style="font-size:0.9rem;font-weight:700;color:#0d2b5e;">0 dipilih</span>
        <button type="button" class="bulk-btn-del" onclick="confirmBulkDelete()" style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:8px;background:#dc2626;color:#fff;font-size:0.85rem;font-weight:700;border:none;cursor:pointer;transition:background 0.2s;">
            <i class="fas fa-trash"></i> Hapus yang Dipilih
        </button>
        <button type="button" class="bulk-btn-cancel" onclick="cancelSelectMode()" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;background:#f1f5f9;color:#64748b;font-size:0.85rem;font-weight:600;border:none;cursor:pointer;transition:background 0.2s;">
            <i class="fas fa-times"></i> Batal
        </button>
    </div>
</form>

<div class="admin-table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th class="col-checkbox" style="display:none;width:40px;text-align:center;"></th>
                <th>#</th>
                <th>Logo</th>
                <th>Nama Instansi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($klienMitras as $i => $km)
        <tr class="km-row">
            <td class="col-checkbox" style="display:none;text-align:center;">
                <input type="checkbox" name="ids[]" value="{{ $km->id }}" form="bulkForm" class="row-check" style="width:16px;height:16px;accent-color:#1a56db;cursor:pointer;">
            </td>
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
        <tr><td colspan="7" style="text-align:center;padding:32px;color:#718096;">Belum ada data klien & mitra.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div style="margin-top: 15px;">
        {{ $klienMitras->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
let selectMode = false;

function toggleSelectMode() {
    selectMode = !selectMode;
    const toolbar  = document.getElementById('bulkToolbar');
    const cols     = document.querySelectorAll('.col-checkbox');
    const btnMode  = document.getElementById('btnSelectMode');

    if (selectMode) {
        toolbar.style.display = 'flex';
        cols.forEach(c => c.style.display = 'table-cell');
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
    document.getElementById('bulkToolbar').style.display = 'none';
    document.querySelectorAll('.col-checkbox').forEach(c => c.style.display = 'none');
    document.querySelectorAll('.row-check').forEach(c => c.checked = false);
    document.querySelectorAll('.km-row').forEach(c => c.style.background = '');
    document.getElementById('checkAll').checked = false;
    updateBulkCount();
    
    const btnMode = document.getElementById('btnSelectMode');
    btnMode.innerHTML = '<i class="fas fa-check-square"></i> Pilih';
    btnMode.style.background = 'transparent';
    btnMode.style.color = '#1a56db';
    btnMode.style.borderColor = '#1a56db';
}

function toggleAll(cb) {
    document.querySelectorAll('.row-check').forEach(c => {
        c.checked = cb.checked;
        c.closest('.km-row').style.background = cb.checked ? '#f0f9ff' : '';
    });
    updateBulkCount();
}

function updateBulkCount() {
    const checked = document.querySelectorAll('.row-check:checked').length;
    const total = document.querySelectorAll('.row-check').length;
    document.getElementById('bulkCount').textContent = checked + ' dipilih';
    document.getElementById('checkAll').indeterminate = checked > 0 && checked < total;
    if (checked === total && total > 0) document.getElementById('checkAll').checked = true;
    else if (checked === 0) document.getElementById('checkAll').checked = false;
}

document.addEventListener('change', function(e) {
    if (e.target.classList.contains('row-check')) {
        e.target.closest('.km-row').style.background = e.target.checked ? '#f0f9ff' : '';
        updateBulkCount();
    }
});

function confirmBulkDelete() {
    const count = document.querySelectorAll('.row-check:checked').length;
    if (count === 0) { alert('Pilih minimal 1 data terlebih dahulu.'); return; }
    if (confirm(count + ' klien/mitra akan dihapus permanen. Lanjutkan?')) {
        document.getElementById('bulkForm').submit();
    }
}
</script>
@endpush
