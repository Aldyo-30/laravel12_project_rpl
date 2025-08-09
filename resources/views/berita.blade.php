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
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-800 text-center md:text-left">Berita Desa</h1>
                <p class="text-sm md:text-md px-4 md:px-0 pt-1 font-light text-center md:text-left text-gray-500">
                Sajian berita terbaru dan terpercaya dari Desa Ngrawan, langsung dari sumbernya.
                </p>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="py-4 px-2 mx-auto max-w-screen-xl lg:py-2 lg:px-6 md:mb-4 mb-2">
                    <div class="mx-auto max-w-screen-md sm:text-center">
                        <form>
                            @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                                <div class="relative w-full">
                                    <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Searching</label>
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari Berita" type="search" id="search" name="search" autocomplete="off">
                                </div>
                                <div>
                                    <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-600 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="py-1 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-0">
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @forelse ( $posts as $post )
                        <article onclick="window.location.href='/berita/{{ $post->slug }}'" class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col cursor-pointer transition transform hover:shadow-lg hover:-translate-y-1">
                        <img class="w-full h-72 object-cover" 
                            src="{{ asset('storage/' . $post->thumbnail) }}" 
                            alt="{{ $post->title }}">

                            <div class="md:px-5 px-7 py-5 flex flex-col flex-grow relative pb-16">
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                                {{ $post->title }}
                                </h2>
                                <p class="text-gray-600 text-sm md:mb-6 mb-2">
                                {!! Str::limit(strip_tags($post->content), 150) !!}
                                </p>
                                <div class="absolute bottom-4 left-5 flex items-center text-xs text-gray-600 gap-4 flex-wrap">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        {{ $post->created_at->format('d F Y') }}
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-6 8a6 6 0 1112 0H4z" />
                                        </svg>
                                        Admin
                                    </div>
                                    <div class="flex items-center gap-1 bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-semibold">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                                        </svg>
                                        <span class="text-xs">{{ $post->category }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @empty
                        <div class="col-span-3 text-center py-12">
                            <div class="text-gray-500 text-lg mb-4">
                                <svg class="mx-auto h-12 w-12 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 8h14l1 12a2 2 0 01-2 2H6a2 2 0 01-2-2l1-12z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data berita</h3>
                            <p class="text-gray-500">Data berita akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @if($posts->count() > 0)
                <div class="mt-8 flex justify-between items-center mx-5">
                    <span class="text-sm font-normal text-gray-500">
                        Showing <span class="font-semibold text-gray-900">{{ $posts->firstItem() ?? 0 }}-{{ $posts->lastItem() ?? 0 }}</span>
                        of <span class="font-semibold text-gray-900">{{ $posts->total() }}</span>
                    </span>

                    <nav class="inline-flex rounded-md shadow">
                        <a href="{{ $posts->previousPageUrl() }}"
                            class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ $posts->currentPage() == 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Prev
                        </a>
                        @if($posts->lastPage() <= 5)
                            @for($i=1; $i <=$posts->lastPage(); $i++)
                            <a href="{{ $posts->url($i) }}"
                                class="px-3 py-2 border-t border-b border-gray-300 {{ $posts->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                {{ $i }}
                            </a>
                            @endfor
                            @else
                            @php
                            $start = max(2, $posts->currentPage() - 1);
                            $end = min($posts->lastPage(), $start + 2);
                            if ($posts->currentPage() >= $posts->lastPage() - 2) {
                            $start = max(1, $posts->lastPage() - 3);
                            $end = $posts->lastPage();
                            }
                            @endphp
                            <a href="{{ $posts->url(1) }}"
                                class="px-3 py-2 border-t border-b border-gray-300 {{ $posts->currentPage() == 1 ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                1
                            </a>
                            @if($posts->currentPage() >= $posts->lastPage() - 2)
                            <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                            @endif
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $posts->url($i) }}"
                                class="px-3 py-2 border-t border-b border-gray-300 {{ $posts->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                {{ $i }}
                                </a>
                                @endfor
                                @if($end < $posts->lastPage() && $posts->currentPage() < $posts->lastPage() - 2)
                                        <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                        <a href="{{ $posts->url($posts->lastPage()) }}"
                                            class="px-3 py-2 border-t border-b border-gray-300 {{ $posts->currentPage() == $posts->lastPage() ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                            {{ $posts->lastPage() }}
                                        </a>
                                        @endif
                                        @endif
                                        <a href="{{ $posts->nextPageUrl() }}"
                                            class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ !$posts->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                            Next
                                        </a>
                    </nav>
                </div>
                @endif
            </div>
        </main>
    </div>

    <x-footer />
    
</body>

</html>