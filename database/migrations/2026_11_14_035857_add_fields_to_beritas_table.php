
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('beritas', function (Blueprint $table) {

            $table->string('judul');

            $table->string('slug')->unique();

            $table->string('kategori', 100);

            $table->text('deskripsi');

            $table->longText('konten')->nullable();

            $table->string('gambar')->nullable();

            $table->boolean('is_published')
                  ->default(false);

            $table->timestamp('published_at')
                  ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {

            $table->dropUnique(['slug']);

            $table->dropColumn([
                'judul',
                'slug',
                'kategori',
                'deskripsi',
                'konten',
                'gambar',
                'is_published',
                'published_at',
            ]);

        });
    }
};
