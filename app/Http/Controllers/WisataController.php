<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::orderBy('created_at', 'desc')->paginate(9);
        return view('wisata', compact('wisatas'));
    }

    public function show(Wisata $wisata)
    {
        return view('detail-wisata', compact('wisata'));
    }
}
