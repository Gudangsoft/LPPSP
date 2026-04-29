<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('testimonis')->truncate();

        $testimonis = [
            [
                'nama'     => 'Kepala Bappeda Kabupaten Demak',
                'jabatan'  => 'Kepala Bappeda',
                'instansi' => 'Pemerintah Kabupaten Demak',
                'isi'      => 'LPPSP memberikan pendampingan yang sistematis, komunikatif, dan sesuai kebutuhan daerah. Tim mereka sangat profesional dan memahami konteks pemerintahan daerah dengan baik.',
                'rating'   => 5,
                'unggulan' => true,
                'aktif'    => true,
            ],
            [
                'nama'     => 'Peserta Pelatihan Aparat Desa',
                'jabatan'  => 'Sekretaris Desa',
                'instansi' => 'Desa Karangrejo, Kabupaten Grobogan',
                'isi'      => 'Pelatihan yang difasilitasi LPPSP membantu memperkuat kapasitas peserta secara praktis. Materi yang disampaikan relevan dan mudah dipahami untuk diterapkan di desa.',
                'rating'   => 5,
                'unggulan' => true,
                'aktif'    => true,
            ],
            [
                'nama'     => 'Direktur Yayasan Mitra Tani',
                'jabatan'  => 'Direktur',
                'instansi' => 'Yayasan Mitra Tani',
                'isi'      => 'Kami melihat LPPSP sebagai mitra strategis yang mampu menjembatani analisis dan implementasi. Pendekatan mereka yang partisipatif sangat membantu komunitas yang kami dampingi.',
                'rating'   => 5,
                'unggulan' => true,
                'aktif'    => true,
            ],
            [
                'nama'     => 'Pejabat Dinas Sosial Kota Semarang',
                'jabatan'  => 'Kabid Perlindungan Sosial',
                'instansi' => 'Dinas Sosial Kota Semarang',
                'isi'      => 'Hasil kajian LPPSP sangat berguna bagi kami dalam menyusun kebijakan perlindungan sosial yang lebih tepat sasaran. Datanya akurat dan rekomendasi yang diberikan sangat actionable.',
                'rating'   => 5,
                'unggulan' => false,
                'aktif'    => true,
            ],
            [
                'nama'     => 'Staf Bappeda Provinsi Jawa Tengah',
                'jabatan'  => 'Analis Kebijakan',
                'instansi' => 'Bappeda Provinsi Jawa Tengah',
                'isi'      => 'LPPSP memiliki kapasitas riset yang solid. Metodologi yang mereka gunakan terstandarisasi dan hasil kajiannya dapat dipertanggungjawabkan secara ilmiah maupun praktis.',
                'rating'   => 4,
                'unggulan' => false,
                'aktif'    => true,
            ],
            [
                'nama'     => 'Koordinator Program PEKKA Jawa Tengah',
                'jabatan'  => 'Koordinator Program',
                'instansi' => 'BPMD Provinsi Jawa Tengah',
                'isi'      => 'Kerja sama dengan LPPSP dalam program pemberdayaan perempuan kepala rumah tangga sangat produktif. Pendekatan mereka yang humanis dan berbasis komunitas benar-benar membuat perbedaan.',
                'rating'   => 5,
                'unggulan' => false,
                'aktif'    => true,
            ],
        ];

        foreach ($testimonis as $t) {
            DB::table('testimonis')->insert(array_merge($t, [
                'foto'       => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
