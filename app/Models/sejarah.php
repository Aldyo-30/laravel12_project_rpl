<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sejarah extends Model
{
    protected $fillable = ['judul', 'slug', 'isi', 'gambar'];

    // Auto-generate slug saat menyimpan
    protected static function booted()
    {
        static::creating(function ($sejarah) {
            $sejarah->slug = Str::slug($sejarah->judul);
        });

        static::updating(function ($sejarah) {
            $sejarah->slug = Str::slug($sejarah->judul);
        });
    }
}
