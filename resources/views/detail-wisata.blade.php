<!doctype html>
<html lang="en" class="h-full bg-gradient-to-br from-gray-50 to-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css','resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="/img/Logo-fix.png" type="image/png">
    <style>
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @media (max-width: 430px) {
            .wisata-lainnya-scroll {
                overflow-x: auto !important;
                flex-wrap: nowrap !important;
                -webkit-overflow-scrolling: touch;
            }

        }
    </style>
</head>

<body class="h-full font-inter">
    <div class="min-h-full pb-24">
        <x-navbar />

        <main class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <nav class="mb-8">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li><a href="/" class="text-gray-500 hover:text-blue-600 transition-colors duration-200">Beranda</a></li>
                        <li class="text-gray-400">/</li>
                        <li><a href="/wisata" class="text-gray-500 hover:text-blue-600 transition-colors duration-200">Wisata</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-blue-600 font-medium">{{ $wisata->judul }}</li>
                    </ol>
                </nav>

                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        @if($wisata->gambar)
                        <div x-data="{ mainImg: '{{ asset('storage/' . $wisata->gambar) }}', fade: true }" class="relative bg-gradient-to-br from-gray-50 to-gray-100 p-8">
                            <div class="relative overflow-hidden rounded-xl shadow-lg">
                                <template x-for="img in [mainImg]" :key="img">
                                    <img :src="img" alt="{{ $wisata->judul }}"
                                        class="w-full h-64 sm:h-80 md:h-96 object-cover"
                                        x-show="fade"
                                        x-transition:leave="transition-all duration-700 ease-in-out"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-105"
                                        x-transition:enter="transition-all duration-500 ease-out"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100">
                                </template>
                            </div>

                            <div class="flex flex-wrap justify-center gap-4 mt-6">
                                <img src="{{ asset('storage/' . $wisata->gambar) }}"
                                    @click="fade=false; setTimeout(() => { mainImg = '{{ asset('storage/' . $wisata->gambar) }}'; fade=true }, 500)"
                                    class="h-20 w-20 sm:h-24 sm:w-24 object-cover rounded-lg border-2 cursor-pointer transition-all duration-300 hover:scale-110 hover:shadow-lg"
                                    :class="mainImg === '{{ asset('storage/' . $wisata->gambar) }}' ? 'border-blue-500 shadow-lg' : 'border-gray-200 hover:border-blue-300'">

                                @if($wisata->gambar1)
                                <img src="{{ asset('storage/' . $wisata->gambar1) }}"
                                    @click="fade=false; setTimeout(() => { mainImg = '{{ asset('storage/' . $wisata->gambar1) }}'; fade=true }, 500)"
                                    class="h-20 w-20 sm:h-24 sm:w-24 object-cover rounded-lg border-2 cursor-pointer transition-all duration-300 hover:scale-110 hover:shadow-lg"
                                    :class="mainImg === '{{ asset('storage/' . $wisata->gambar1) }}' ? 'border-blue-500 shadow-lg' : 'border-gray-200 hover:border-blue-300'">
                                @endif

                                @if($wisata->gambar2)
                                <img src="{{ asset('storage/' . $wisata->gambar2) }}"
                                    @click="fade=false; setTimeout(() => { mainImg = '{{ asset('storage/' . $wisata->gambar2) }}'; fade=true }, 500)"
                                    class="h-20 w-20 sm:h-24 sm:w-24 object-cover rounded-lg border-2 cursor-pointer transition-all duration-300 hover:scale-110 hover:shadow-lg"
                                    :class="mainImg === '{{ asset('storage/' . $wisata->gambar2) }}' ? 'border-blue-500 shadow-lg' : 'border-gray-200 hover:border-blue-300'">
                                @endif

                                @if($wisata->gambar3)
                                <img src="{{ asset('storage/' . $wisata->gambar3) }}"
                                    @click="fade=false; setTimeout(() => { mainImg = '{{ asset('storage/' . $wisata->gambar3) }}'; fade=true }, 500)"
                                    class="h-20 w-20 sm:h-24 sm:w-24 object-cover rounded-lg border-2 cursor-pointer transition-all duration-300 hover:scale-110 hover:shadow-lg"
                                    :class="mainImg === '{{ asset('storage/' . $wisata->gambar3) }}' ? 'border-blue-500 shadow-lg' : 'border-gray-200 hover:border-blue-300'">
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 p-8">
                            <div class="w-full h-[500px] bg-gray-200 rounded-xl shadow-lg flex items-center justify-center">
                                <span class="text-gray-500 text-lg">No Image</span>
                            </div>
                        </div>
                        @endif

                        <div class="p-8 lg:p-12 space-y-8">
                            <div class="space-y-4">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 leading-tight">{{ $wisata->judul }}</h1>

                                <hr class="border-gray-300">

                                <h2 class="text-xl md:text-2xl font-semibold text-gray-900 flex items-center">
                                    Informasi Paket
                                </h2>

                                @if($wisata->harga)
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2 text-gray-600 text-md md:text-lg">
                                        <span class="font-medium">Harga:</span>
                                    </div>
                                    <div class="text-xl font-bold text-blue-600">
                                        Rp {{ number_format($wisata->harga, 2, ',', '.') }}
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    Deskripsi Wisata
                                </h3>
                                <div class="text-gray-700 leading-relaxed space-y-2 prose prose-sm md:prose-base max-w-none">
                                    {!! $wisata->deskripsi !!}
                                </div>
                            </div>

                            @if($wisata->nama_pemilik || $wisata->telepon || $wisata->alamat)
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 space-y-4">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Informasi Pemilik
                                </h3>
                                <div class="grid grid-cols-1 gap-4">
                                    @if($wisata->nama_pemilik)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-blue-200 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Nama Pemilik</p>
                                            <p class="font-medium text-gray-900">{{ $wisata->nama_pemilik }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($wisata->telepon)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Telepon</p>
                                            <p class="font-medium text-gray-900">{{ $wisata->telepon }}</p>
                                        </div>
                                    </div>
                                    @endif

                                    @if($wisata->alamat)
                                    <div class="flex items-start space-x-3">
                                    <div class="min-w-10 min-h-10 w-10 h-10 bg-purple-200 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Alamat</p>
                                            <p class="font-medium text-gray-900">{{ $wisata->alamat }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($wisata->telepon)
                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $wisata->telepon) }}"
                                    target="_blank"
                                    class="flex-1 bg-green-600 text-white px-8 py-4 rounded-xl text-center font-semibold hover:bg-green-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                                    </svg>
                                    <span>Hubungi via WhatsApp</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @php
            $wisataLainnya = \App\Models\Wisata::where('id', '!=', $wisata->id)->inRandomOrder()->limit(5)->get();
            @endphp

            @if($wisataLainnya->count() > 0)
            <div class="mt-16 bg-blue-100 rounded-xl p-12 mx-4 items-center">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Wisata Lainnya</h2>
                    <p class="text-gray-600 text-lg">Temukan wisata menarik lainnya</p>
                </div>
                <div class="flex gap-8 justify-center flex-wrap wisata-lainnya-scroll" style="scrollbar-width: auto; scrollbar-color: #3b82f6 #e5e7eb;">
                    @foreach($wisataLainnya as $wisataLain)
                    <article onclick="window.location.href='/wisata/{{ $wisataLain->slug }}'"
                        class="w-full sm:w-[300px] bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col cursor-pointer transition transform hover:shadow-lg hover:-translate-y-1">

                        <img class="w-full object-cover h-56 md:h-72"
                            src="{{ asset('storage/' . $wisataLain->gambar) }}"
                            alt="{{ $wisataLain->judul }}">

                        <div class="px-4 md:px-6 py-4 flex flex-col flex-grow justify-between space-y-3">
                            <div>
                                <h2 class="text-lg md:text-2xl font-bold text-gray-800 mb-1">
                                    {{ $wisataLain->judul }}
                                </h2>

                                <p class="text-gray-600 text-sm">
                                    <span class="text-gray-900 font-semibold">Deskripsi:</span>
                                    {!! Str::limit(strip_tags($wisataLain->deskripsi), 100) !!}
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                <p class="text-blue-700 font-bold text-base md:text-lg">
                                    Rp{{ number_format($wisataLain->harga, 0, ',', '.') }}
                                </p>

                                <a href="/wisata/{{ $wisataLain->slug }}"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 transition">
                                    Detail
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="/wisata" class="inline-flex items-center px-8 py-4 bg-[#1b20cf] text-white font-semibold rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        Lihat Semua Wisata
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endif
        </main>
    </div>

    <x-footer />
    
</body>

</html>