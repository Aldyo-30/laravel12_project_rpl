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
    Schema::create('penduduks', function (Blueprint $table) {
        $table->id();
        $table->integer('total')->default(0);
        $table->integer('kepala_keluarga')->default(0);
        $table->integer('laki_laki')->default(0);
        $table->integer('perempuan')->default(0);
        $table->integer('desa')->default(5); // Tetap 1 desa
        $table->integer('dusun_1')->default(0);
        $table->integer('dusun_2')->default(0);
        $table->integer('dusun_3')->default(0);
        $table->integer('dusun_4')->default(0);
        $table->integer('dusun_5')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
