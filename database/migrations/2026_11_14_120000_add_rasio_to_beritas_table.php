<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            // Kolom untuk menentukan bentuk foto pada halaman editorial.
            // Nilai default dipakai oleh berita lama yang sudah tersimpan.
            $table->string('rasio', 5)->default('16:9')->after('gambar');
        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            $table->dropColumn('rasio');
        });
    }
};
