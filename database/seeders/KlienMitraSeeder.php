<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlienMitraSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('klien_mitras')->truncate();

        $kliens = [
            // Kementerian/Lembaga
            ['nama' => 'Kementerian Sosial RI',            'kategori' => 'Kementerian/Lembaga',   'website' => 'https://kemensos.go.id',       'urutan' => 1],
            ['nama' => 'Kementerian Pertanian RI',         'kategori' => 'Kementerian/Lembaga',   'website' => 'https://pertanian.go.id',      'urutan' => 2],
            ['nama' => 'Kementerian Desa, PDT dan Transmigrasi', 'kategori' => 'Kementerian/Lembaga', 'website' => 'https://kemendesa.go.id',  'urutan' => 3],
            // Pemerintah Daerah
            ['nama' => 'Pemerintah Provinsi Jawa Tengah',  'kategori' => 'Pemerintah Daerah',     'website' => 'https://jatengprov.go.id',     'urutan' => 4],
            ['nama' => 'Pemerintah Kota Semarang',         'kategori' => 'Pemerintah Daerah',     'website' => 'https://semarangkota.go.id',   'urutan' => 5],
            ['nama' => 'Pemerintah Kabupaten Demak',       'kategori' => 'Pemerintah Daerah',     'website' => 'https://demakkab.go.id',       'urutan' => 6],
            ['nama' => 'Pemerintah Kabupaten Kendal',      'kategori' => 'Pemerintah Daerah',     'website' => 'https://kendalkab.go.id',      'urutan' => 7],
            ['nama' => 'Pemerintah Kabupaten Grobogan',    'kategori' => 'Pemerintah Daerah',     'website' => 'https://grobogankab.go.id',    'urutan' => 8],
            // OPD/Instansi Teknis
            ['nama' => 'Bappeda Provinsi Jawa Tengah',     'kategori' => 'OPD/Instansi Teknis',   'website' => 'https://bappeda.jatengprov.go.id', 'urutan' => 9],
            ['nama' => 'Dinas Sosial Kota Semarang',       'kategori' => 'OPD/Instansi Teknis',   'website' => null,                          'urutan' => 10],
            ['nama' => 'Dinas Koperasi dan UMKM Jawa Tengah', 'kategori' => 'OPD/Instansi Teknis', 'website' => null,                        'urutan' => 11],
            ['nama' => 'BPMD Provinsi Jawa Tengah',        'kategori' => 'OPD/Instansi Teknis',   'website' => null,                          'urutan' => 12],
            // Lembaga Pendidikan
            ['nama' => 'Universitas Diponegoro Semarang',  'kategori' => 'Lembaga Pendidikan',    'website' => 'https://undip.ac.id',          'urutan' => 13],
            ['nama' => 'Universitas Negeri Semarang',      'kategori' => 'Lembaga Pendidikan',    'website' => 'https://unnes.ac.id',          'urutan' => 14],
            // Dunia Usaha
            ['nama' => 'Himpunan Pengusaha Muda Indonesia (HIPMI) Jateng', 'kategori' => 'Dunia Usaha', 'website' => null,                    'urutan' => 15],
            // Lembaga Mitra
            ['nama' => 'Yayasan Mitra Tani',               'kategori' => 'Lembaga Mitra',         'website' => null,                          'urutan' => 16],
            ['nama' => 'LP2M Universitas Diponegoro',       'kategori' => 'Lembaga Mitra',         'website' => 'https://lppm.undip.ac.id',     'urutan' => 17],
        ];

        foreach ($kliens as $k) {
            DB::table('klien_mitras')->insert(array_merge($k, [
                'logo'       => null,
                'aktif'      => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
