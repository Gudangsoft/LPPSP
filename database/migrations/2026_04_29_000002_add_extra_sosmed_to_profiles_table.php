<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('youtube');
            $table->string('linkedin')->nullable()->after('tiktok');
            $table->string('whatsapp')->nullable()->after('linkedin');
            $table->string('telegram')->nullable()->after('whatsapp');
            $table->string('threads')->nullable()->after('telegram');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['tiktok', 'linkedin', 'whatsapp', 'telegram', 'threads']);
        });
    }
};
