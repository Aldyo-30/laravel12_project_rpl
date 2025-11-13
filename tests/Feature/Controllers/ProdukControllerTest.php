<?php

use App\Models\Produk;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('dapat menampilkan halaman index produk', function () {
    Produk::create([
        'nama' => 'Produk 1',
        'slug' => 'produk-1',
        'deskripsi' => 'Deskripsi produk 1',
        'gambar_path' => 'storage/produk/test1.jpg',
    ]);

    Produk::create([
        'nama' => 'Produk 2',
        'slug' => 'produk-2',
        'deskripsi' => 'Deskripsi produk 2',
        'gambar_path' => 'storage/produk/test2.jpg',
    ]);

    $response = $this->get(route('produk.index'));

    $response->assertStatus(200)
        ->assertViewIs('produk')
        ->assertViewHas('produk');
});

test('dapat menampilkan halaman create produk', function () {
    $response = $this->get(route('produk.create'));

    $response->assertStatus(200)
        ->assertViewIs('produk.create');
});

test('dapat menyimpan produk baru', function () {
    Storage::fake('public');

    $gambar = UploadedFile::fake()->image('produk.jpg', 800, 600);

    $response = $this->post(route('produk.store'), [
        'nama' => 'Produk Baru',
        'deskripsi' => 'Deskripsi produk baru',
        'gambar' => $gambar,
    ]);

    $response->assertRedirect(route('produk.index'))
        ->assertSessionHas('success', 'Produk berhasil ditambahkan');

    $this->assertDatabaseHas('produks', [
        'nama' => 'Produk Baru',
        'deskripsi' => 'Deskripsi produk baru',
    ]);
});

test('validasi gagal jika nama tidak diisi saat menyimpan produk', function () {
    Storage::fake('public');

    $gambar = UploadedFile::fake()->image('produk.jpg');

    $response = $this->post(route('produk.store'), [
        'deskripsi' => 'Deskripsi',
        'gambar' => $gambar,
    ]);

    $response->assertSessionHasErrors('nama');
});

test('validasi gagal jika gambar tidak diisi saat menyimpan produk', function () {
    $response = $this->post(route('produk.store'), [
        'nama' => 'Produk Tanpa Gambar',
        'deskripsi' => 'Deskripsi',
    ]);

    $response->assertSessionHasErrors('gambar');
});

test('dapat menampilkan detail produk', function () {
    $produk = Produk::create([
        'nama' => 'Produk Detail',
        'slug' => 'produk-detail',
        'deskripsi' => 'Deskripsi detail',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $response = $this->get(route('produk.show', $produk));

    $response->assertStatus(200)
        ->assertViewIs('detail-produk')
        ->assertViewHas('produk', $produk);
});

test('dapat menampilkan halaman edit produk', function () {
    $produk = Produk::create([
        'nama' => 'Produk Edit',
        'slug' => 'produk-edit',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $response = $this->get(route('produk.edit', $produk));

    $response->assertStatus(200)
        ->assertViewIs('produk.edit')
        ->assertViewHas('produk', $produk);
});

test('dapat mengupdate produk', function () {
    Storage::fake('public');

    $produk = Produk::create([
        'nama' => 'Produk Awal',
        'slug' => 'produk-awal',
        'deskripsi' => 'Deskripsi awal',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $response = $this->put(route('produk.update', $produk), [
        'nama' => 'Produk Updated',
        'deskripsi' => 'Deskripsi updated',
    ]);

    $response->assertRedirect(route('produk.index'))
        ->assertSessionHas('success', 'Produk berhasil diperbarui');

    $this->assertDatabaseHas('produks', [
        'id' => $produk->id,
        'nama' => 'Produk Updated',
        'deskripsi' => 'Deskripsi updated',
    ]);
});

test('dapat menghapus produk', function () {
    Storage::fake('public');

    $produk = Produk::create([
        'nama' => 'Produk Hapus',
        'slug' => 'produk-hapus',
        'deskripsi' => 'Deskripsi',
        'gambar_path' => 'storage/produk/test.jpg',
    ]);

    $response = $this->delete(route('produk.destroy', $produk));

    $response->assertRedirect(route('produk.index'))
        ->assertSessionHas('success', 'Produk berhasil dihapus');

    $this->assertDatabaseMissing('produks', [
        'id' => $produk->id,
    ]);
});
