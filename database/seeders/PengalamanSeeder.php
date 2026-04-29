<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengalamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengalamans')->truncate();

        $pengalamans = [
            // Pengkajian dan Penelitian
            [
                'judul'    => 'Kajian Kebutuhan Dasar Sosial Masyarakat Miskin Perkotaan',
                'klien'    => 'Dinas Sosial Kota Semarang',
                'kategori' => 'Pengkajian dan Penelitian',
                'tahun'    => 2023,
                'deskripsi'=> 'Kajian komprehensif untuk memetakan kebutuhan dasar masyarakat miskin perkotaan di Kota Semarang sebagai dasar penyusunan program bantuan sosial yang tepat sasaran.',
                'unggulan' => true,
                'aktif'    => true,
            ],
            [
                'judul'    => 'Penelitian Efektivitas Program Keluarga Harapan (PKH) di Jawa Tengah',
                'klien'    => 'Bappeda Provinsi Jawa Tengah',
                'kategori' => 'Pengkajian dan Penelitian',
                'tahun'    => 2022,
                'deskripsi'=> 'Evaluasi efektivitas pelaksanaan Program Keluarga Harapan (PKH) di wilayah Jawa Tengah dengan pendekatan kuantitatif dan kualitatif.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            [
                'judul'    => 'Studi Kelayakan Pengembangan Kawasan Agribisnis Terpadu',
                'klien'    => 'Kementerian Pertanian RI',
                'kategori' => 'Pengkajian dan Penelitian',
                'tahun'    => 2022,
                'deskripsi'=> 'Studi kelayakan teknis, finansial, dan sosial untuk pengembangan kawasan agribisnis terpadu di wilayah Jawa Tengah.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            // Pendampingan Perencanaan
            [
                'judul'    => 'Pendampingan Penyusunan RPJMD Kabupaten Demak 2021-2026',
                'klien'    => 'Pemerintah Kabupaten Demak',
                'kategori' => 'Pendampingan Perencanaan Pembangunan Daerah',
                'tahun'    => 2021,
                'deskripsi'=> 'Pendampingan teknis penyusunan Rencana Pembangunan Jangka Menengah Daerah (RPJMD) Kabupaten Demak periode 2021-2026 secara partisipatif.',
                'unggulan' => true,
                'aktif'    => true,
            ],
            [
                'judul'    => 'Fasilitasi Penyusunan RKPD Kabupaten Kendal Tahun 2023',
                'klien'    => 'Bappeda Kabupaten Kendal',
                'kategori' => 'Pendampingan Perencanaan Pembangunan Daerah',
                'tahun'    => 2022,
                'deskripsi'=> 'Fasilitasi dan pendampingan penyusunan Rencana Kerja Pemerintah Daerah (RKPD) Kabupaten Kendal tahun 2023.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            // Evaluasi Program
            [
                'judul'    => 'Evaluasi Program Pemberdayaan UMKM Pasca Pandemi Covid-19',
                'klien'    => 'Dinas Koperasi dan UMKM Jawa Tengah',
                'kategori' => 'Evaluasi Program dan Kinerja Pembangunan',
                'tahun'    => 2022,
                'deskripsi'=> 'Evaluasi komprehensif atas program pemulihan dan pemberdayaan UMKM di Provinsi Jawa Tengah pasca pandemi Covid-19.',
                'unggulan' => true,
                'aktif'    => true,
            ],
            [
                'judul'    => 'Evaluasi Kinerja Perangkat Daerah Kota Semarang Tahun 2022',
                'klien'    => 'Inspektorat Kota Semarang',
                'kategori' => 'Evaluasi Program dan Kinerja Pembangunan',
                'tahun'    => 2022,
                'deskripsi'=> 'Evaluasi kinerja organisasi perangkat daerah (OPD) di lingkungan Pemerintah Kota Semarang tahun anggaran 2022.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            // Pemberdayaan Masyarakat
            [
                'judul'    => 'Pendampingan Komunitas Petani Organik Lereng Gunung Merbabu',
                'klien'    => 'Yayasan Mitra Tani',
                'kategori' => 'Pemberdayaan Masyarakat',
                'tahun'    => 2023,
                'deskripsi'=> 'Pendampingan dan pengembangan kapasitas komunitas petani organik di lereng Gunung Merbabu untuk meningkatkan produktivitas dan akses pasar.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            [
                'judul'    => 'Program Pemberdayaan Perempuan Kepala Rumah Tangga (PEKKA)',
                'klien'    => 'BPMD Provinsi Jawa Tengah',
                'kategori' => 'Pemberdayaan Masyarakat',
                'tahun'    => 2021,
                'deskripsi'=> 'Program pemberdayaan ekonomi dan penguatan kapasitas bagi perempuan kepala rumah tangga (PEKKA) di wilayah perkotaan dan perdesaan.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            // Pendidikan dan Pelatihan
            [
                'judul'    => 'Pelatihan Penyusunan Laporan Keuangan Desa bagi Aparatur Desa',
                'klien'    => 'Dinas Pemberdayaan Masyarakat dan Desa Jawa Tengah',
                'kategori' => 'Pendidikan dan Pelatihan',
                'tahun'    => 2023,
                'deskripsi'=> 'Pelatihan teknis penyusunan laporan keuangan desa berbasis aplikasi SISKEUDES bagi aparatur desa se-Jawa Tengah.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            [
                'judul'    => 'Workshop Penguatan Kapasitas Fasilitator Pembangunan Desa',
                'klien'    => 'BPMPD Kabupaten Grobogan',
                'kategori' => 'Pendidikan dan Pelatihan',
                'tahun'    => 2022,
                'deskripsi'=> 'Workshop penguatan kapasitas fasilitator pendampingan pembangunan desa dalam kerangka pelaksanaan Dana Desa.',
                'unggulan' => false,
                'aktif'    => true,
            ],
            // Advokasi dan Konsultasi
            [
                'judul'    => 'Advokasi Kebijakan Perlindungan Sosial bagi Pekerja Migran',
                'klien'    => 'LPPM Universitas Diponegoro',
                'kategori' => 'Advokasi dan Konsultasi Kebijakan Pembangunan',
                'tahun'    => 2023,
                'deskripsi'=> 'Advokasi kebijakan dan penyusunan rekomendasi kebijakan perlindungan sosial bagi pekerja migran Indonesia asal Jawa Tengah.',
                'unggulan' => false,
                'aktif'    => true,
            ],
        ];

        foreach ($pengalamans as $p) {
            DB::table('pengalamans')->insert(array_merge($p, [
                'gambar'     => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
