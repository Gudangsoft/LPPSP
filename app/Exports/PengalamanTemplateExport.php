<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PengalamanTemplateExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function headings(): array
    {
        return [
            'No',
            'Layanan Utama',
            'Judul Pekerjaan/Kegiatan/Aktivitas',
            'Target/Kelompok Sasaran',
            'Klien/Pemberi Pekerjaan',
            'Lokasi',
            'Tahun Pelaksanaan',
            'Deskripsi Singkat Pekerjaan/Kegiatan/Aktivitas',
        ];
    }

    public function array(): array
    {
        return [
            [
                1,
                'Pendampingan Perencanaan Pembangunan Daerah',
                'Penyusunan Dokumen Ranwal RKPD Tahun 2027',
                'Pemerintah daerah dan perangkat daerah',
                'Bapperida Kabupaten Merauke',
                'Kabupaten Merauke',
                2025,
                'Kegiatan ini berfokus pada penyusunan dokumen ranwal rkpd tahun 2027...',
            ],
            [
                2,
                'Pengkajian dan Penelitian',
                'Sub Kegiatan Pembinaan Akuntansi, Pelaporan dan Pertanggungjawaban',
                'Pemerintah daerah/perangkat daerah terkait',
                'Pemerintah Provinsi Kepulauan Riau',
                'Provinsi Kepulauan Riau',
                2025,
                'Kegiatan ini merupakan bagian dari sub kegiatan pembinaan akuntansi...',
            ],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF0D2B5E']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'wrapText' => true],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 45,
            'D' => 35,
            'E' => 35,
            'F' => 25,
            'G' => 18,
            'H' => 55,
        ];
    }
}
