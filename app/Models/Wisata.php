<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'harga',
        'deskripsi',
        'slug',
        'nama_pemilik',
        'telepon',
        'alamat',
        'gambar',
        'gambar1',
        'gambar2',
        'gambar3',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($wisata) {
            if (empty($wisata->slug)) {
                $wisata->slug = static::generateUniqueSlug($wisata->judul);
            }
        });
        static::updating(function ($wisata) {
            if ($wisata->isDirty('judul') && empty($wisata->slug)) {
                $wisata->slug = static::generateUniqueSlug($wisata->judul);
            }
        });
    }

    public static function generateUniqueSlug($judul)
    {
        $slug = Str::slug($judul);
        $originalSlug = $slug;
        $count = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
