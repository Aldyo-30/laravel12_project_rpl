<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//BAGIAN VIDEO GALERY//
return new class extends Migration
{

    public function up(): void
{
    Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi');
        $table->string('link_youtube'); // Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ
        $table->date('tanggal')->nullable();
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
