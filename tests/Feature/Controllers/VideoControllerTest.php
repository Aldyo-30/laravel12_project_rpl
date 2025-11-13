<?php

use App\Models\Video;

test('dapat menampilkan halaman index video', function () {
    Video::create([
        'judul' => 'Video 1',
        'deskripsi' => 'Deskripsi video 1',
        'link_youtube' => 'https://youtube.com/watch?v=test1',
        'tanggal' => now(),
    ]);

    Video::create([
        'judul' => 'Video 2',
        'deskripsi' => 'Deskripsi video 2',
        'link_youtube' => 'https://youtube.com/watch?v=test2',
        'tanggal' => now(),
    ]);

    $response = $this->get(route('video'));

    $response->assertStatus(200)
        ->assertViewIs('video')
        ->assertViewHas('videos');
});

test('video diurutkan berdasarkan created_at ascending (oldest)', function () {
    $video1 = Video::create([
        'judul' => 'Video Pertama',
        'deskripsi' => 'Deskripsi',
        'link_youtube' => 'https://youtube.com/watch?v=test1',
        'tanggal' => now(),
        'created_at' => now()->subDay(),
    ]);

    $video2 = Video::create([
        'judul' => 'Video Kedua',
        'deskripsi' => 'Deskripsi',
        'link_youtube' => 'https://youtube.com/watch?v=test2',
        'tanggal' => now(),
        'created_at' => now(),
    ]);

    $response = $this->get(route('video'));

    $videos = $response->viewData('videos');

    expect($videos->first()->id)->toBe($video1->id);
});
