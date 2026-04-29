<?php

namespace App\Imports;

use App\Models\Layanan;
use App\Models\Pengalaman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class PengalamanImport implements ToModel, WithStartRow, SkipsEmptyRows, SkipsOnError
{
    use SkipsErrors;

    private array $layananCache = [];
    public int $importedCount = 0;

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row): ?Pengalaman
    {
        // Column mapping (0-indexed):
        // 0 = No
        // 1 = Layanan Utama
        // 2 = Judul Pekerjaan/Kegiatan/Aktivitas
        // 3 = Target/Kelompok Sasaran
        // 4 = Jenis Klien/Pemberi Pekerjaan
        // 5 = Klien/Pemberi Pekerjaan
        // 6 = Lokasi
        // 7 = Tahun Pelaksanaan
        // 8 = Deskripsi Singkat

        $judul = trim($row[2] ?? '');
        $klien = trim($row[5] ?? '');
        $tahun = intval($row[7] ?? date('Y'));

        if (empty($judul) || empty($klien)) {
            return null;
        }

        if ($tahun < 1990 || $tahun > 2100) {
            $tahun = date('Y');
        }

        $layananNama = trim($row[1] ?? '');
        $layananId   = $this->resolveLayananId($layananNama);

        $this->importedCount++;

        return new Pengalaman([
            'layanan_id'     => $layananId,
            'judul'          => $judul,
            'target_sasaran' => trim($row[3] ?? '') ?: null,
            'jenis_klien'    => trim($row[4] ?? '') ?: null,
            'klien'          => $klien,
            'lokasi'         => trim($row[6] ?? '') ?: null,
            'tahun'          => $tahun,
            'deskripsi'      => trim($row[8] ?? '') ?: null,
            'aktif'          => true,
            'unggulan'       => false,
        ]);
    }

    private function resolveLayananId(string $nama): ?int
    {
        if (empty($nama)) return null;

        $key = strtolower($nama);
        if (array_key_exists($key, $this->layananCache)) {
            return $this->layananCache[$key];
        }

        $layanan = Layanan::whereRaw('LOWER(judul) LIKE ?', ['%' . strtolower($nama) . '%'])->first();
        $this->layananCache[$key] = $layanan?->id;

        return $this->layananCache[$key];
    }
}
