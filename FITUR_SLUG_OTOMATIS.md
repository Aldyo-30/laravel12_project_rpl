# Fitur Slug Otomatis untuk Produk

## Overview

Fitur slug otomatis telah berhasil ditambahkan ke sistem produk. Slug akan terisi otomatis berdasarkan nama produk dan memastikan URL yang SEO-friendly.

## Fitur yang Ditambahkan

### ✅ **Slug Otomatis di Filament**

-   **Auto-fill**: Slug terisi otomatis saat nama produk diketik
-   **Live Update**: Slug update real-time saat nama berubah
-   **Manual Override**: Bisa edit slug manual jika diperlukan
-   **Generate Button**: Tombol untuk regenerate slug
-   **Unique Validation**: Memastikan slug tidak duplikat

### ✅ **Database Migration**

-   Kolom `slug` ditambahkan ke tabel `produks`
-   Unique constraint untuk mencegah duplikasi
-   Index untuk performa query yang lebih baik

### ✅ **Model Enhancement**

-   Auto-generate slug saat create/update
-   Handle duplikasi slug dengan penambahan angka
-   Route key name menggunakan slug

### ✅ **Controller Update**

-   Method `show()` menggunakan slug untuk routing
-   Auto-generate slug saat create produk
-   Update slug saat nama produk berubah

## Cara Kerja

### 1. **Auto-Generation**

```php
// Saat create produk baru
$slug = Str::slug($request->nama); // "Nasi Goreng" -> "nasi-goreng"

// Handle duplikasi
while (Produk::where('slug', $slug)->exists()) {
    $slug = $originalSlug . '-' . $count; // "nasi-goreng-1"
    $count++;
}
```

### 2. **Live Update di Filament**

```php
TextInput::make('nama')
    ->live(onBlur: true)
    ->afterStateUpdated(function (string $state, callable $set) {
        if (!empty($state)) {
            $set('slug', Str::slug($state));
        }
    }),
```

### 3. **Manual Override**

```php
TextInput::make('slug')
    ->suffixAction(
        Action::make('generate-slug')
            ->label('Generate')
            ->action(function (callable $get, callable $set) {
                $nama = $get('nama');
                if (!empty($nama)) {
                    $set('slug', Str::slug($nama));
                }
            })
    ),
```

## URL Structure

### Sebelum (dengan ID)

```
/produk/1
/produk/2
/produk/3
```

### Sesudah (dengan Slug)

```
/produk/nasi-goreng
/produk/mie-goreng
/produk/es-kopi
```

## Keuntungan

### 1. **SEO-Friendly**

-   URL yang mudah dibaca
-   Kata kunci dalam URL
-   Lebih baik untuk search engine

### 2. **User Experience**

-   URL yang informatif
-   Mudah diingat
-   Lebih profesional

### 3. **Maintenance**

-   Auto-handle duplikasi
-   Konsisten dengan standar web
-   Mudah diupdate

## Contoh Penggunaan

### 1. **Create Produk Baru**

1. Buka Filament Admin Panel
2. Klik "Create Produk"
3. Isi nama: "Nasi Goreng Spesial"
4. Slug otomatis terisi: "nasi-goreng-spesial"
5. Bisa edit manual jika diperlukan
6. Klik "Generate" untuk regenerate

### 2. **Update Produk**

1. Edit produk yang ada
2. Ubah nama: "Nasi Goreng Premium"
3. Slug otomatis update: "nasi-goreng-premium"
4. Jika ada duplikasi, akan jadi: "nasi-goreng-premium-1"

### 3. **Akses via URL**

```
http://localhost:8000/produk/nasi-goreng-spesial
http://localhost:8000/produk/mie-goreng-pedas
http://localhost:8000/produk/es-kopi-hitam
```

## Database Structure

```sql
ALTER TABLE produks ADD COLUMN slug VARCHAR(255) UNIQUE AFTER nama;
```

## Migration & Seeder

### Migration

```php
Schema::table('produks', function (Blueprint $table) {
    $table->string('slug')->unique()->after('nama');
});
```

### Seeder untuk Data Existing

```php
// UpdateProdukSlugsSeeder
foreach ($produks as $produk) {
    $slug = Str::slug($produk->nama);
    // Handle duplikasi...
    $produk->update(['slug' => $slug]);
}
```

## Troubleshooting

### 1. **Slug Tidak Terisi Otomatis**

-   Pastikan field nama tidak kosong
-   Cek console browser untuk error JavaScript
-   Clear cache: `php artisan config:clear`

### 2. **Error Duplicate Slug**

-   Sistem otomatis handle dengan penambahan angka
-   Bisa edit manual di field slug
-   Gunakan tombol "Generate" untuk regenerate

### 3. **URL Tidak Bekerja**

-   Pastikan route sudah diupdate: `{produk:slug}`
-   Clear route cache: `php artisan route:clear`
-   Cek apakah slug ada di database

## Best Practices

### 1. **Naming Convention**

-   Gunakan huruf kecil
-   Pisahkan dengan tanda strip (-)
-   Hindari karakter khusus
-   Buat slug yang deskriptif

### 2. **SEO Optimization**

-   Masukkan kata kunci penting
-   Buat slug yang singkat tapi informatif
-   Konsisten dengan struktur URL

### 3. **Maintenance**

-   Monitor duplikasi slug
-   Backup data sebelum update besar
-   Test URL setelah perubahan

## Kesimpulan

Fitur slug otomatis berhasil ditambahkan dengan:

-   ✅ Auto-generation dari nama produk
-   ✅ Live update di Filament
-   ✅ Handle duplikasi otomatis
-   ✅ SEO-friendly URLs
-   ✅ Backward compatibility dengan data existing

Sistem sekarang lebih user-friendly dan SEO-optimized!
