<?php

use App\Models\Penduduk;

test('dapat mengakses halaman infografis', function () {
    $penduduk = Penduduk::create([
        'total' => 1000,
        'kepala_keluarga' => 250,
        'laki_laki' => 500,
        'perempuan' => 500,
        'desa' => 'Desa Test',
    ]);

    $response = $this->get('/infografis');

    $response->assertStatus(200)
        ->assertViewIs('infografis')
        ->assertViewHas('penduduks');
});

test('halaman infografis menampilkan data penduduk terbaru', function () {
    $penduduk1 = Penduduk::create([
        'total' => 1000,
        'kepala_keluarga' => 250,
        'laki_laki' => 500,
        'perempuan' => 500,
        'desa' => 'Desa Test 1',
        'created_at' => now()->subDay(),
    ]);

    $penduduk2 = Penduduk::create([
        'total' => 1200,
        'kepala_keluarga' => 300,
        'laki_laki' => 600,
        'perempuan' => 600,
        'desa' => 'Desa Test 2',
        'created_at' => now(),
    ]);

    $response = $this->get('/infografis');

    $penduduks = $response->viewData('penduduks');

    expect($penduduks->id)->toBe($penduduk2->id);
});
