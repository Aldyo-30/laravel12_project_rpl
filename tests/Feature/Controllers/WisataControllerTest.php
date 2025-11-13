<?php

use App\Models\Wisata;

test('dapat menampilkan halaman index wisata', function () {
    Wisata::create([
        'judul' => 'Wisata 1',
        'slug' => 'wisata-1',
        'deskripsi' => 'Deskripsi wisata 1',
        'harga' => 100000,
    ]);

    Wisata::create([
        'judul' => 'Wisata 2',
        'slug' => 'wisata-2',
        'deskripsi' => 'Deskripsi wisata 2',
        'harga' => 150000,
    ]);

    $response = $this->get(route('wisata'));

    $response->assertStatus(200)
        ->assertViewIs('wisata')
        ->assertViewHas('wisatas');
});

test('dapat menampilkan detail wisata', function () {
    $wisata = Wisata::create([
        'judul' => 'Wisata Detail',
        'slug' => 'wisata-detail',
        'deskripsi' => 'Deskripsi detail wisata',
        'harga' => 200000,
    ]);

    $response = $this->get(route('wisata.show', $wisata));

    $response->assertStatus(200)
        ->assertViewIs('detail-wisata')
        ->assertViewHas('wisata', $wisata);
});

test('wisata diurutkan berdasarkan created_at descending', function () {
    $wisata1 = Wisata::create([
        'judul' => 'Wisata Pertama',
        'slug' => 'wisata-pertama',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
        'created_at' => now()->subDay(),
    ]);

    $wisata2 = Wisata::create([
        'judul' => 'Wisata Kedua',
        'slug' => 'wisata-kedua',
        'deskripsi' => 'Deskripsi',
        'harga' => 150000,
        'created_at' => now(),
    ]);

    $response = $this->get(route('wisata'));

    $wisatas = $response->viewData('wisatas');

    expect($wisatas->first()->id)->toBe($wisata2->id);
});
