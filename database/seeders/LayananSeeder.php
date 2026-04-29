<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('layanans')->truncate();

        $layanans = [
            [
                'judul'     => 'Pengkajian dan Penelitian',
                'ikon'      => 'fa-search',
                'deskripsi' => 'Layanan pengkajian dan penelitian berbasis analisis yang kuat, kontekstual, dan berorientasi pada kebutuhan riil di lapangan untuk mendukung pengambilan keputusan yang berbasis data.',
                'detail'    => 'LPPSP memiliki kapasitas pengkajian dan penelitian yang mencakup: studi kelayakan, evaluasi program, penelitian sosial ekonomi, analisis kebijakan, dan kajian dampak pembangunan.',
                'urutan'    => 1,
                'aktif'     => true,
            ],
            [
                'judul'     => 'Pendampingan Perencanaan Pembangunan Daerah',
                'ikon'      => 'fa-map',
                'deskripsi' => 'Layanan pendampingan penyusunan dokumen perencanaan pembangunan daerah mulai dari RPJMD, RKPD, Renstra, hingga dokumen perencanaan teknis lainnya.',
                'detail'    => 'Tim ahli LPPSP siap mendampingi proses penyusunan dokumen perencanaan daerah secara partisipatif dan berbasis data.',
                'urutan'    => 2,
                'aktif'     => true,
            ],
            [
                'judul'     => 'Evaluasi Program dan Kinerja Pembangunan',
                'ikon'      => 'fa-chart-bar',
                'deskripsi' => 'Layanan evaluasi program pembangunan secara komprehensif mencakup evaluasi proses, capaian output, outcome, dan dampak jangka panjang dari suatu program atau kebijakan.',
                'detail'    => 'Evaluasi dilakukan menggunakan pendekatan kuantitatif dan kualitatif yang terstandarisasi.',
                'urutan'    => 3,
                'aktif'     => true,
            ],
            [
                'judul'     => 'Pengembangan Database dan Sistem Informasi',
                'ikon'      => 'fa-database',
                'deskripsi' => 'Layanan pengembangan sistem database dan informasi untuk mendukung pengelolaan data pembangunan yang tertib, akurat, dan mudah diakses oleh pemangku kepentingan.',
                'detail'    => 'Termasuk pengembangan basis data profil wilayah, sistem informasi geografis, dan dashboard monitoring pembangunan.',
                'urutan'    => 4,
                'aktif'     => true,
            ],
            [
                'judul'     => 'Pemberdayaan Masyarakat',
                'ikon'      => 'fa-users',
                'deskripsi' => 'Layanan pendampingan dan pemberdayaan masyarakat untuk memperkuat kemandirian, meningkatkan kapasitas, dan mengurangi kerentanan kelompok masyarakat rentan.',
                'detail'    => 'Mencakup pendampingan komunitas, pengembangan usaha mikro, dan penguatan kelembagaan masyarakat.',
                'urutan'    => 5,
                'aktif'     => true,
            ],
            [
                'judul'     => 'Pendidikan dan Pelatihan',
                'ikon'      => 'fa-graduation-cap',
                'deskripsi' => 'Layanan pendidikan dan pelatihan berbasis kompetensi untuk peningkatan kapasitas aparatur pemerintah, tenaga pendamping, dan masyarakat dalam berbagai bidang pembangunan.',
                'detail'    => 'Program pelatihan dirancang secara modular dan dapat disesuaikan dengan kebutuhan peserta maupun institusi.',
                'urutan'    => 6,
                'aktif'     => true,
            ],
            [
                'judul'     => 'Advokasi dan Konsultasi Kebijakan Pembangunan',
                'ikon'      => 'fa-handshake',
                'deskripsi' => 'Layanan advokasi dan konsultasi kebijakan pembangunan untuk mendorong terwujudnya good governance, kebijakan yang berpihak pada masyarakat, dan tata kelola pemerintahan yang baik.',
                'detail'    => 'Termasuk penyusunan policy brief, rekomendasi kebijakan, dan fasilitasi dialog multipihak.',
                'urutan'    => 7,
                'aktif'     => true,
            ],
        ];

        foreach ($layanans as $l) {
            DB::table('layanans')->insert(array_merge($l, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
