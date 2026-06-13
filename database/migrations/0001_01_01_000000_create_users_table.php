<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // Data Integrasi Google
            $table->string('google_id')->unique()->nullable(); 
            $table->string('avatar_url')->nullable(); 

            // Data Pribadi User
            $table->string('name'); 
            $table->string('email')->unique();
            $table->string('username')->unique()->nullable(); 
            
            // Data Langganan (VIP)
            $table->timestamp('vip_until')->nullable(); 

            // Autentikasi Bawaan Laravel
            $table->string('password')->nullable(); // Nullable karena login via Google tidak butuh password
            $table->rememberToken(); // Pengganti kolom "cookie" mentah
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};