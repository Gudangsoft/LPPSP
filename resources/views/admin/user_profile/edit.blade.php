@extends('layouts.admin')
@section('title', 'Profil Pengguna')

@push('styles')
<style>
.form-card {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    margin-bottom: 24px;
}
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
}
.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
}
.btn-primary {
    background: #3b82f6;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s ease-in-out;
}
.btn-primary:hover {
    background: #2563eb;
}
.text-danger {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 4px;
}
.helper-text {
    font-size: 0.875rem;
    color: #6b7280;
    margin-top: 4px;
}
.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
}
</style>
@endpush

@section('content')
<div class="db-welcome" style="margin-bottom: 24px; padding: 24px; border-radius: 12px; background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
    <div style="color: white;">
        <h2 style="margin: 0; font-size: 1.5rem; font-weight: 700;"><i class="fas fa-user-circle"></i> Profil Pengguna</h2>
        <p style="margin: 8px 0 0; opacity: 0.9;">Ubah informasi dasar dan password akun Anda.</p>
    </div>
</div>

<form action="{{ route('admin.user-profile.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-card">
        <h3 class="section-title">Informasi Dasar</h3>
        
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="form-card">
        <h3 class="section-title">Ubah Password</h3>
        <p class="helper-text" style="margin-bottom: 16px;">Biarkan kosong jika Anda tidak ingin mengubah password.</p>

        <div class="form-group">
            <label for="current_password">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control">
            @error('current_password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password" class="form-control">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
    </div>

    <div style="text-align: right; margin-bottom: 40px;">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </div>
</form>
@endsection
