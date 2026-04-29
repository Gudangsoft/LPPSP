<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengalamans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('klien');
            $table->string('kategori')->nullable();
            $table->integer('tahun');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('unggulan')->default(false);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengalamans');
    }
};
