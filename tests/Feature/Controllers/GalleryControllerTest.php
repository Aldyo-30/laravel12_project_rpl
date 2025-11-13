<?php

use App\Models\Gallery;

test('dapat menampilkan halaman index gallery', function () {
    Gallery::create([
        'judul' => 'Gallery 1',
        'gambar' => 'storage/gallery/test1.jpg',
    ]);

    Gallery::create([
        'judul' => 'Gallery 2',
        'gambar' => 'storage/gallery/test2.jpg',
    ]);

    $response = $this->get(route('gallery'));

    $response->assertStatus(200)
        ->assertViewIs('gallery')
        ->assertViewHas('galleries');
});

test('gallery diurutkan berdasarkan created_at descending', function () {
    $gallery1 = Gallery::create([
        'judul' => 'Gallery Pertama',
        'gambar' => 'storage/gallery/test1.jpg',
        'created_at' => now()->subDay(),
    ]);

    $gallery2 = Gallery::create([
        'judul' => 'Gallery Kedua',
        'gambar' => 'storage/gallery/test2.jpg',
        'created_at' => now(),
    ]);

    $response = $this->get(route('gallery'));

    $galleries = $response->viewData('galleries');

    expect($galleries->first()->id)->toBe($gallery2->id);
});
