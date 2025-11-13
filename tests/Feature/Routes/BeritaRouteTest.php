<?php

use App\Models\Post;
use App\Models\Category;

test('dapat mengakses halaman berita', function () {
    $response = $this->get('/berita');

    $response->assertStatus(200)
        ->assertViewIs('berita')
        ->assertViewHas('title', 'Berita Desa')
        ->assertViewHas('posts');
});

test('halaman berita menampilkan semua post dengan pagination', function () {
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
    ]);

    Post::create([
        'title' => 'Post 2',
        'slug' => 'post-2',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    $response = $this->get('/berita');

    $posts = $response->viewData('posts');

    expect($posts->count())->toBeGreaterThan(0);
});

test('dapat melakukan pencarian post di halaman berita', function () {
    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#FF0000',
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

    $response = $this->get('/berita?search=Pencarian');

    $posts = $response->viewData('posts');

    expect($posts->count())->toBe(1)
        ->and($posts->first()->title)->toContain('Pencarian');
});

test('dapat mengakses detail berita dengan slug', function () {
    $category = Category::create([
        'name' => 'Kategori',
        'slug' => 'kategori',
        'color' => '#FF0000',
    ]);

    $post = Post::create([
        'title' => 'Post Detail',
        'slug' => 'post-detail',
        'content' => 'Konten detail',
        'category' => $category->name,
    ]);

    $response = $this->get("/berita/{$post->slug}");

    $response->assertStatus(200)
        ->assertViewIs('detail-berita')
        ->assertViewHas('title', 'Berita')
        ->assertViewHas('post', $post);
});
