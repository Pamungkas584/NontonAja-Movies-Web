<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('imdb_id')->unique(); // Sangat penting untuk validasi kecocokan data API
            $table->string('title');
            $table->text('description')->nullable(); // Menggunakan text() untuk menampung data 'Plot' panjang
            $table->decimal('rating', 3, 1)->nullable(); // Menggunakan desimal (total 3 digit, 1 angka di belakang koma)
            $table->integer('year')->nullable();
            $table->string('age_rating')->nullable(); // Menampung field 'Rated' dari IMDb
            $table->string('category'); // Menampung string kumpulan 'Genre' dari IMDb
            $table->text('thumbnail_url')->nullable(); // Menggunakan text() karena string URL poster dari API sering kali sangat panjang
            $table->text('banner_url')->nullable(); // Untuk kebutuhan gambar slider/hero banner
            $table->boolean('is_hero')->default(false); // Flag untuk memisahkan konten slider atas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};