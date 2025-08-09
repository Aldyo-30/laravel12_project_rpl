<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12); // Pagination dengan 12 item per halaman
        return view('gallery', compact('galleries'));
    }
}
