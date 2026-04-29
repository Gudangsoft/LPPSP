<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('footer_slogan')->nullable()->after('deskripsi_singkat');
            $table->string('footer_copyright')->nullable()->after('footer_slogan');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['footer_slogan', 'footer_copyright']);
        });
    }
};
