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
          <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-800 text-center md:text-left">Galeri Foto</h1>
                <p class="text-sm md:text-md px-4 md:px-0 pt-1 font-light text-center md:text-left text-gray-500">
                Menampilkan dokumentasi kegiatan di Desa Ngrawan.
                </p>
        </div>

        <div class="flex justify-center md:justify-end">
          <div class="flex space-x-2">
            <a href="{{ route('gallery') }}"
              class="bg-gradient-to-r from-[#2563eb] via-[#3b82f6] to-[#60a5fa] text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-300 ease-in-out 
                    hover:from-[#1d4ed8] hover:via-[#2563eb] hover:to-[#3b82f6] hover:shadow-lg">
              Foto
            </a>

            <a href="{{ route('video') }}"
              class="bg-blue-100 text-blue-700 font-semibold px-4 py-2 rounded-lg shadow-sm transition duration-300 ease-in-out 
                    hover:bg-blue-200 hover:text-blue-800 hover:shadow-md">
              Video
            </a>
          </div>
        </div>
      </div>
    </header>

    <main>
      <div class="max-w-7xl mx-auto px-4 py-6 pt-12 sm:px-6 lg:px-8">
        <section class="space-y-6">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-10">
            @forelse($galleries as $gallery)
            <div 
              class="relative overflow-hidden rounded-lg shadow-md group cursor-pointer"
              onclick="openImageModal('{{ asset('storage/' . $gallery->gambar) }}')">
              
              <img
                src="{{ asset('storage/' . $gallery->gambar) }}"
                alt="{{ $gallery->judul }}"
                class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">

              <!-- Overlay teks -->
              <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <p class="text-white p-4 text-sm md:text-base">{{ $gallery->judul }}</p>
              </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-12">
              <div class="text-gray-500 text-lg mb-4">
                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>
              </div>
              <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Foto</h3>
              <p class="text-gray-500">Data galeri akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
            </div>
            @endforelse
          </div>
        </section>
        <div id="fullscreenModal" class="fixed inset-0 bg-black bg-opacity-80 hidden justify-center items-center z-50">
          <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-3xl font-bold z-50">×</button>
          <img id="fullscreenImage" src="" alt="Preview" class="max-w-full max-h-full object-contain px-4">
          <button onclick="changeImage(-1)" class="absolute left-4 text-white text-3xl z-50">‹</button>
          <button onclick="changeImage(1)" class="absolute right-4 text-white text-3xl z-50">›</button>
        </div>


        @if($galleries->count() > 0)
        <div class="mt-8 flex justify-between items-center mx-5">
          <span class="text-sm font-normal text-gray-500">
            Showing <span class="font-semibold text-gray-900">{{ $galleries->firstItem() ?? 0 }}-{{ $galleries->lastItem() ?? 0 }}</span>
            of <span class="font-semibold text-gray-900">{{ $galleries->total() }}</span>
          </span>

          <nav class="inline-flex rounded-md shadow">
            <a href="{{ $galleries->previousPageUrl() }}"
              class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ $galleries->currentPage() == 1 ? 'opacity-50 cursor-not-allowed' : '' }}">
              Previous
            </a>

            @if($galleries->lastPage() <= 5)
              @for($i=1; $i <=$galleries->lastPage(); $i++)
              <a href="{{ $galleries->url($i) }}"
                class="px-3 py-2 border-t border-b border-gray-300 {{ $galleries->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                {{ $i }}
              </a>
              @endfor
              @else
              @php
              $start = max(2, $galleries->currentPage() - 1);
              $end = min($galleries->lastPage(), $start + 2);

              if ($galleries->currentPage() >= $galleries->lastPage() - 2) {
              $start = max(1, $galleries->lastPage() - 3);
              $end = $galleries->lastPage();
              }
              @endphp

              <a href="{{ $galleries->url(1) }}"
                class="px-3 py-2 border-t border-b border-gray-300 {{ $galleries->currentPage() == 1 ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                1
              </a>

              @if($galleries->currentPage() >= $galleries->lastPage() - 2)
              <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
              @endif

              @for($i = $start; $i <= $end; $i++)
                <a href="{{ $galleries->url($i) }}"
                class="px-3 py-2 border-t border-b border-gray-300 {{ $galleries->currentPage() == $i ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                {{ $i }}
                </a>
                @endfor

                @if($end < $galleries->lastPage() && $galleries->currentPage() < $galleries->lastPage() - 2)
                    <span class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                    <a href="{{ $galleries->url($galleries->lastPage()) }}"
                      class="px-3 py-2 border-t border-b border-gray-300 {{ $galleries->currentPage() == $galleries->lastPage() ? 'bg-blue-500 text-white' : 'bg-white text-gray-700' }} text-sm font-medium hover:bg-sky-400 hover:text-white transition-colors duration-200">
                      {{ $galleries->lastPage() }}
                    </a>
                    @endif
                    @endif

                    <a href="{{ $galleries->nextPageUrl() }}"
                      class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-sky-400 hover:text-white transition-colors duration-200 {{ !$galleries->hasMorePages() ? 'opacity-50 cursor-not-allowed' : '' }}">
                      Next
                    </a>
          </nav>
        </div>
        @endif

        <div id="fullscreenModal"
          class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm transition duration-300">
          <button onclick="closeImageModal()"
            class="absolute top-5 right-6 text-white text-4xl font-bold hover:scale-110 transition z-50">
            &times;
          </button>

          <button onclick="changeImage(-1)"
            class="absolute left-4 text-white text-4xl font-bold z-50 hover:scale-125 transition">
            &#10094;
          </button>
          <button onclick="changeImage(1)"
            class="absolute right-4 text-white text-4xl font-bold z-50 hover:scale-125 transition">
            &#10095;
          </button>

          <img id="fullscreenImage"
            src=""
            alt="Preview"
            class="w-auto max-w-4xl max-h-[90vh] rounded shadow-xl transition duration-300" />
        </div>

        <script>
          const galleryImages = @json($galleries->pluck('gambar')->values());
          let currentIndex = 0;

          function openImageModal(fullSrc) {
            const modal = document.getElementById('fullscreenModal');
            const image = document.getElementById('fullscreenImage');

            const fullPath = fullSrc.replace(/^.*storage\//, ''); // ambil path relatif saja
            currentIndex = galleryImages.findIndex(img => img === fullPath);
            if (currentIndex === -1) currentIndex = 0;

            image.src = "/storage/" + galleryImages[currentIndex];
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

          function closeImageModal() {
            const modal = document.getElementById('fullscreenModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.getElementById('fullscreenImage').src = '';
          }

          function changeImage(direction) {
            currentIndex += direction;
            if (currentIndex < 0) currentIndex = galleryImages.length - 1;
            if (currentIndex >= galleryImages.length) currentIndex = 0;

            const image = document.getElementById('fullscreenImage');
            image.src = "/storage/" + galleryImages[currentIndex];
          }

          // Klik di luar gambar menutup modal
          document.addEventListener('click', function (e) {
            const modal = document.getElementById('fullscreenModal');
            const image = document.getElementById('fullscreenImage');
            if (
              modal.classList.contains('flex') &&
              !image.contains(e.target) &&
              !e.target.closest('.cursor-pointer') &&
              !e.target.closest('button')
            ) {
              closeImageModal();
            }
          });
        </script>

      </div>
    </main>
  </div>

  <x-footer />
  
</body>

</html>