<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga');
            $table->string('singkatan')->nullable();
            $table->string('tagline')->nullable();
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('tentang_kami')->nullable();
            $table->longText('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->string('sambutan_ketua_nama')->nullable();
            $table->string('sambutan_ketua_jabatan')->nullable();
            $table->longText('sambutan_ketua_isi')->nullable();
            $table->string('foto_ketua')->nullable();
            $table->string('logo')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('maps_embed')->nullable();
            $table->string('foto_struktur_organisasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
