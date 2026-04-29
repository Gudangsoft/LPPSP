<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE tim_organisasis MODIFY COLUMN kelompok ENUM('Tim Pengurus','Tim Pembina','Tim Pengawas','Tim Tenaga Ahli') NOT NULL DEFAULT 'Tim Pengurus'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tim_organisasis MODIFY COLUMN kelompok ENUM('Tim Pengurus','Tim Pembina','Tim Tenaga Ahli') NOT NULL DEFAULT 'Tim Pengurus'");
    }
};
