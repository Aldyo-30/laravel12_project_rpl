<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="icon" href="/img/Logo-fix.png" type="image/png">
    <title>Infografis Desa</title>
</head>

<body class="h-full font-inter">
    <div class="min-h-full pb-24">
        <x-navbar />

        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold tracking-tight text-center text-gray-800 md:text-3xl md:text-left">
                    Infografis Desa
                </h1>
                <p class="px-4 pt-1 text-sm font-light text-center text-gray-500 md:text-md md:px-0 md:text-left">
                    Statistik dan data visual Desa Ngrawan.
                </p>
            </div>
        </header>

        <main class="pt-4 pb-14">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">

                @php
                    use App\Models\Penduduk;
                    $penduduk = Penduduk::latest()->first();
                @endphp

                <h1 class="mb-4 text-2xl font-extrabold text-center text-blue-600 md:text-4xl md:text-left">
                    Jumlah Penduduk dan Kepala Keluarga
                </h1>

                @if($penduduk)
                    <div class="grid grid-cols-1 gap-6 mb-12 md:grid-cols-2">
                        <div class="flex items-center gap-4 p-3  bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=vPtMKjs4oj1H&format=png&color=000000" alt="Total Penduduk" class="w-30 h-30">
                            <div>
                                <div class="text-lg font-semibold text-gray-700">TOTAL PENDUDUK</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->total, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-3 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=114422&format=png&color=000000" alt="Kepala Keluarga" class="w-30 h-30">
                            <div>
                                <div class="text-lg font-semibold text-gray-700">KEPALA KELUARGA</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->kepala_keluarga, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=lprtkj2NOMI2&format=png&color=000000" alt="Perempuan" class="w-20 h-20">
                            <div>
                                <div class="text-lg font-semibold text-gray-700">PEREMPUAN</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->perempuan, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=Ovu07erm4dV0&format=png&color=000000" alt="Laki-laki" class="w-20 h-20">
                            <div>
                                <div class="text-lg font-semibold text-gray-700">LAKI-LAKI</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->laki_laki, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h1 class="mb-4 text-2xl font-extrabold text-center text-blue-600 md:text-4xl md:text-left">
                        Jumlah Penduduk berdasarkan Dusun
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                        <div x-data="{ open: false }" class="col-span-2 bg-white shadow-md rounded-xl overflow-hidden">
                            <button @click="open = !open"
                                class="flex items-center justify-between gap-4 p-6 w-full text-left hover:bg-gray-50 transition">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('img/countryside.png') }}" alt="Total Dusun" class="w-20 h-20">
                                    <div>
                                        <div class="text-lg font-semibold text-gray-700">Total Dusun</div>
                                        <div class="text-2xl md:text-3xl font-bold text-blue-600">
                                            {{ number_format($penduduk->desa, 0, ',', '.') }}
                                            <span class="text-lg font-normal text-gray-500">Dusun</span>
                                        </div>
                                    </div>
                                </div>
                                <svg :class="{ 'rotate-180': open }" class="w-5 h-5 text-gray-500 transition-transform duration-300"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-transition
                                class="px-6 pb-4 pt-4 text-gray-700 text-sm leading-relaxed space-y-1">

                                <div>
                                    <div class="font-semibold text-blue-700 mb-1">RW 1</div>
                                    <ul class="space-y-2 text-gray-600">
                                        <li>
                                            <span class="font-medium">Dusun Ngrawan 1:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 1</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 2</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 3</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="font-medium">Dusun Ngrawan 2:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 4</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 5</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 6</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="font-medium">Dusun Tanon:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 11</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 12</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="font-medium">Dusun Padan:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 13</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 14</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <div class="font-semibold text-blue-700 mb-1 mt-4">RW 2</div>
                                    <ul class="space-y-2 text-gray-600">
                                        <li>
                                            <span class="font-medium">Dusun Ngrawan 3:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 7</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 8</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 9</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 10</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="font-medium">Dusun Ploso:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 15</span>
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 16</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="font-medium">Dusun Tegalsari:</span>
                                            <div class="flex flex-wrap gap-2 mt-1">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs">RT 17</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="flex items-center col-span-2 md:col-span-1 gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=6vZnCn8LOl5h&format=png&color=000000" alt="Dusun Ngrawan" class="w-20 h-20">
                        <div>
                            <div class="text-lg font-semibold text-gray-700">Dusun Ngrawan</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->dusun_1, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center col-span-2 md:col-span-1 gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=6vZnCn8LOl5h&format=png&color=000000" alt="Dusun Tanon" class="w-20 h-20">
                        <div>
                            <div class="text-lg font-semibold text-gray-700">Dusun Tanon</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->dusun_2, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center col-span-2 md:col-span-1 gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=6vZnCn8LOl5h&format=png&color=000000" alt="Dusun Padan" class="w-20 h-20">
                        <div>
                            <div class="text-lg font-semibold text-gray-700">Dusun Padan</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->dusun_3, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center col-span-2 md:col-span-1 gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=6vZnCn8LOl5h&format=png&color=000000" alt="Dusun Ploso" class="w-20 h-20">
                        <div>
                            <div class="text-lg font-semibold text-gray-700">Dusun Ploso</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->dusun_4, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center col-span-2 md:col-span-1 gap-4 p-6 bg-white shadow-lg rounded-xl">
                            <img src="https://img.icons8.com/?size=100&id=6vZnCn8LOl5h&format=png&color=000000" alt="Dusun Tegalsari" class="w-20 h-20">
                        <div>
                            <div class="text-lg font-semibold text-gray-700">Dusun Tegalsari</div>
                                <div class="text-2xl md:text-3xl font-bold text-blue-500">
                                    {{ number_format($penduduk->dusun_5, 0, ',', '.') }}
                                    <span class="text-lg font-normal text-gray-500">Jiwa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mb-12 text-center text-gray-500">Belum ada data penduduk.</div>
                @endif
            </div>
        </main>
    </div>

    <x-footer />
    
</body>

</html>
