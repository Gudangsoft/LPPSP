<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengalamans', function (Blueprint $table) {
            $table->unsignedBigInteger('layanan_id')->nullable()->after('id');
            $table->string('target_sasaran')->nullable()->after('klien');
            $table->string('lokasi')->nullable()->after('target_sasaran');

            $table->foreign('layanan_id')->references('id')->on('layanans')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengalamans', function (Blueprint $table) {
            $table->dropForeign(['layanan_id']);
            $table->dropColumn(['layanan_id', 'target_sasaran', 'lokasi']);
        });
    }
};
