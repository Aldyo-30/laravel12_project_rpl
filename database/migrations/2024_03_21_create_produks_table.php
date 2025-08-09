<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('gambar_path');
            $table->string('jenis_makanan')->nullable();
            $table->string('bahan_utama')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->string('nama_penjual')->nullable();
            $table->string('telepon_penjual')->nullable();
            $table->text('alamat_penjual')->nullable();
            $table->string('gambar1')->nullable();
            $table->string('gambar2')->nullable();
            $table->string('gambar3')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
