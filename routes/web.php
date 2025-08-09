<?php

use App\Models\Post;
use App\Models\Produk;
use App\Models\Wisata;
use App\Models\Gallery;
use App\Models\Layanan;
use App\Models\Sejarah;
use App\Models\Official;
use App\Models\Penduduk;
use App\Models\WelcomeSetting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\GalleryController;

Route::get('/', function () {
    return view('beranda');
});


// home page
Route::get('/', function () {
    return view('welcome', [
        'officials' => Official::all(),
        'posts' => Post::orderBy('created_at', 'desc')->take(6)->get(),
        'welcome' => WelcomeSetting::first(),
        'sejarah' => Sejarah::first(),
        'galleries' => Gallery::latest()->take(3)->get(),
        'wisatas' => Wisata::latest()->take(3)->get(),
        'produks' => Produk::latest()->take(3)->get(),
    ]);
});

// Gallery Page
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/video', [VideoController::class, 'index'])->name('video');

// berita
Route::get('/berita', function () {
    //menghilangkan N+1 eager
    // $posts = Post::with(['author', 'category'])->latest()->get();
    return view('berita', ['title' => 'Berita Desa', 'posts' => Post::Filter(request(['search', 'category']))->latest()->paginate(12)->withQueryString()]);
});

// berita per page
Route::get('/berita/{post:slug}', function (Post $post) {
    // $post = Post::find($slug);
    return view('detail-berita', ['title' => 'Berita', 'post' => $post]);
});

// Route untuk Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::get('/produk/{produk:slug}', [ProdukController::class, 'show'])->name('produk.show');

// Route untuk Wisata
Route::get('/wisata', [WisataController::class, 'index'])->name('wisata');
Route::get('/wisata/{wisata:slug}', [WisataController::class, 'show'])->name('wisata.show');

// Route untuk Layanan
Route::get('/layanan', function () {
    $layanans = Layanan::all();
    return view('layanan', compact('layanans'));
});
// sejarah
Route::get('/sejarah', function () {
    return view('sejarah', ['sejarah' => Sejarah::first(),]);
});

Route::get('/infografis', function () {
    $penduduks = Penduduk::latest()->first();
    return view('infografis', compact('penduduks'));
});
