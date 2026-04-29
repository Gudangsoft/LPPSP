<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri_sliders', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('judul');
            $table->string('jabatan')->nullable()->after('nama');
            $table->string('wa')->nullable()->after('jabatan');
            $table->string('instagram')->nullable()->after('wa');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('facebook');
        });
    }

    public function down(): void
    {
        Schema::table('galeri_sliders', function (Blueprint $table) {
            $table->dropColumn(['nama', 'jabatan', 'wa', 'instagram', 'facebook', 'linkedin']);
        });
    }
};
