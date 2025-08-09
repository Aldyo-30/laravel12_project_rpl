<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->paginate(9);
        return view('produk', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:65536' // max 16MB
        ]);

        $gambar = $request->file('gambar');
        $path = $gambar->store('public/produk');
        $gambarPath = 'storage/produk/' . basename($path);

        // Generate slug dari nama
        $slug = Str::slug($request->nama);
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada
        while (Produk::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        Produk::create([
            'nama' => $request->nama,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi,
            'gambar_path' => $gambarPath
        ]);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Produk $produk)
    {
        return view('detail-produk', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:65536' // max 16MB
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ];

        // Update slug jika nama berubah
        if ($request->nama !== $produk->nama) {
            $slug = Str::slug($request->nama);
            $originalSlug = $slug;
            $count = 1;

            // Cek apakah slug sudah ada
            while (Produk::where('slug', $slug)->where('id', '!=', $produk->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }

            $data['slug'] = $slug;
        }

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($produk->gambar_path) {
                Storage::delete(str_replace('/storage', 'public', $produk->gambar_path));
            }

            // Upload gambar baru
            $gambar = $request->file('gambar');
            $path = $gambar->store('public/produk');
            $gambarPath = 'storage/produk/' . basename($path);

            $data['gambar_path'] = $gambarPath;
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        // Hapus gambar dari storage
        if ($produk->gambar_path) {
            Storage::delete(str_replace('/storage', 'public', $produk->gambar_path));
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
