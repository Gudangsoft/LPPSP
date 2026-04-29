<?php

namespace App\Exports;

use App\Models\Pengalaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PengalamanTemplateExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithMapping
{
    private int $no = 0;

    public function collection()
    {
        return Pengalaman::with('layanan')
            ->orderByDesc('tahun')
            ->orderBy('id')
            ->get();
    }

    public function map($pengalaman): array
    {
        $this->no++;

        return [
            $this->no,
            $pengalaman->layanan?->judul ?? '',
            $pengalaman->judul,
            $pengalaman->target_sasaran ?? '',
            $pengalaman->jenis_klien ?? '',
            $pengalaman->klien,
            $pengalaman->lokasi ?? '',
            $pengalaman->tahun,
            $pengalaman->deskripsi ?? '',
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Layanan Utama',
            'Judul Pekerjaan/Kegiatan/Aktivitas',
            'Target/Kelompok Sasaran',
            'Jenis Klien/Pemberi Pekerjaan',
            'Klien/Pemberi Pekerjaan',
            'Lokasi',
            'Tahun Pelaksanaan',
            'Deskripsi Singkat Pekerjaan/Kegiatan/Aktivitas',
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
            'E' => 30,
            'F' => 35,
            'G' => 25,
            'H' => 18,
            'I' => 55,
        ];
    }
}
