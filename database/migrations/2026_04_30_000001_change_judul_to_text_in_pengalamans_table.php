<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengalamans', function (Blueprint $table) {
            $table->text('judul')->change();
            $table->text('klien')->nullable()->change();
            $table->text('target_sasaran')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengalamans', function (Blueprint $table) {
            $table->string('judul', 300)->change();
            $table->string('klien', 200)->nullable()->change();
            $table->string('target_sasaran', 300)->nullable()->change();
        });
    }
};
