<!doctype html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css','resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="/img/Logo-fix.png" type="image/png">
    <title>Produk Lokal Desa</title>
</head>
<body class="h-full font-inter">
    <div class="min-h-full pb-24">
        <x-navbar />

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-800 text-center md:text-left">Produk Lokal</h1>
                <p class="text-sm md:text-md px-4 md:px-0 pt-1 font-light text-center md:text-left text-gray-500">
                  Produk khas lokal Desa Ngrawan yang dapat dinikmati.
                </p>

            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-0">
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($produk as $pro)
                        <article onclick="window.location.href='/produk/{{ $pro->slug }}'"
                            class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col cursor-pointer transition transform hover:shadow-lg hover:-translate-y-1">

                            <img class="w-full h-56 md:h-72 object-cover"
                                src="{{ asset('storage/' . $pro->gambar_path) }}"
                                alt="{{ $pro->nama }}">

                            <div class="px-4 md:px-6 py-4 flex flex-col flex-grow justify-between space-y-3">
                                <div>
                                    <h2 class="text-lg md:text-2xl font-bold text-gray-800 mb-1">
                                        {{ $pro->nama }}
                                    </h2>

                                    <p class="text-gray-600 text-sm">
                                        <span class="text-gray-900 font-semibold">Deskripsi:</span>
                                        {!! Str::limit(strip_tags($pro->deskripsi), 100) !!}
                                    </p>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                    <p class="text-blue-700 font-bold text-base md:text-lg">
                                        Rp {{ number_format($pro->harga, 0, ',', '.') }}
                                    </p>

                                    <a href="/produk/{{ $pro->slug }}"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-800 transition">
                                        Detail
                                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7" />
                                        </svg>
                                    </a>
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
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data produk</h3>
                            <p class="text-gray-500">Data produk akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                @if($produk->count() > 0)
                <div class="mt-8 flex justify-between items-center mx-5">
                    <span class="text-sm font-normal text-gray-500">
                        Showing <span class="font-semibold text-gray-900">{{ $produk->firstItem() ?? 0 }}-{{ $produk->lastItem() ?? 0 }}</span>
                        of <span class="font-semibold text-gray-900">{{ $produk->total() }}</span>
                    </span>

                    <nav class="inline-flex rounded-md shadow">
                        <a href="{{ $produk->previousPageUrl() }}"
                            class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ $produk->currentPage() == 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
                            Previous
                        </a>

                        @if($produk->lastPage() <= 5)
                            @for($i=1; $i <=$produk->lastPage(); $i++)
                            <a href="{{ $produk->url($i) }}"
                                class="px-3 py-2 border-t border-b border-gray-300 {{ $produk->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                {{ $i }}
                            </a>
                            @endfor
                            @else
                            @php
                            $start = max(2, $produk->currentPage() - 1);
                            $end = min($produk->lastPage(), $start + 2);

                            if ($produk->currentPage() >= $produk->lastPage() - 2) {
                            $start = max(1, $produk->lastPage() - 3);
                            $end = $produk->lastPage();
                            }
                            @endphp

                            <a href="{{ $produk->url(1) }}"
                                class="px-3 py-2 border-t border-b border-gray-300 {{ $produk->currentPage() == 1 ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                1
                            </a>

                            @if($produk->currentPage() >= $produk->lastPage() - 2)
                            <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $produk->url($i) }}"
                                class="px-3 py-2 border-t border-b border-gray-300 {{ $produk->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                {{ $i }}
                                </a>
                                @endfor

                                @if($end < $produk->lastPage() && $produk->currentPage() < $produk->lastPage() - 2)
                                        <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                        <a href="{{ $produk->url($produk->lastPage()) }}"
                                            class="px-3 py-2 border-t border-b border-gray-300 {{ $produk->currentPage() == $produk->lastPage() ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                                            {{ $produk->lastPage() }}
                                        </a>
                                        @endif
                                        @endif

                                        <a href="{{ $produk->nextPageUrl() }}"
                                            class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ !$produk->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                                            Next
                                        </a>
                    </nav>
                </div>
                @endif
        </main>
    </div>

    <x-footer />
    
</body>
</html>