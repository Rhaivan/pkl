<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('pengguna', 'tanggal_daftar')) {
            Schema::table('pengguna', function (Blueprint $table) {
                $table->timestamp('tanggal_daftar')->nullable()->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pengguna', 'tanggal_daftar')) {
            Schema::table('pengguna', function (Blueprint $table) {
                $table->dropColumn('tanggal_daftar');
            });
        }
    }
};