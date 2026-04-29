<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profiles')->truncate();

        DB::table('profiles')->insert([
            'nama_lembaga'           => 'Lembaga Pengkajian dan Pengembangan Sumberdaya Pembangunan',
            'singkatan'              => 'LPPSP',
            'tagline'                => 'Mitra Profesional dalam <span>Pengkajian dan Pengembangan</span> Sumberdaya Pembangunan',
            'deskripsi_singkat'      => 'LPPSP atau Lembaga Pengkajian dan Pengembangan Sumberdaya Pembangunan berdiri sejak tanggal 22 Mei 1998 di Semarang. Didirikan oleh sekelompok anak muda yang memiliki idealisme dan dedikasi yang bergerak pada bidang sosial, bidang pembangunan daerah dan pemerintahan, bidang kemanusiaan, dan bidang keagamaan.',
            'tentang_kami'           => 'LPPSP adalah lembaga profesional yang berkomitmen pada pengkajian, pengembangan sumberdaya pembangunan, pemberdayaan masyarakat, serta penguatan tata kelola pemerintahan yang baik. Berdiri sejak 22 Mei 1998, LPPSP hadir sebagai mitra strategis bagi pemerintah, lembaga, dan masyarakat dalam mewujudkan pembangunan yang berkelanjutan dan berkeadilan.',
            'sejarah'                => 'LPPSP berdiri pada tanggal 22 Mei 1998 di Semarang, didirikan oleh sekelompok anak muda yang memiliki idealisme dan dedikasi tinggi. Sejak berdirinya, LPPSP telah memberikan layanan kegiatan pada bidang sosial, bidang pembangunan daerah dan pemerintahan, bidang kemanusiaan, dan bidang keagamaan kepada berbagai pihak mulai dari pemerintah pusat, pemerintah daerah, hingga masyarakat sipil.',
            'visi'                   => 'Menjadi lembaga yang handal dalam pengkajian dan pengembangan sumberdaya pembangunan berlandaskan profesionalisme dan integritas.',
            'misi'                   => "1. Melakukan pengkajian dan penelitian untuk mendukung pelaksanaan tata kelola pemerintah daerah yang amanah dan pengelolaan lingkungan yang lestari.\n2. Melakukan pendidikan dan pelatihan bagi peningkatan kualitas sumberdaya manusia yang semakin bermartabat.\n3. Melakukan pengembangan dan pemberdayaan masyarakat untuk memperkuat kemandirian dan mengurangi kerentanan.\n4. Mengembangkan advokasi untuk mendorong terwujudnya good governance.",
            'sambutan_ketua_nama'    => 'Ketua LPPSP',
            'sambutan_ketua_jabatan' => 'Ketua Lembaga',
            'sambutan_ketua_isi'     => 'Selamat datang di LPPSP. Sejak berdiri pada 22 Mei 1998 di Semarang, LPPSP berkomitmen menjadi mitra profesional dalam pengkajian dan pengembangan sumberdaya pembangunan. Kami hadir untuk memberikan kontribusi nyata melalui kerja pengkajian, pengembangan, pemberdayaan masyarakat, dan penguatan tata kelola pemerintahan secara kolaboratif dan berkelanjutan.',
            'foto_ketua'             => null,
            'logo'                   => null,
            'alamat'                 => 'Bumi Wana Mukti Blok A4 No 31, Kelurahan Sambiroto, Kecamatan Tembalang, Kota Semarang',
            'telepon'                => '+6224-6705577, +6224-6701321',
            'email'                  => 'lppsp_semarang@yahoo.com',
            'website'                => 'https://lppspsemarang.org',
            'facebook'               => null,
            'instagram'              => null,
            'twitter'                => null,
            'youtube'                => null,
            'maps_embed'             => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.5843477818464!2d110.45781607593672!3d-7.058000471126744!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c1c4f4a9b6d%3A0xc345f7bd4c8b21ba!2sBumi%20Wana%20Mukti!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'foto_struktur_organisasi' => null,
            'created_at'             => now(),
            'updated_at'             => now(),
        ]);
    }
}
