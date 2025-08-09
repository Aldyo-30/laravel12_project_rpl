<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Category::factory(3)->create();

        Category::create(
            [
                'name' => 'Berita',
                'slug' => 'berita',
                'color' => 'blue'
            ]
        );
        Category::create(
            [
                'name' => 'Artikel',
                'slug' => 'artikel',
                'color' => 'yellow'
            ]
        );
    }
}
