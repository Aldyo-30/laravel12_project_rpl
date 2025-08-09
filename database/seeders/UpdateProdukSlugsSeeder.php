<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Str;

class UpdateProdukSlugsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = Produk::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($produks as $produk) {
            $slug = Str::slug($produk->nama);
            $originalSlug = $slug;
            $count = 1;

            // Cek apakah slug sudah ada
            while (Produk::where('slug', $slug)->where('id', '!=', $produk->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $produk->update(['slug' => $slug]);
        }

        $this->command->info('Slug berhasil diupdate untuk ' . $produks->count() . ' produk.');
    }
}
