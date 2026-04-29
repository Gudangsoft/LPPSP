<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('foto_layanan')->nullable()->after('foto_struktur_organisasi');
            $table->text('deskripsi_layanan')->nullable()->after('foto_layanan');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['foto_layanan', 'deskripsi_layanan']);
        });
    }
};
