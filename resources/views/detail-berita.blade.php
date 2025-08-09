<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="/img/Logo-fix.png" type="image/png">
    <title>Berita Desa</title>
</head>

<body class="h-full font-inter">
    <div class="min-h-full pb-12">
        <x-navbar />
        <main>
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <nav class="mb-4 slide-up">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li><a href="/" class="text-gray-500 hover:text-blue-600 transition-colors duration-200">Beranda</a></li>
                        <li class="text-gray-400">></li>
                        <li><a href="/berita" class="text-gray-500 hover:text-blue-600 transition-colors duration-200">Berita</a></li>
                        <li class="text-gray-400">></li>
                        <li class="text-blue-600 font-medium truncate max-w-[120px] sm:max-w-none inline-block" title="{{ $post->title }}">
                            {{ $post->title }}
                        </li>
                    </ol>
                </nav>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <article class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2 text-gray-900">{{ $post->title }}</h1>
                        <div class="flex items-center text-sm text-gray-500 mb-6">
                            <time datetime="{{ $post->created_at }}">
                                {{ $post->created_at->format('d F Y') }}
                            </time>
                            <span class="mx-2">|</span>
                            <div class="flex items-center bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                {{ $post->category }}
                            </div>
                        </div>
                        @if ($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-auto rounded-lg mb-6 shadow-sm">
                        @endif
                        <div class="prose max-w-none text-gray-800 leading-relaxed">
                            {!!$post->content !!}
                        </div>
                        @if ($post->konten_tambahan)
                            @foreach ($post->konten_tambahan as $item)
                            <div class="mt-8 border-t pt-6">
                                @if (!empty($item['gambar']))
                                <img
                                    src="{{ asset('storage/' . $item['gambar']) }}"
                                    alt="Konten Tambahan"
                                    class="w-full rounded-lg shadow-md mb-4">
                                @endif

                                @if (!empty($item['deskripsi']))
                                <div class="prose prose-base max-w-none text-gray-700">
                                    {!! $item['deskripsi'] !!}
                                </div>
                                @endif
                            </div>
                            @endforeach
                        @endif
                    </article>
                    <aside class="lg:col-span-1 mt-10 lg:mt-0">
                        <div class="bg-white rounded-lg shadow-md p-5">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">📰 Berita Lainnya</h2>
                            @php
                            $beritaLainnya = \App\Models\Post::where('id', '!=', $post->id)
                            ->where('category', $post->category)
                            ->inRandomOrder()
                            ->limit(5)
                            ->get();
                            if ($beritaLainnya->count() < 5) {
                                $beritaRandom=\App\Models\Post::where('id', '!=' , $post->id)
                                ->whereNotIn('id', $beritaLainnya->pluck('id'))
                                ->inRandomOrder()
                                ->limit(5 - $beritaLainnya->count())
                                ->get();
                                $beritaLainnya = $beritaLainnya->merge($beritaRandom);
                                }
                                @endphp
                                @if ($beritaLainnya->count() > 0)
                                @foreach ($beritaLainnya as $item)
                                <a href="/berita/{{ $item->slug }}" class="flex items-start gap-4 py-4 border-b last:border-b-0 hover:bg-gray-50 transition group">
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                        alt="{{ $item->title }}"
                                        class="w-20 h-20 object-cover rounded-md flex-shrink-0" />
                                    <div class="flex-1">
                                        <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-2 group-hover:text-blue-600">
                                            {{ \Illuminate\Support\Str::limit($item->title, 150) }}
                                        </h3>
                                        <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}
                                        </p>
                                        <div class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                @endif
                        </div>
                    </aside>
                </div>
            </div>
        </main>
    </div>

    <x-footer />
    
</body>

</html>