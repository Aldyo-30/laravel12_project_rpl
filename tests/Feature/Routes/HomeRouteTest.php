<?php

use App\Models\Post;
use App\Models\Produk;
use App\Models\Wisata;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\Official;
use App\Models\Sejarah;
use App\Models\WelcomeSetting;
use App\Models\Category;

test('dapat mengakses halaman home', function () {
    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertViewIs('welcome');
});

test('halaman home menampilkan data yang diperlukan', function () {
    $official = Official::create([
        'name' => 'Official Test',
        'position' => 'Kepala Desa',
    ]);

    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#FF0000',
    ]);

    $post = Post::create([
        'title' => 'Post Test',
        'slug' => 'post-test',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    $welcome = WelcomeSetting::create([
        'title' => 'Welcome Test',
        'description' => 'Deskripsi welcome',
    ]);

    $sejarah = Sejarah::create([
        'judul' => 'Sejarah Test',
        'isi' => 'Konten sejarah',
    ]);

    $gallery = Gallery::create([
        'judul' => 'Gallery Test',
        'gambar' => 'storage/gallery/test.jpg',
    ]);

    $wisata = Wisata::create([
        'judul' => 'Wisata Test',
        'slug' => 'wisata-test',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
    ]);

    $produk = Produk::create([
        'nama' => 'Produk Test',
        'slug' => 'produk-test',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200)
        ->assertViewHas('officials')
        ->assertViewHas('posts')
        ->assertViewHas('welcome')
        ->assertViewHas('sejarah')
        ->assertViewHas('galleries')
        ->assertViewHas('wisatas')
        ->assertViewHas('produks');
});

test('halaman home menampilkan 6 post terbaru', function () {
    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#FF0000',
    ]);

    Post::create([
        'title' => 'Post 1',
        'slug' => 'post-1',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDays(7),
    ]);

    Post::create([
        'title' => 'Post 2',
        'slug' => 'post-2',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDays(6),
    ]);

    Post::create([
        'title' => 'Post 3',
        'slug' => 'post-3',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDays(5),
    ]);

    Post::create([
        'title' => 'Post 4',
        'slug' => 'post-4',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDays(4),
    ]);

    Post::create([
        'title' => 'Post 5',
        'slug' => 'post-5',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDays(3),
    ]);

    Post::create([
        'title' => 'Post 6',
        'slug' => 'post-6',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDays(2),
    ]);

    Post::create([
        'title' => 'Post 7',
        'slug' => 'post-7',
        'content' => 'Konten',
        'category' => $category->name,
        'created_at' => now()->subDay(),
    ]);

    $response = $this->get('/');

    $posts = $response->viewData('posts');

    expect($posts)->toHaveCount(6)
        ->and($posts->first()->title)->toBe('Post 7');
});
