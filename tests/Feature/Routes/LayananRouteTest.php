<?php

use App\Models\Layanan;

test('dapat mengakses halaman layanan', function () {
    $response = $this->get('/layanan');

    $response->assertStatus(200)
        ->assertViewIs('layanan')
        ->assertViewHas('layanans');
});

test('halaman layanan menampilkan semua layanan', function () {
    Layanan::create([
        'judul' => 'Layanan 1',
        'deskripsi' => 'Deskripsi layanan 1',
    ]);

    Layanan::create([
        'judul' => 'Layanan 2',
        'deskripsi' => 'Deskripsi layanan 2',
    ]);

    $response = $this->get('/layanan');

    $layanans = $response->viewData('layanans');

    expect($layanans)->toHaveCount(2);
});
