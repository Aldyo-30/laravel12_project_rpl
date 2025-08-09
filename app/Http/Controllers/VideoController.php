<?php

namespace App\Http\Controllers;


use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::oldest()->paginate(6);
        return view('video', compact('videos'));
    }
}
