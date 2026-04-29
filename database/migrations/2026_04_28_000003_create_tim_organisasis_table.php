<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tim_organisasis', function (Blueprint $table) {
            $table->id();
            $table->enum('kelompok', ['Tim Pengurus', 'Tim Pembina', 'Tim Tenaga Ahli'])->default('Tim Pengurus');
            $table->string('nama');
            $table->string('jabatan');
            $table->text('bio')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('foto')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tim_organisasis');
    }
};
