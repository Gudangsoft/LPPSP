<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublikasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('publikasis')->truncate();

        $publikasis = [
            // Buku
            [
                'judul'          => 'Tata Kelola Pemerintahan Daerah yang Baik: Konsep dan Praktik',
                'kategori'       => 'Buku',
                'penulis'        => 'Tim Peneliti LPPSP',
                'deskripsi'      => 'Buku ini menyajikan konsep dan praktik tata kelola pemerintahan daerah yang baik (good local governance) berdasarkan hasil kajian dan pengalaman lapangan LPPSP selama lebih dari dua dekade.',
                'konten'         => 'Buku ini terdiri dari 8 bab yang membahas berbagai aspek tata kelola pemerintahan daerah, mulai dari kerangka teoritis, regulasi, hingga praktik baik yang dapat diadopsi oleh pemerintah daerah di Indonesia.',
                'tanggal_terbit' => '2022-06-01',
                'unggulan'       => true,
                'aktif'          => true,
            ],
            [
                'judul'          => 'Pembangunan Berbasis Komunitas: Pendekatan Partisipatif dalam Pemberdayaan Masyarakat',
                'kategori'       => 'Buku',
                'penulis'        => 'Tim Peneliti LPPSP',
                'deskripsi'      => 'Buku panduan metodologi pembangunan berbasis komunitas yang menekankan pentingnya partisipasi masyarakat dalam setiap tahapan pembangunan, mulai dari perencanaan hingga evaluasi.',
                'konten'         => 'Dilengkapi dengan studi kasus dari berbagai daerah di Jawa Tengah dan Indonesia Timur.',
                'tanggal_terbit' => '2021-03-15',
                'unggulan'       => false,
                'aktif'          => true,
            ],
            // Artikel
            [
                'judul'          => 'Efektivitas Program Keluarga Harapan dalam Pengentasan Kemiskinan di Jawa Tengah',
                'kategori'       => 'Artikel',
                'penulis'        => 'Tim Peneliti LPPSP',
                'deskripsi'      => 'Artikel ilmiah yang menganalisis efektivitas Program Keluarga Harapan (PKH) dalam upaya pengentasan kemiskinan di Provinsi Jawa Tengah berdasarkan data primer dan sekunder tahun 2020-2022.',
                'konten'         => 'Penelitian ini menggunakan pendekatan mixed-method dengan survei terhadap 450 responden di 9 kabupaten/kota di Jawa Tengah.',
                'tanggal_terbit' => '2023-02-10',
                'unggulan'       => true,
                'aktif'          => true,
            ],
            [
                'judul'          => 'Penguatan Kapasitas Pemerintah Desa Pasca Undang-Undang Desa',
                'kategori'       => 'Artikel',
                'penulis'        => 'Tim LPPSP',
                'deskripsi'      => 'Artikel yang membahas dinamika dan tantangan penguatan kapasitas pemerintah desa dalam mengimplementasikan amanat Undang-Undang Nomor 6 Tahun 2014 tentang Desa.',
                'konten'         => 'Artikel ini mengkaji pengalaman 12 desa di 3 kabupaten di Jawa Tengah dalam mengelola dana desa dan melaksanakan pembangunan partisipatif.',
                'tanggal_terbit' => '2022-09-05',
                'unggulan'       => false,
                'aktif'          => true,
            ],
            [
                'judul'          => 'Peran Lembaga Swadaya Masyarakat dalam Tata Kelola Pembangunan Daerah',
                'kategori'       => 'Artikel',
                'penulis'        => 'Tim Peneliti LPPSP',
                'deskripsi'      => 'Tinjauan kritis atas peran dan kontribusi LSM/Ormas dalam proses tata kelola dan pengawasan pembangunan daerah di Indonesia.',
                'konten'         => 'Berdasarkan kajian literatur dan studi kasus di beberapa daerah di Indonesia.',
                'tanggal_terbit' => '2021-11-20',
                'unggulan'       => false,
                'aktif'          => true,
            ],
            // Berita Kegiatan
            [
                'judul'          => 'LPPSP Mendampingi Penyusunan RPJMD Kabupaten Demak 2021-2026',
                'kategori'       => 'Berita Kegiatan',
                'penulis'        => 'Redaksi LPPSP',
                'deskripsi'      => 'LPPSP resmi ditunjuk sebagai pendamping teknis penyusunan Rencana Pembangunan Jangka Menengah Daerah (RPJMD) Kabupaten Demak periode 2021-2026.',
                'konten'         => 'Proses pendampingan dilakukan melalui serangkaian workshop, FGD, dan konsultasi teknis yang melibatkan seluruh OPD dan pemangku kepentingan di Kabupaten Demak.',
                'tanggal_terbit' => '2021-05-15',
                'unggulan'       => false,
                'aktif'          => true,
            ],
            [
                'judul'          => 'Workshop Penguatan Kapasitas Fasilitator Desa Se-Kabupaten Grobogan',
                'kategori'       => 'Berita Kegiatan',
                'penulis'        => 'Redaksi LPPSP',
                'deskripsi'      => 'LPPSP menyelenggarakan workshop penguatan kapasitas bagi ratusan fasilitator pembangunan desa di Kabupaten Grobogan bekerja sama dengan BPMPD Kabupaten Grobogan.',
                'konten'         => 'Workshop dilaksanakan selama 3 hari dengan materi meliputi perencanaan pembangunan desa, pengelolaan keuangan desa, dan pemberdayaan masyarakat.',
                'tanggal_terbit' => '2022-08-20',
                'unggulan'       => true,
                'aktif'          => true,
            ],
            [
                'judul'          => 'LPPSP Raih Kepercayaan Kembali dari Dinas Koperasi Jawa Tengah',
                'kategori'       => 'Berita Kegiatan',
                'penulis'        => 'Redaksi LPPSP',
                'deskripsi'      => 'Untuk ketiga kalinya, LPPSP dipercaya oleh Dinas Koperasi dan UMKM Provinsi Jawa Tengah untuk melaksanakan kajian evaluasi program pengembangan koperasi dan UMKM.',
                'konten'         => 'Kepercayaan yang berulang ini merupakan bukti komitmen LPPSP terhadap kualitas dan profesionalisme dalam setiap layanan yang diberikan.',
                'tanggal_terbit' => '2023-03-01',
                'unggulan'       => false,
                'aktif'          => true,
            ],
            // Foto/Video
            [
                'judul'          => 'Dokumentasi Workshop Evaluasi Program Keluarga Harapan Jawa Tengah',
                'kategori'       => 'Foto/Video Kegiatan',
                'penulis'        => 'Tim Dokumentasi LPPSP',
                'deskripsi'      => 'Dokumentasi foto dan video kegiatan workshop penyampaian hasil evaluasi Program Keluarga Harapan (PKH) kepada pemangku kepentingan di Provinsi Jawa Tengah.',
                'konten'         => 'Kegiatan ini dihadiri oleh perwakilan dari Bappeda, Dinas Sosial, dan Tim Koordinasi PKH di berbagai kabupaten/kota.',
                'tanggal_terbit' => '2022-11-15',
                'unggulan'       => false,
                'aktif'          => true,
            ],
        ];

        foreach ($publikasis as $p) {
            DB::table('publikasis')->insert(array_merge($p, [
                'gambar'   => null,
                'file_url' => null,
                'video_url'=> null,
                'slug'     => Str::slug($p['judul']) . '-' . time() . rand(100, 999),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
