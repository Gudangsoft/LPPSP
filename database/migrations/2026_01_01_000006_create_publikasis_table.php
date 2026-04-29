<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publikasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('kategori', ['Buku', 'Artikel', 'Berita Kegiatan', 'Foto/Video Kegiatan']);
            $table->string('penulis')->nullable();
            $table->text('deskripsi')->nullable();
            $table->longText('konten')->nullable();
            $table->string('gambar')->nullable();
            $table->string('file_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('slug')->unique();
            $table->date('tanggal_terbit')->nullable();
            $table->boolean('unggulan')->default(false);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publikasis');
    }
};
