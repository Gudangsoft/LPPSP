<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriSlider extends Model
{
    protected $table = 'galeri_sliders';

    protected $fillable = [
        'judul', 'nama', 'jabatan', 'deskripsi', 'foto',
        'wa', 'instagram', 'facebook', 'linkedin',
        'urutan', 'aktif',
    ];

    protected $casts = ['aktif' => 'boolean'];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('id');
    }
}
