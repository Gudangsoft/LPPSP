<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimOrganisasi extends Model
{
    protected $table = 'tim_organisasis';

    protected $fillable = [
        'kelompok', 'nama', 'jabatan', 'bio', 'keahlian',
        'foto', 'email', 'linkedin', 'urutan', 'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan')->orderBy('nama');
    }
}
