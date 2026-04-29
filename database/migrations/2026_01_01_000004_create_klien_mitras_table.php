<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('klien_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('kategori', [
                'Kementerian/Lembaga',
                'Pemerintah Daerah',
                'OPD/Instansi Teknis',
                'Lembaga Pendidikan',
                'Dunia Usaha',
                'Lembaga Mitra',
            ]);
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('klien_mitras');
    }
};
