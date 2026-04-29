@extends('layouts.admin')
@section('title', 'Profil Lembaga')

@push('styles')
<style>
    .admin-page-header {
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .profile-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 24px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 0;
        overflow-x: auto;
    }
    .tab-btn {
        background: transparent;
        border: none;
        padding: 12px 20px;
        font-size: 0.95rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .tab-btn:hover {
        color: #1a6fc4;
    }
    .tab-btn.active {
        color: #1a6fc4;
        border-bottom-color: #1a6fc4;
    }
    .tab-pane {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }
    .tab-pane.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .admin-form-card {
        background: #fff;
        border-radius: 12px;
        padding: 28px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        margin-bottom: 24px;
    }
    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0d2b5e;
        margin-top: 0;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
    }

    /* Improved Upload Area */
    .upload-container {
        display: grid;
        grid-template-columns: 200px 1fr;
        gap: 24px;
        align-items: start;
    }
    .preview-box {
        background: #f8fafc;
        border: 2px dashed #e2e8f0;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 16px;
        min-height: 180px;
        position: relative;
    }
    .preview-box img {
        max-width: 100%;
        max-height: 150px;
        border-radius: 6px;
        object-fit: contain;
    }
    .preview-placeholder {
        color: #94a3b8;
        text-align: center;
        font-size: 0.85rem;
    }
    .preview-placeholder i {
        font-size: 2rem;
        margin-bottom: 8px;
        opacity: 0.5;
    }
    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        padding: 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafbfc;
        position: relative;
    }
    .upload-area:hover {
        border-color: #1a6fc4;
        background: rgba(26, 111, 196, 0.03);
    }
    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
    }
    .upload-area i {
        font-size: 2rem;
        color: #94a3b8;
        margin-bottom: 12px;
    }
    .save-bar {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 20px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 -4px 12px rgba(0,0,0,0.03);
        position: sticky;
        bottom: 24px;
        z-index: 10;
    }

    @media (max-width: 768px) {
        .upload-container { grid-template-columns: 1fr; }
        .save-bar { flex-direction: column; gap: 16px; text-align: center; }
        .save-bar button { width: 100%; }
    }
    
    .sortable-ghost {
        opacity: 0.4;
        border: 2px solid #1a6fc4 !class;
    }
    .drag-handle {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255,255,255,0.8);
        width: 24px;
        height: 24px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: move;
        z-index: 10;
        color: #64748b;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
@endpush

@section('content')
<div class="admin-page-header">
    <h1><i class="fas fa-building" style="color:#1a6fc4;margin-right:10px;"></i>Profil Lembaga</h1>
</div>

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div style="background:#e8f0fb;border:1px solid #bae6fd;border-radius:10px;padding:11px 16px;margin-bottom:20px;font-size:0.83rem;color:#0369a1;display:flex;align-items:center;gap:10px;">
        <i class="fas fa-info-circle"></i>
        Pengaturan <strong>Kontak, Media Sosial, Logo & Favicon</strong> telah dipindahkan ke
        <a href="{{ route('admin.setting.index') }}" style="font-weight:700;color:#1a6fc4;text-decoration:underline;">Pengaturan Website</a>.
    </div>

    <div class="profile-tabs">
        <button type="button" class="tab-btn active" data-target="tab-info"><i class="fas fa-info-circle" style="margin-right:6px;"></i>Informasi Dasar</button>
        <button type="button" class="tab-btn" data-target="tab-halaman"><i class="fas fa-desktop" style="margin-right:6px;"></i>Teks Halaman</button>
        <button type="button" class="tab-btn" data-target="tab-media"><i class="fas fa-photo-video" style="margin-right:6px;"></i>Gambar & Media</button>
        <button type="button" class="tab-btn" data-target="tab-ketua"><i class="fas fa-user-tie" style="margin-right:6px;"></i>Sambutan Ketua</button>
    </div>

    <!-- TAB: INFORMASI DASAR -->
    <div id="tab-info" class="tab-pane active">
        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-building"></i> Identitas Lembaga</h3>
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Nama Lembaga <span>*</span></label>
                    <input type="text" name="nama_lembaga" class="form-control @error('nama_lembaga') is-invalid @enderror" value="{{ old('nama_lembaga', $profile->nama_lembaga) }}" required>
                    @error('nama_lembaga')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Singkatan</label>
                    <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan', $profile->singkatan) }}">
                </div>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-book-open"></i> Tentang & Sejarah</h3>
            <div class="form-group">
                <label class="form-label">Tentang Kami</label>
                <textarea name="tentang_kami" class="form-control" rows="6" placeholder="Penjelasan lengkap mengenai profil lembaga...">{{ old('tentang_kami', $profile->tentang_kami) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Sejarah</label>
                <textarea name="sejarah" class="form-control" rows="6" placeholder="Latar belakang dan sejarah berdirinya lembaga...">{{ old('sejarah', $profile->sejarah) }}</textarea>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-bullseye"></i> Visi & Misi</h3>
            <div class="form-group">
                <label class="form-label">Visi</label>
                <textarea name="visi" class="form-control" rows="3">{{ old('visi', $profile->visi) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Misi (Satu per baris disarankan)</label>
                <textarea name="misi" class="form-control" rows="6">{{ old('misi', $profile->misi) }}</textarea>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-file-contract"></i> Legalitas Singkat</h3>
            <div class="form-group">
                <label class="form-label">Isi Legalitas (Satu item per baris)</label>
                <textarea name="legalitas" class="form-control" rows="7" placeholder="Bentuk Lembaga: Lembaga Swadaya Masyarakat (LSM)&#10;Akta Pendirian: Nomor 11, tanggal 22 Mei 1998&#10;...">{{ old('legalitas', $profile->legalitas) }}</textarea>
                <small style="color:#64748b;margin-top:4px;display:block;">Tulis setiap poin pada baris baru. Contoh: "Akta Pendirian: Nomor 11, tanggal 22 Mei 1998"</small>
            </div>
        </div>
    </div>

    <!-- TAB: TEKS HALAMAN -->
    <div id="tab-halaman" class="tab-pane">
        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-home"></i> Halaman Beranda (Hero Section)</h3>
            <div class="form-group">
                <label class="form-label">Teks Badge (Label Kecil)</label>
                <input type="text" name="hero_badge" class="form-control" value="{{ old('hero_badge', $profile->hero_badge) }}" placeholder="Contoh: Lembaga Pengkajian & Pengembangan">
            </div>
            <div class="form-group">
                <label class="form-label">Judul Utama (Tagline)</label>
                <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $profile->tagline) }}" placeholder="Contoh: Mitra Profesional dalam Pengkajian...">
                <small style="color:#64748b;margin-top:4px;display:block;">Gunakan &lt;span&gt;teks&lt;/span&gt; untuk memberikan warna biru khusus pada kata tertentu.</small>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="deskripsi_singkat" class="form-control" rows="4">{{ old('deskripsi_singkat', $profile->deskripsi_singkat) }}</textarea>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-hands-helping"></i> Halaman Layanan</h3>
            <div class="form-group">
                <label class="form-label">Teks Deskripsi Halaman Layanan</label>
                <textarea name="deskripsi_layanan" class="form-control" rows="4" placeholder="Masukkan deskripsi untuk ditampilkan di bagian atas halaman Layanan...">{{ old('deskripsi_layanan', $profile->deskripsi_layanan) }}</textarea>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-briefcase"></i> Halaman Pengalaman</h3>
            <div class="form-group">
                <label class="form-label">Teks Deskripsi Halaman Pengalaman</label>
                <textarea name="deskripsi_pengalaman" class="form-control" rows="4" placeholder="Masukkan deskripsi untuk ditampilkan di bagian atas halaman Pengalaman...">{{ old('deskripsi_pengalaman', $profile->deskripsi_pengalaman) }}</textarea>
            </div>
        </div>
    </div>

    <!-- TAB: GAMBAR & MEDIA -->
    <div id="tab-media" class="tab-pane">
        
        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-images"></i> Gambar Utama Beranda (Slider)</h3>
            <p style="font-size:0.85rem; color:#64748b; margin-bottom:16px;">Anda dapat mengunggah lebih dari satu gambar untuk membuat slider/carousel bergulir. Pilih gambar yang ingin dihapus dengan mencentang kotaknya.</p>
            
            @if($profile->hero_images && count($profile->hero_images) > 0)
            <div id="sortable-hero-images" style="display:flex; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
                @foreach($profile->hero_images as $index => $img)
                <div class="sortable-item" data-path="{{ $img }}" style="position:relative; width:150px; height:100px; border-radius:8px; overflow:hidden; border:2px solid #e2e8f0; box-shadow:0 2px 4px rgba(0,0,0,0.05); cursor: grab;">
                    <div class="drag-handle"><i class="fas fa-arrows-alt"></i></div>
                    <img src="{{ Storage::url($img) }}" style="width:100%; height:100%; object-fit:cover;">
                    <label style="position:absolute; bottom:0; left:0; right:0; background:rgba(229, 62, 62, 0.9); color:white; font-size:0.75rem; text-align:center; padding:4px; cursor:pointer; margin:0; z-index:11;">
                        <input type="checkbox" name="remove_hero_images[]" value="{{ $img }}" style="margin-right:4px;"> Hapus
                    </label>
                </div>
                @endforeach
            </div>
            <input type="hidden" name="hero_images_order" id="hero_images_order">
            @endif

            <div class="upload-area" style="grid-column: 1 / -1;">
                <input type="file" name="hero_images[]" accept="image/*" multiple id="heroImagesInput" onchange="previewSliderUpload(this)">
                <i class="fas fa-cloud-upload-alt"></i>
                <p><strong>Klik atau seret file</strong> gambar Beranda (Bisa pilih lebih dari satu file)</p>
                <p style="font-size:0.8rem;color:#94a3b8;margin-top:8px;">
                    <i class="fas fa-info-circle"></i> Rekomendasi: <strong>800 x 1000 px</strong> (Rasio 4:5) atau <strong>1000 x 1000 px</strong> (Kotak).<br>
                    Maks. 4MB per gambar (Format: JPG, PNG, WebP)
                </p>
                <div id="newSliderPreview" style="display:flex; flex-wrap:wrap; gap:12px; justify-content:center; margin-top:16px;"></div>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-info-circle"></i> Gambar Tentang Kami</h3>
            <div class="upload-container">
                <div class="preview-box">
                    @if($profile->foto_tentang_kami)
                    <img src="{{ Storage::url($profile->foto_tentang_kami) }}" id="prevTentangKamiImg" alt="Tentang Kami">
                    @else
                    <div class="preview-placeholder" id="phTentangKamiImg"><i class="fas fa-image"></i><br>Belum ada gambar</div>
                    <img id="prevTentangKamiImg" style="display:none;">
                    @endif
                </div>
                <div class="upload-area">
                    <input type="file" name="foto_tentang_kami" accept="image/*" onchange="previewUpload(this, 'prevTentangKamiImg', 'phTentangKamiImg')">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p><strong>Klik atau seret file</strong> gambar Tentang Kami</p>
                    <p style="font-size:0.8rem;color:#94a3b8;margin-top:8px;">
                        <i class="fas fa-info-circle"></i> Rekomendasi: <strong>800 x 600 px</strong> (Landscape). Maks. 4MB.
                    </p>
                </div>
            </div>
        </div>

        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-image"></i> Gambar Banner Layanan</h3>
            <div class="upload-container">
                <div class="preview-box">
                    @if($profile->foto_layanan)
                    <img src="{{ Storage::url($profile->foto_layanan) }}" id="prevLayananImg" alt="Layanan">
                    @else
                    <div class="preview-placeholder" id="phLayananImg"><i class="fas fa-image"></i><br>Belum ada gambar</div>
                    <img id="prevLayananImg" style="display:none;">
                    @endif
                </div>
                <div class="upload-area">
                    <input type="file" name="foto_layanan" accept="image/*" onchange="previewUpload(this, 'prevLayananImg', 'phLayananImg')">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p><strong>Klik atau seret file</strong> banner Layanan</p>
                    <p style="font-size:0.8rem;color:#94a3b8;margin-top:8px;">
                        <i class="fas fa-info-circle"></i> Rekomendasi: <strong>1280 x 480 px</strong> (Wide). Maks. 2MB.
                    </p>
                </div>
            </div>
        </div>


    </div>

    <!-- TAB: SAMBUTAN KETUA -->
    <div id="tab-ketua" class="tab-pane">
        <div class="admin-form-card">
            <h3 class="card-title"><i class="fas fa-user-tie"></i> Sambutan Ketua Lembaga</h3>
            
            <div class="form-row-2">
                <div class="form-group">
                    <label class="form-label">Nama Ketua</label>
                    <input type="text" name="sambutan_ketua_nama" class="form-control" value="{{ old('sambutan_ketua_nama', $profile->sambutan_ketua_nama) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Jabatan (Opsional)</label>
                    <input type="text" name="sambutan_ketua_jabatan" class="form-control" value="{{ old('sambutan_ketua_jabatan', $profile->sambutan_ketua_jabatan) }}">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Isi Sambutan</label>
                <textarea name="sambutan_ketua_isi" class="form-control" rows="6" placeholder="Ketik isi sambutan di sini...">{{ old('sambutan_ketua_isi', $profile->sambutan_ketua_isi) }}</textarea>
            </div>

            <div class="form-group" style="margin-top:24px;">
                <label class="form-label">Foto Ketua</label>
                <div class="upload-container">
                    <div class="preview-box">
                        @if($profile->foto_ketua)
                        <img src="{{ Storage::url($profile->foto_ketua) }}" id="prevKetuaImg" alt="Ketua">
                        @else
                        <div class="preview-placeholder" id="phKetuaImg"><i class="fas fa-user"></i><br>Belum ada foto</div>
                        <img id="prevKetuaImg" style="display:none;">
                        @endif
                    </div>
                    <div class="upload-area">
                        <input type="file" name="foto_ketua" accept="image/*" onchange="previewUpload(this, 'prevKetuaImg', 'phKetuaImg')">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p><strong>Klik atau seret file</strong> Foto Ketua</p>
                        <p style="font-size:0.8rem;color:#94a3b8;margin-top:8px;">
                            <i class="fas fa-info-circle"></i> Rekomendasi: <strong>1:1 (Kotak)</strong>, misal 600 x 600 px. Maks. 2MB.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="save-bar">
        <div>
            <h4 style="margin:0 0 4px;font-size:1rem;color:#0d2b5e;">Simpan Perubahan</h4>
            <p style="margin:0;font-size:0.85rem;color:#64748b;">Pastikan semua data di setiap tab sudah sesuai sebelum menyimpan.</p>
        </div>
        <button type="submit" class="btn btn-success" style="padding:12px 32px;font-size:1rem;">
            <i class="fas fa-save" style="margin-right:8px;"></i> Simpan Profil
        </button>
    </div>

</form>

@push('scripts')
<script>
    // Tab Navigation Logic
    const tabs = document.querySelectorAll('.tab-btn');
    const panes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all
            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked tab
            tab.classList.add('active');
            document.getElementById(tab.getAttribute('data-target')).classList.add('active');
        });
    });

    // Universal Image Preview Function
    function previewUpload(input, imgId, placeholderId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(imgId);
                const placeholder = document.getElementById(placeholderId);
                
                img.src = e.target.result;
                img.style.display = 'block';
                if(placeholder) placeholder.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewSliderUpload(input) {
        const previewContainer = document.getElementById('newSliderPreview');
        previewContainer.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style = 'width:120px; height:80px; border-radius:6px; overflow:hidden; border:2px solid #1a6fc4;';
                    div.innerHTML = '<img src="' + e.target.result + '" style="width:100%; height:100%; object-fit:cover;">';
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    // Sortable Initialization
    document.addEventListener('DOMContentLoaded', function() {
        const el = document.getElementById('sortable-hero-images');
        if (el) {
            const sortable = Sortable.create(el, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle',
                onEnd: function() {
                    updateOrder();
                }
            });

            function updateOrder() {
                const items = el.querySelectorAll('.sortable-item');
                const order = Array.from(items).map(item => item.getAttribute('data-path'));
                document.getElementById('hero_images_order').value = JSON.stringify(order);
            }
            
            // Initial order
            updateOrder();
        }
    });
</script>
@endpush

@endsection
