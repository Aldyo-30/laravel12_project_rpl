<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" href="/img/Logo-fix.png" type="image/png">
  <title>Galeri Desa</title>
</head>
<body class="h-full font-inter">
  <div class="min-h-full pb-24">
    <x-navbar />
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 pt-6 pb-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
          <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-800 text-center md:text-left">Galeri Video</h1>
          <p class="text-sm md:text-md px-4 md:px-0 pt-1 font-light text-center md:text-left text-gray-500">
            Lihatlah beberapa foto dokumentasi yang diambil di Desa Ngrawan kami.
          </p>
        </div>

        <div class="flex justify-center md:justify-end">
          <div class="flex space-x-2">
            <a href="{{ route('gallery') }}"
              class="bg-blue-100 text-blue-700 font-semibold px-4 py-2 rounded-lg shadow-sm transition duration-300 ease-in-out 
                    hover:bg-blue-200 hover:text-blue-800 hover:shadow-md">
              Foto
            </a>

            <a href="{{ route('video') }}"
              class="bg-gradient-to-r from-[#2563eb] via-[#3b82f6] to-[#60a5fa] text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300 ease-in-out 
                    hover:from-[#1d4ed8] hover:via-[#2563eb] hover:to-[#3b82f6] hover:shadow-lg">
              Video
            </a>
          </div>
        </div>
      </div>
    </header>

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-0">
          <div class="grid gap-8 grid-cols-1">
            @forelse($videos as $video)
            @php
            preg_match('/(?:v=|be\/)([a-zA-Z0-9_-]+)/', $video->link_youtube, $match);
            $youtubeId = $match[1] ?? null;
            @endphp
            <article class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col md:flex-row">
              <div class="w-full md:w-1/2 max-w-md aspect-video overflow-hidden rounded-md shadow-sm mx-auto md:mx-0">
                @if($youtubeId)
                <iframe class="w-full h-full"
                  src="https://www.youtube.com/embed/{{ $youtubeId }}"
                  title="YouTube video player"
                  frameborder="0"
                  allowfullscreen></iframe>
                @else
                <p>Invalid Link</p>
                @endif
              </div>
              <a href="{{ $video->link_youtube }}" target="_blank" class="block text-left space-y-2">
              <div class="px-4 md:px-6 py-4 flex flex-col flex-grow justify-between space-y-3">
                <div>
                  <h2 class="text-lg md:text-2xl font-bold text-gray-800 mb-1">
                    {{ $video->judul }}
                  </h2>
                  <p class="text-gray-600 text-sm">
                    {!! Str::limit($video->deskripsi, 200) !!}
                  </p>
                </div>
                </a>
                <div class="flex flex-wrap items-center text-xs md:text-sm text-gray-500 space-x-2 mt-2">
                  <span class="whitespace-nowrap">YouTube</span>
                  <span>•</span>
                  <time class="whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($video->tanggal)->translatedFormat('d F Y') }}
                  </time>
                </div>
              </div>
            </article>
            @empty
            <!-- Empty State -->
            <div class="col-span-2 text-center py-12">
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
              <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data video</h3>
              <p class="text-gray-500">Data video akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
            </div>
            @endforelse
          </div>
        </div>
        @if($videos->count() > 0)
        <div class="mt-8 flex justify-between items-center mx-5">
          <span class="text-sm font-normal text-gray-500">
            Showing <span class="font-semibold text-gray-900">{{ $videos->firstItem() ?? 0 }}-{{ $videos->lastItem() ?? 0 }}</span>
            of <span class="font-semibold text-gray-900">{{ $videos->total() }}</span>
          </span>

          <nav class="inline-flex rounded-md shadow">
            <a href="{{ $videos->previousPageUrl() }}"
              class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ $videos->currentPage() == 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
              Previous
            </a>

            @if($videos->lastPage() <= 5)
              @for($i=1; $i <=$videos->lastPage(); $i++)
              <a href="{{ $videos->url($i) }}"
                class="px-3 py-2 border-t border-b border-gray-300 {{ $videos->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                {{ $i }}
              </a>
              @endfor
              @else
              @php
              $start = max(2, $videos->currentPage() - 1);
              $end = min($videos->lastPage(), $start + 2);

              if ($videos->currentPage() >= $videos->lastPage() - 2) {
              $start = max(1, $videos->lastPage() - 3);
              $end = $videos->lastPage();
              }
              @endphp

              <a href="{{ $videos->url(1) }}"
                class="px-3 py-2 border-t border-b border-gray-300 {{ $videos->currentPage() == 1 ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                1
              </a>

              @if($videos->currentPage() >= $videos->lastPage() - 2)
              <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
              @endif

              @for($i = $start; $i <= $end; $i++)
                <a href="{{ $videos->url($i) }}"
                class="px-3 py-2 border-t border-b border-gray-300 {{ $videos->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                {{ $i }}
                </a>
                @endfor

                @if($end < $videos->lastPage() && $videos->currentPage() < $videos->lastPage() - 2)
                    <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                    <a href="{{ $videos->url($videos->lastPage()) }}"
                      class="px-3 py-2 border-t border-b border-gray-300 {{ $videos->currentPage() == $videos->lastPage() ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                      {{ $videos->lastPage() }}
                    </a>
                    @endif
                    @endif

                    <a href="{{ $videos->nextPageUrl() }}"
                      class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ !$videos->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
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