<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    protected $table = 'pengalamans';

    protected $fillable = [
        'layanan_id', 'judul', 'klien', 'jenis_klien', 'target_sasaran', 'lokasi',
        'tahun', 'deskripsi', 'gambar', 'galeri', 'unggulan', 'aktif',
    ];

    protected $casts = [
        'unggulan' => 'boolean',
        'aktif'    => 'boolean',
        'galeri'   => 'array',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderByDesc('tahun');
    }
}
