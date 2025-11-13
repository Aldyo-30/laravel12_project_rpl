<?php

use App\Models\Wisata;
use Illuminate\Support\Str;

test('wisata dapat dibuat dengan data yang valid', function () {
    $wisata = Wisata::create([
        'judul' => 'Wisata Test',
        'deskripsi' => 'Deskripsi wisata test',
        'harga' => 100000,
        'gambar' => 'storage/wisata/test.jpg',
    ]);

    expect($wisata->judul)->toBe('Wisata Test')
        ->and($wisata->deskripsi)->toBe('Deskripsi wisata test')
        ->and($wisata->harga)->toBe(100000)
        ->and($wisata->exists)->toBeTrue();
});

test('wisata secara otomatis menghasilkan slug dari judul', function () {
    $wisata = Wisata::create([
        'judul' => 'Wisata Test Slug',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
    ]);

    expect($wisata->slug)->toBe(Str::slug('Wisata Test Slug'));
});

test('wisata menghasilkan slug unik jika slug sudah ada', function () {
    Wisata::create([
        'judul' => 'Wisata Duplikat',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
    ]);

    $wisata2 = Wisata::create([
        'judul' => 'Wisata Duplikat',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
    ]);

    expect($wisata2->slug)->toBe('wisata-duplikat-1');
});

test('wisata menggunakan slug sebagai route key', function () {
    $wisata = Wisata::create([
        'judul' => 'Wisata Route Key',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
    ]);

    expect($wisata->getRouteKeyName())->toBe('slug');
});

test('wisata dapat diupdate', function () {
    $wisata = Wisata::create([
        'judul' => 'Wisata Awal',
        'deskripsi' => 'Deskripsi',
        'harga' => 100000,
    ]);

    $wisata->update([
        'judul' => 'Wisata Baru',
        'deskripsi' => 'Deskripsi Updated',
        'harga' => 150000,
    ]);

    expect($wisata->judul)->toBe('Wisata Baru')
        ->and($wisata->deskripsi)->toBe('Deskripsi Updated')
        ->and($wisata->harga)->toBe(150000);
});
