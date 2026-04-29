<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimonis';

    protected $fillable = [
        'nama', 'jabatan', 'instansi', 'foto', 'video_url', 'isi', 'rating', 'unggulan', 'aktif',
    ];

    protected $casts = [
        'unggulan' => 'boolean',
        'aktif'    => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderByDesc('unggulan');
    }
}
