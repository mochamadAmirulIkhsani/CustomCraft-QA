<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');      // Path ke file gambar
            $table->string('title')->nullable(); // Judul/alt text untuk gambar
            $table->string('url')->nullable();   // Link jika banner ingin bisa diklik
            $table->integer('sort_order')->default(0); // Untuk urutan tampilan
            $table->boolean('is_active')->default(true); // Untuk aktif/nonaktifkan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
