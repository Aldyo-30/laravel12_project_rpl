# Dokumentasi Testing

Dokumentasi ini menjelaskan struktur dan cara menjalankan test untuk proyek Laravel ini.

## Struktur Test

### Unit Tests (`tests/Unit/`)

Unit tests untuk model-model utama:

-   **`Models/ProdukTest.php`** - Test untuk model Produk

    -   Pembuatan produk dengan data valid
    -   Auto-generate slug dari nama
    -   Slug unik untuk produk duplikat
    -   Route key menggunakan slug
    -   Update slug saat nama berubah

-   **`Models/PostTest.php`** - Test untuk model Post

    -   Pembuatan post dengan data valid
    -   Relasi dengan Category
    -   Relasi dengan Author (User)
    -   Filter berdasarkan search
    -   Konten tambahan sebagai array

-   **`Models/WisataTest.php`** - Test untuk model Wisata

    -   Pembuatan wisata dengan data valid
    -   Auto-generate slug dari judul
    -   Slug unik untuk wisata duplikat
    -   Route key menggunakan slug
    -   Update slug saat judul berubah

-   **`Models/CategoryTest.php`** - Test untuk model Category

    -   Pembuatan category dengan data valid
    -   Relasi hasMany dengan Posts

-   **`Models/LayananTest.php`** - Test untuk model Layanan
    -   CRUD operations untuk Layanan

### Feature Tests (`tests/Feature/`)

#### Controllers (`tests/Feature/Controllers/`)

-   **`ProdukControllerTest.php`** - Test untuk ProdukController

    -   Index, create, store, show, edit, update, destroy
    -   Validasi form
    -   Upload gambar

-   **`WisataControllerTest.php`** - Test untuk WisataController

    -   Index dan show
    -   Sorting berdasarkan created_at

-   **`GalleryControllerTest.php`** - Test untuk GalleryController

    -   Index dengan pagination
    -   Sorting berdasarkan created_at

-   **`VideoControllerTest.php`** - Test untuk VideoController
    -   Index dengan pagination
    -   Sorting berdasarkan created_at (oldest)

#### Routes (`tests/Feature/Routes/`)

-   **`HomeRouteTest.php`** - Test untuk route home

    -   Menampilkan data officials, posts, welcome, sejarah, galleries, wisatas, produks
    -   Limit 6 post terbaru

-   **`BeritaRouteTest.php`** - Test untuk route berita

    -   List berita dengan pagination
    -   Pencarian berita
    -   Detail berita dengan slug

-   **`LayananRouteTest.php`** - Test untuk route layanan

    -   Menampilkan semua layanan

-   **`SejarahRouteTest.php`** - Test untuk route sejarah

    -   Menampilkan data sejarah pertama

-   **`InfografisRouteTest.php`** - Test untuk route infografis
    -   Menampilkan data penduduk terbaru

## Menjalankan Test

### Menjalankan Semua Test

```bash
php artisan test
```

atau

```bash
./vendor/bin/pest
```

### Menjalankan Test Spesifik

```bash
# Test untuk model tertentu
php artisan test --filter ProdukTest

# Test untuk controller tertentu
php artisan test --filter ProdukControllerTest

# Test untuk route tertentu
php artisan test --filter HomeRouteTest
```

### Menjalankan Test dengan Coverage

```bash
php artisan test --coverage
```

### Menjalankan Test dengan Verbose Output

```bash
php artisan test -v
```

## Framework Testing

Proyek ini menggunakan **Pest PHP** sebagai framework testing, yang dibangun di atas PHPUnit dengan syntax yang lebih sederhana dan readable.

## Catatan Penting

1. Semua test menggunakan `RefreshDatabase` trait, sehingga database akan di-reset untuk setiap test
2. Test menggunakan SQLite in-memory database untuk performa yang lebih cepat
3. File upload di-test menggunakan `Storage::fake()` untuk menghindari file system operations yang sebenarnya

## Menambahkan Test Baru

Saat menambahkan fitur baru, pastikan untuk:

1. Menambahkan unit test untuk model baru
2. Menambahkan feature test untuk controller baru
3. Menambahkan feature test untuk route baru
4. Memastikan semua test passing sebelum commit

## Best Practices

-   Test harus independent (tidak bergantung pada test lain)
-   Gunakan factory atau seeder untuk data test
-   Test harus cepat dan dapat dijalankan berulang kali
-   Test harus jelas dan mudah dipahami
-   Cover edge cases dan error scenarios
