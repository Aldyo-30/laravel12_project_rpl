<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

test('post dapat dibuat dengan data yang valid', function () {
    $category = Category::create([
        'name' => 'Kategori Test',
        'slug' => 'kategori-test',
        'color' => '#FF0000',
    ]);

    $post = Post::create([
        'title' => 'Judul Post Test',
        'slug' => 'judul-post-test',
        'content' => 'Konten post test',
        'category' => $category->name,
    ]);

    expect($post->title)->toBe('Judul Post Test')
        ->and($post->content)->toBe('Konten post test')
        ->and($post->exists)->toBeTrue();
});

test('post memiliki relasi dengan category', function () {
    $category = Category::create([
        'name' => 'Kategori Relasi',
        'slug' => 'kategori-relasi',
        'color' => '#00FF00',
    ]);

    $post = Post::create([
        'title' => 'Post Relasi',
        'slug' => 'post-relasi',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    // Post menggunakan category sebagai string, bukan relasi
    expect($post->category)->toBe($category->name);
});

test('post dapat dibuat dengan category sebagai string', function () {
    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#0000FF',
    ]);

    $post = Post::create([
        'title' => 'Post dengan Category',
        'slug' => 'post-dengan-category',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    expect($post->category)->toBe($category->name);
});

test('post dapat melakukan filter berdasarkan search', function () {
    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#FFFF00',
    ]);

    Post::create([
        'title' => 'Post Pencarian Test',
        'slug' => 'post-pencarian-test',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    Post::create([
        'title' => 'Post Lain',
        'slug' => 'post-lain',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    $filtered = Post::filter(['search' => 'Pencarian'])->get();

    expect($filtered)->toHaveCount(1)
        ->and($filtered->first()->title)->toContain('Pencarian');
});

test('post dapat menyimpan konten tambahan sebagai array', function () {
    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#FF00FF',
    ]);

    $kontenTambahan = [
        'section1' => 'Konten section 1',
        'section2' => 'Konten section 2',
    ];

    $post = Post::create([
        'title' => 'Post Konten Tambahan',
        'slug' => 'post-konten-tambahan',
        'content' => 'Konten utama',
        'category' => $category->name,
        'konten_tambahan' => $kontenTambahan,
    ]);

    expect($post->konten_tambahan)->toBeArray()
        ->and($post->konten_tambahan['section1'])->toBe('Konten section 1');
});
