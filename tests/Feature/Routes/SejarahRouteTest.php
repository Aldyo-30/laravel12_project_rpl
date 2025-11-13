<?php

use App\Models\Sejarah;

test('dapat mengakses halaman sejarah', function () {
    $sejarah = Sejarah::create([
        'judul' => 'Sejarah Desa',
        'isi' => 'Konten sejarah desa',
    ]);

    $response = $this->get('/sejarah');

    $response->assertStatus(200)
        ->assertViewIs('sejarah')
        ->assertViewHas('sejarah');
});

test('halaman sejarah menampilkan data sejarah pertama', function () {
    $sejarah1 = Sejarah::create([
        'judul' => 'Sejarah Pertama',
        'isi' => 'Konten pertama',
    ]);

    $sejarah2 = Sejarah::create([
        'judul' => 'Sejarah Kedua',
        'isi' => 'Konten kedua',
    ]);

    $response = $this->get('/sejarah');

    $sejarah = $response->viewData('sejarah');

    expect($sejarah->id)->toBe($sejarah1->id);
});
