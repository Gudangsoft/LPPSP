<?php

namespace App\Imports;

use App\Models\Layanan;
use App\Models\Pengalaman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class PengalamanImport implements ToModel, WithStartRow, SkipsEmptyRows, SkipsOnError
{
    use SkipsErrors;

    // Cache layanan lookup to avoid N+1 queries
    private array $layananCache = [];
    public int $importedCount = 0;

    public function startRow(): int
    {
        return 2; // Skip header row
    }

    public function model(array $row): ?Pengalaman
    {
        // Column mapping (0-indexed):
        // 0 = No
        // 1 = Layanan Utama
        // 2 = Judul Pekerjaan/Kegiatan/Aktivitas
        // 3 = Target/Kelompok Sasaran
        // 4 = Klien/Pemberi Pekerjaan
        // 5 = Lokasi
        // 6 = Tahun Pelaksanaan
        // 7 = Deskripsi Singkat

        $judul = trim($row[2] ?? '');
        $klien = trim($row[4] ?? '');
        $tahun = intval($row[6] ?? date('Y'));

        // Skip if required fields are empty
        if (empty($judul) || empty($klien)) {
            return null;
        }

        // Validate tahun
        if ($tahun < 1990 || $tahun > 2100) {
            $tahun = date('Y');
        }

        // Resolve layanan_id by matching judul (case-insensitive partial match)
        $layananNama  = trim($row[1] ?? '');
        $layananId    = $this->resolveLayananId($layananNama);

        $this->importedCount++;

        return new Pengalaman([
            'layanan_id'     => $layananId,
            'judul'          => $judul,
            'target_sasaran' => trim($row[3] ?? '') ?: null,
            'klien'          => $klien,
            'lokasi'         => trim($row[5] ?? '') ?: null,
            'tahun'          => $tahun,
            'deskripsi'      => trim($row[7] ?? '') ?: null,
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
