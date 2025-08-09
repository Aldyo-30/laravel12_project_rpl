<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sejarahs', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi')->nullable();
            $table->string('slug')->unique(); 
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sejarahs');
    }
};
