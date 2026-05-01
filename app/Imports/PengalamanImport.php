<?php

namespace App\Imports;

use App\Models\Layanan;
use App\Models\Pengalaman;
use App\Models\KlienMitra;
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

        $judul = trim((string)($row[2] ?? ''));
        $klien = trim((string)($row[5] ?? ''));
        $tahun = intval($row[7] ?? 0);

        if (empty($judul) || empty($klien)) {
            return null;
        }

        // Normalize tahun: handle float from Excel (e.g. 2025.0)
        if ($tahun < 1990 || $tahun > 2100) {
            $tahun = (int) date('Y');
        }

        $layananNama = trim((string)($row[1] ?? ''));
        $layananId   = $this->resolveLayananId($layananNama);

        if (!empty($klien)) {
            $validKategori = [
                'Kementerian/Lembaga',
                'Pemerintah Daerah',
                'OPD/Instansi Teknis',
                'Lembaga Pendidikan',
                'Dunia Usaha',
                'Lembaga Mitra',
            ];
            
            $jenisKlienExcel = trim((string)($row[4] ?? ''));
            $kategori = 'Lembaga Mitra'; // default
            
            foreach ($validKategori as $vk) {
                if (strtolower($vk) === strtolower($jenisKlienExcel)) {
                    $kategori = $vk;
                    break;
                }
            }

            KlienMitra::firstOrCreate(
                ['nama' => $klien],
                ['kategori' => $kategori, 'aktif' => true]
            );
        }

        $this->importedCount++;

        return new Pengalaman([
            'layanan_id'     => $layananId,
            'judul'          => $judul,          // text column — no length limit
            'target_sasaran' => trim((string)($row[3] ?? '')) ?: null,
            'jenis_klien'    => mb_substr(trim((string)($row[4] ?? '')), 0, 100) ?: null,
            'klien'          => $klien,           // text column — no length limit
            'lokasi'         => mb_substr(trim((string)($row[6] ?? '')), 0, 200) ?: null,
            'tahun'          => $tahun,
            'deskripsi'      => trim((string)($row[8] ?? '')) ?: null,
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
