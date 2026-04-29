<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KlienMitra extends Model
{
    protected $table = 'klien_mitras';

    protected $fillable = [
        'nama', 'kategori', 'logo', 'website', 'urutan', 'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }
}
