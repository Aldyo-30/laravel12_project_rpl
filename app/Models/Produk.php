<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'gambar_path',
        'jenis_makanan',
        'bahan_utama',
        'harga',
        'nama_penjual',
        'telepon_penjual',
        'alamat_penjual',
        'gambar1',
        'gambar2',
        'gambar3'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = $produk->generateSlug($produk->nama);
            }
        });

        static::updating(function ($produk) {
            if ($produk->isDirty('nama') && empty($produk->slug)) {
                $produk->slug = $produk->generateSlug($produk->nama);
            }
        });
    }

    public function generateSlug($nama)
    {
        $slug = Str::slug($nama);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada, jika ada tambahkan angka
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
