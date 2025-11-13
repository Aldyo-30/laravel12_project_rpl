<?php

use App\Models\Produk;
use Illuminate\Support\Str;

test('produk dapat dibuat dengan data yang valid', function () {
    $produk = Produk::create([
        'nama' => 'Produk Test',
        'deskripsi' => 'Deskripsi produk test',
        'gambar_path' => 'storage/produk/test.jpg',
        'harga' => 50000,
    ]);

    expect($produk->nama)->toBe('Produk Test')
        ->and($produk->deskripsi)->toBe('Deskripsi produk test')
        ->and($produk->exists)->toBeTrue();
});

test('produk secara otomatis menghasilkan slug dari nama', function () {
    $produk = Produk::create([
        'nama' => 'Produk Test Slug',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    expect($produk->slug)->toBe(Str::slug('Produk Test Slug'));
});

test('produk menghasilkan slug unik jika slug sudah ada', function () {
    Produk::create([
        'nama' => 'Produk Duplikat',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $produk2 = Produk::create([
        'nama' => 'Produk Duplikat',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test2.jpg',
    ]);

    expect($produk2->slug)->toBe('produk-duplikat-1');
});

test('produk menggunakan slug sebagai route key', function () {
    $produk = Produk::create([
        'nama' => 'Produk Route Key',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    expect($produk->getRouteKeyName())->toBe('slug');
});

test('produk dapat diupdate', function () {
    $produk = Produk::create([
        'nama' => 'Produk Awal',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $produk->update([
        'nama' => 'Produk Baru',
        'deskripsi' => 'Deskripsi Updated',
    ]);

    expect($produk->nama)->toBe('Produk Baru')
        ->and($produk->deskripsi)->toBe('Deskripsi Updated');
});
