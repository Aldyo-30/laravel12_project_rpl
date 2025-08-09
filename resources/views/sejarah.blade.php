<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" href="/img/Logo-fix.png" type="image/png">
  <title>Sejarah Desa</title>
</head>

<body class="h-full font-inter">
  <div class="min-h-full md:pb-24 pb-12">
    <x-navbar />
    <main class="pt-4 bg-gray-100 min-h-screen">
      <div class="max-w-7xl mx-auto px-2 md:px-4 lg:px-6">
        <div class="mb-4 slide-up">
          <a href="/" class="inline-flex items-center text-sm sm:text-base text-white bg-blue-600 hover:bg-blue-700 transition md:px-5 px-4 md:py-3 py-2 rounded-xl shadow-lg font-semibold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Beranda
          </a>
        </div>
        <article class="bg-white p-6 md:p-8 rounded-2xl shadow-md">
          <h1 class="text-2xl md:text-4xl font-extrabold mb-1 text-black text-center md:text-start">
            {{ $sejarah->judul }}
          </h1>

          @if ($sejarah && $sejarah->updated_at)
          <div class="flex items-center text-sm text-gray-500 mb-4 text-center md:text-start gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-400 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Diperbarui pada {{ \Carbon\Carbon::parse($sejarah->updated_at)->translatedFormat('d F Y') }}</span>
          </div>

          {{-- Garis bawah --}}
          <hr class="border-t border-gray-200 mb-6">
          @endif

          @php
          $sejarah = \App\Models\Sejarah::latest()->first();
          @endphp

          @if ($sejarah && $sejarah->gambar)
          <div class="w-full flex justify-center mb-6">
            <img
              src="{{ asset('storage/' . $sejarah->gambar) }}"
              alt="Gambar Sejarah"
              class="w-full rounded-lg shadow-sm object-cover h-full">
          </div>
          @endif

          <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed text-justify text-sm md:text-lg">
            @if ($sejarah)
            {!! $sejarah->isi !!}
            @else
            <p class="text-gray-500 italic text-center">Belum ada isi sejarah tersedia.</p>
            @endif
          </div>
        </article>
      </div>
    </main>
  </div>

  <x-footer />

</body>

</html>