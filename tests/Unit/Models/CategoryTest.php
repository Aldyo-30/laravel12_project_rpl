<?php

use App\Models\Category;
use App\Models\Post;

test('category dapat dibuat dengan data yang valid', function () {
    $category = Category::create([
        'name' => 'Kategori Test',
        'slug' => 'kategori-test',
        'color' => '#FF0000',
    ]);

    expect($category->name)->toBe('Kategori Test')
        ->and($category->slug)->toBe('kategori-test')
        ->and($category->color)->toBe('#FF0000')
        ->and($category->exists)->toBeTrue();
});

test('category dapat digunakan sebagai string di posts', function () {
    $category = Category::create([
        'name' => 'Kategori Relasi',
        'slug' => 'kategori-relasi',
        'color' => '#00FF00',
    ]);

    $post1 = Post::create([
        'title' => 'Post 1',
        'slug' => 'post-1',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    $post2 = Post::create([
        'title' => 'Post 2',
        'slug' => 'post-2',
        'content' => 'Konten',
        'category' => $category->name,
    ]);

    // Posts menggunakan category sebagai string, bukan relasi
    expect($post1->category)->toBe($category->name)
        ->and($post2->category)->toBe($category->name);
});
