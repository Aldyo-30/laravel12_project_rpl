<?php

use App\Models\Layanan;

test('layanan dapat dibuat dengan data yang valid', function () {
    $layanan = Layanan::create([
        'judul' => 'Layanan Test',
        'deskripsi' => 'Deskripsi layanan test',
    ]);

    expect($layanan->judul)->toBe('Layanan Test')
        ->and($layanan->deskripsi)->toBe('Deskripsi layanan test')
        ->and($layanan->exists)->toBeTrue();
});

test('layanan dapat diupdate', function () {
    $layanan = Layanan::create([
        'judul' => 'Layanan Awal',
        'deskripsi' => 'Deskripsi awal',
    ]);

    $layanan->update([
        'judul' => 'Layanan Updated',
        'deskripsi' => 'Deskripsi updated',
    ]);

    expect($layanan->judul)->toBe('Layanan Updated')
        ->and($layanan->deskripsi)->toBe('Deskripsi updated');
});

test('layanan dapat dihapus', function () {
    $layanan = Layanan::create([
        'judul' => 'Layanan Hapus',
        'deskripsi' => 'Deskripsi',
    ]);

    $layananId = $layanan->id;
    $layanan->delete();

    expect(Layanan::find($layananId))->toBeNull();
});
