<!doctype html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css','resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="/img/Logo-fix.png" type="image/png">
    <title>Layanan</title>
</head>

<body class="h-full font-inter">
    <div class="min-h-full pb-24">
        <x-navbar />

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-800 text-center md:text-left">Layanan</h1>
                <p class="text-sm md:text-md px-4 md:px-0 pt-1 font-light text-center md:text-left text-gray-500">
                    Menyediakan berbagai informasi umum yang sering ditanyakan.
                </p>
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-4">
                <div class="grid grid-cols-1 gap-6" x-data="{ openItem: null }">
                    @forelse($layanans as $layanan)
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden"
                        :class="{'bg-gradient-to-r from-blue-50 to-indigo-50 shadow-xl': openItem === {{ $layanan->id }}}">
                        <button @click="openItem = openItem === {{ $layanan->id }} ? null : {{ $layanan->id }}"
                            class="w-full p-6 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-200 group">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">{{ $layanan->judul }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Klik untuk melihat detail</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-400 transform transition-all duration-300 group-hover:text-blue-500"
                                    :class="{'rotate-180': openItem === {{ $layanan->id }}}"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="openItem === {{ $layanan->id }}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-4"
                            class="px-6 pb-6 border-t border-gray-100">
                            <div class="prose prose-sm prose-gray max-w-none text-justify">
                                <p class="">{!! $layanan->deskripsi !!}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div class="text-gray-400 mb-6">
                            <svg class="mx-auto h-24 w-24 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-3">Belum ada data layanan</h3>
                        <p class="text-gray-500 text-lg max-w-md mx-auto">Data layanan akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
                        <div class="mt-6">
                            <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Hubungi admin untuk menambahkan layanan
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <x-footer />
    
</body>