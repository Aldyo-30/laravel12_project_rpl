<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="icon" href="/img/Logo-fix.png" type="image/png">
  <title>Beranda</title>
</head>
<body class="h-full font-inter">

  <div class="min-h-full pb-12">

    <x-navbar-beranda></x-navbar-beranda>

    <section class="relative bg-cover bg-center h-screen" style="background-image: url('/img/landing.jpg');">

      <div class="absolute inset-0 bg-black/60"></div>
      <x-header class="shadow">
        Selamat datang di <br>
        Desa Wisata Ngrawan
      </x-header>

    </section>

    <section id="about" class="md:py-16 py-10 bg-white">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:grid md:grid-cols-2 gap-5 md:gap-10 items-center">

        <div class="flex justify-center md:justify-end order-1 md:order-2 opacity-0 transition-all duration-[2000ms] ease-out" data-fade="up">
          @if(!empty($welcome->image))
          <img
            src="{{ asset('storage/' . $welcome->image) }}"
            alt="Desa Ngrawan"
            class="rounded-lg shadow-xl w-full max-w-sm md:max-w-lg object-cover">
          @else
          <div class="flex flex-col items-center justify-center w-full max-w-md py-8">
            <svg class="mx-auto h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>
            <span class="text-gray-500 mt-4">Belum ada gambar</span>
          </div>
          @endif
        </div>

        <div class="order-2 md:order-1 opacity-0 transition-all duration-[2000ms] ease-out" data-fade="up">
          <h2 class="text-lg md:text-2xl font-thin text-gray-800 mb-0 md:mb-1 text-center md:text-left">Welcome to</h2>
          <h1 class="mb-4 text-3xl md:text-5xl font-extrabold tracking-tight leading-snug text-center md:text-left text-blue-700">
            @if(!empty($welcome->title))
            {{ $welcome->title }}
            @else
            <span class="text-gray-400 italic">Judul belum tersedia</span>
            @endif
          </h1>

          <div class="text-base text-justify text-gray-600">
            @if(!empty($welcome->description))
            {!! $welcome->description !!}
            @else
            <span class="text-gray-400 italic">Deskripsi belum tersedia</span>
            @endif
          </div>
        </div>

      </div>

    </section>



    <section class="relative z-10 md:py-16 py-4 bg-gradient-to-br from-[#cde9ff] via-[#e0e7ff] to-[#c7e1fe] shadow-lg">

      <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 flex lg:flex-row flex-col gap-6 items-start">

        <div data-fade="up" class="lg:w-1/2 w-full max-w-md lg:max-w-none mx-auto lg:mx-0 self-start text-center opacity-0 transition-all duration-1000 ease-out">
          @if($sejarah && $sejarah->gambar)
          <img
            src="{{ asset('storage/' . $sejarah->gambar) }}"
            alt="Sejarah Desa Ngrawan"
            class="rounded-lg shadow-xl w-full max-w-lg">
          @else
          <span class="text-gray-500 mt-4 ">Belum ada gambar</span>
          @endif
        </div>

        <div data-fade="up" class="lg:w-1/2 w-full self-start opacity-0 transition-all duration-1000 ease-out">
          <h2 class="text-3xl md:text-4xl font-bold text-blue-600 text-center lg:text-left">
            @if(!empty($sejarah->judul))
            {{ $sejarah->judul }}
            @else
            <span class="text-gray-400 italic">Judul belum tersedia</span>
            @endif
          </h2>

          <p class="text-gray-800 text-justify leading-relaxed mb-6 mt-4 text-md lg:hidden">
            @if($sejarah && $sejarah->isi)
            {!! \Illuminate\Support\Str::limit(strip_tags($sejarah->isi), 300) !!}
            @else
            Belum ada informasi sejarah tersedia.
            @endif
          </p>

          <p class="text-gray-800 text-justify leading-relaxed mb-6 mt-4 text-base hidden lg:block lg:mx-0 mx-5">
            @if($sejarah && $sejarah->isi)
            {!! \Illuminate\Support\Str::limit(strip_tags($sejarah->isi), 525) !!}
            @else
            Belum ada informasi sejarah tersedia.
            @endif
          </p>

          <div class="mb-4 slide-up flex justify-center lg:justify-start">
            <a href="/sejarah" class="inline-flex items-center text-sm sm:text-base text-white bg-gradient-to-r from-[#0e45e9] via-[#2c5eff] to-[#2978ff]  
                    hover:from-[#0c3ecf] hover:via-[#2563eb] hover:to-[#4b5fd9] 
                    transition px-5 py-3 rounded-xl shadow-lg font-semibold">
                  Pelajari Lebih Lanjut
                  <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                  </svg>
              </a>
          </div>
        </div>
        
      </div>

    </section>


    <section class="md:py-12 py-4 bg-white">

      <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 ">
        <h2 data-fade="in" class="text-2xl md:text-4xl font-extrabold mb-8 text-center text-blue-600 opacity-0 transition-all duration-1000">
          STRUKTUR ORGANISASI PEMERINTAHAN DESA
        </h2>
        <div class="overflow-x-auto overflow-y-hidden pb-4">
          <div class="flex gap-4 sm:gap-6 justify-start md:justify-center w-max mx-auto ">
            @foreach ($officials as $official)
            <div data-fade="up"
              class="flex flex-col rounded-lg overflow-hidden text-center 
                w-[200px] sm:w-[220px] md:w-[250px] min-w-[200px] sm:min-w-[220px] md:min-w-[250px] 
                shadow-lg transition-all duration-1000 opacity-0 translate-y-12 bg-white">

              <img src="{{ asset('storage/' . $official->photo) }}"
                alt="{{ $official->name }}"
                class="w-full h-40 sm:h-64 md:h-72 object-cover">

              <div class="flex flex-col flex-1">
                <div class="flex-1"></div>

                <div class="bg-gradient-to-r from-[#2563eb] via-[#3b82f6] to-[#4096ff] p-3 sm:p-4 flex flex-col justify-center h-full">
                  <h3 class="text-white text-sm sm:text-base md:text-lg font-bold leading-snug">
                    {{ $official->name }}
                  </h3>
                  <p class="text-white text-xs sm:text-sm md:text-sm font-semibold leading-snug">
                    {{ strtoupper($official->position) }}
                  </p>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

    </section>


    <section class="md:py-8 py-8 bg-[#f9f9f9]">

      <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8 opacity-0 transition-all duration-1000" data-fade="in">
        <h1 class="font-extrabold text-blue-600 mb-2 text-3xl md:text-4xl text-center md:text-left">PETA DESA</h1>
        <p class="text-md md:text-lg text-gray-600 mb-6 font-light text-center md:text-left">
          Menampilkan Peta Desa Ngrawan Melalui Google Maps
        </p>
        <div class="w-full h-[300px] sm:h-[400px] md:h-[500px] aspect-video md:aspect-video rounded-lg overflow-hidden shadow-lg">
          <iframe
            class="w-full h-full"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7913.741459020036!2d110.42046209348037!3d-7.368383470563388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a7eb34f184e0d%3A0xf95f1554da3eeeac!2sNgrawan%2C%20Kec.%20Getasan%2C%20Kabupaten%20Semarang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1751114971124!5m2!1sid!2sid"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>

    </section>


    <section id="berita-terbaru" class="md:py-12 pt-8 pb-8 px-4 sm:px-6 md:px-12 lg:px-20 bg-white">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl text-center md:text-left font-bold text-blue-600 mb-2">BERITA DESA</h1>
        <p class="text-md md:text-lg text-gray-600 mb-6 font-light text-center md:text-left">Menyajikan informasi terkini dan artikel-artikel jurnalistik dari Desa Ngrawan</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($posts->take(3) as $post)
          <article onclick="window.location.href='/berita/{{ $post->slug }}'" class="bg-white mx-auto rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col cursor-pointer transition transform hover:shadow-lg hover:-translate-y-1 w-full max-w-full">
            <img class="w-full h-48 sm:h-64 md:h-72 object-cover"
              src="{{ asset('storage/' . $post->thumbnail) }}"
              alt="{{ $post->title }}">

            <div class="px-4 sm:px-5 py-5 flex flex-col flex-grow relative pb-16">
              <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                {{ $post->title }}
              </h2>
              <p class="text-gray-600 text-sm md:mb-2 mb-2">
                {!! Str::limit(strip_tags($post->content), 150) !!}
              </p>
              <div class="absolute bottom-4 left-4 sm:left-5 flex items-center text-xs text-gray-600 gap-4 flex-wrap">
                <div class="flex items-center gap-1">
                  <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  {{ $post->created_at->translatedFormat('d F Y') }}
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
          @endforeach
        </div>
      </div>
      <div class="pt-10 flex justify-center">
        <a href="/berita" class="inline-flex items-center text-sm sm:text-base text-white bg-gradient-to-r from-[#0e45e9] via-[#2c5eff] to-[#2978ff]  
                    hover:from-[#0c3ecf] hover:via-[#2563eb] hover:to-[#4b5fd9] 
                    transition px-5 py-3 rounded-xl shadow-lg font-semibold">Lihat Berita Lainnya</a>
      </div>

    </section>


    <section class="bg-[#f9f9f9] md:py-12 py-8 px-4 sm:px-6 md:px-12">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl text-center md:text-left font-bold text-blue-600 mb-2">PRODUK LOKAL</h1>
        <p class="text-md md:text-lg text-gray-600 mb-6 font-light text-center md:text-left">Produk khas lokal Desa Ngrawan yang dapat dinikmati</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @forelse($produks->take(3) as $pro)
          <article onclick="window.location.href='/produk/{{ $pro->slug }}'"
            class="bg-white mx-auto rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col cursor-pointer transition transform hover:shadow-lg hover:-translate-y-1 w-full max-w-full">

            <img class="w-full h-48 sm:h-64 md:h-72 object-cover"
              src="{{ asset('storage/' . $pro->gambar_path) }}"
              alt="{{ $pro->nama }}">

            <div class="px-4 sm:px-5 py-5 flex flex-col flex-grow space-y-4">
              <div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                  {{ $pro->nama }}
                </h2>
                <p class="text-gray-600 text-sm">
                  <span class="text-gray-900 font-semibold">Deskripsi:</span>
                  {!! Str::limit(strip_tags($pro->deskripsi), 100) !!}
                </p>
              </div>

              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <p class="text-blue-700 font-bold text-base md:text-lg">
                  Rp {{ number_format($pro->harga, 0, ',', '.') }}
                </p>

                <a href="/produk/{{ $pro->slug }}"
                  class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-800 transition whitespace-nowrap text-center">
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
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 11V7a4 4 0 00-8 0v4M5 8h14l1 12a2 2 0 01-2 2H6a2 2 0 01-2-2l1-12z" />
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data produk</h3>
            <p class="text-gray-500">Data produk akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
          </div>
          @endforelse
        </div>

        <div class="mt-10 flex justify-center">
          <a href="/produk" class="inline-flex items-center text-sm sm:text-base text-white bg-gradient-to-r from-[#0e45e9] via-[#2c5eff] to-[#2978ff]  
                    hover:from-[#0c3ecf] hover:via-[#2563eb] hover:to-[#4b5fd9] 
                    transition px-5 py-3 rounded-xl shadow-lg font-semibold">Lihat Produk Lainnya</a>
        </div>
      </div>

    </section>


    <section class="bg-white md:py-12 py-8 px-4 sm:px-6 md:px-12">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl text-center md:text-left font-bold text-blue-600 mb-2">PAKET WISATA</h1>
        <p class="text-md md:text-lg text-gray-600 mb-6 font-light text-center md:text-left">Desa kami menyediakan paket wisata yang dijamin memberikan pengalaman yang tidak terlupakan</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          @foreach($wisatas->take(3) as $wisata)
          <article onclick="window.location.href='/wisata/{{ $wisata->slug }}'"
            class="bg-white mx-auto rounded-xl shadow-lg overflow-hidden border border-gray-200 flex flex-col cursor-pointer transition transform hover:shadow-lg hover:-translate-y-1 w-full max-w-full">

            <img class="w-full h-48 sm:h-64 md:h-72 object-cover"
              src="{{ asset('storage/' . $wisata->gambar) }}"
              alt="{{ $wisata->judul }}">

            <div class="px-4 sm:px-5 py-5 flex flex-col flex-grow space-y-4">
              <div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                  {{ $wisata->judul }}
                </h2>
                <p class="text-gray-600 text-sm">
                  <span class="text-gray-900 font-semibold">Deskripsi:</span>
                  {!! Str::limit(strip_tags($wisata->deskripsi), 100) !!}
                </p>
              </div>

              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <p class="text-blue-700 font-bold text-base md:text-lg">
                  Rp {{ number_format($wisata->harga, 0, ',', '.') }}
                </p>

                <a href="/wisata/{{ $wisata->slug }}"
                  class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-800 transition whitespace-nowrap text-center">
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
      </div>
      <div class="mt-10 flex justify-center">
        <a href="/wisata" class="inline-flex items-center text-sm sm:text-base text-white bg-gradient-to-r from-[#0e45e9] via-[#2c5eff] to-[#2978ff]  
                    hover:from-[#0c3ecf] hover:via-[#2563eb] hover:to-[#4b5fd9] 
                    transition px-5 py-3 rounded-xl shadow-lg font-semibold">Lihat Paket Lainnya</a>
      </div>

    </section>


    <section class="px-4 md:py-12 py-8 sm:px-6 md:px-8 lg:px-16 bg-[#f9f9f9]">

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl text-center md:text-left font-bold text-blue-600 mb-2">GALERI DESA</h1>
        <p class="text-md md:text-lg text-gray-600 mb-6 font-light text-center md:text-left">Menampilkan dokumentasi kegiatan di Desa Ngrawan</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-10">
          @forelse($galleries->take(3) as $gallery)
          <div class="relative overflow-hidden rounded-lg shadow-md group">
            <img
              src="{{ asset('storage/' . $gallery->gambar) }}"
              alt="{{ $gallery->judul }}"
              class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">

            <!-- Overlay Gelap -->
            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <p class="text-white p-4 text-sm md:text-base">{{ $gallery->judul }}</p>
            </div>
          </div>
          @empty
          <div class="col-span-3 text-center py-12">
            <div class="text-gray-500 text-lg mb-4">
              <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data Foto</h3>
            <p class="text-gray-500">Data galeri akan ditampilkan di sini setelah ditambahkan melalui admin panel.</p>
          </div>
          @endforelse
        </div>

        <!-- Tombol Lihat Lainnya -->
        <div class="flex justify-center">
          <a href="/gallery" class="inline-flex items-center text-sm sm:text-base text-white bg-gradient-to-r from-[#0e45e9] via-[#2c5eff] to-[#2978ff]  
                    hover:from-[#0c3ecf] hover:via-[#2563eb] hover:to-[#4b5fd9] 
                    transition px-5 py-3 rounded-xl shadow-lg font-semibold">
            Lihat Galeri Lainnya
          </a>
        </div>
      </div>
      
    </section>
  </div>

  <x-footer />

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const fadeElements = document.querySelectorAll("[data-fade]");

      // Tambahkan class awal sebelum observer aktif
      fadeElements.forEach(el => {
        const direction = el.getAttribute("data-fade");

        el.classList.add("opacity-0", "transition-all", "duration-1000");

        switch (direction) {
          case "left":
            el.classList.add("-translate-x-12");
            break;
          case "right":
            el.classList.add("translate-x-12");
            break;
          case "up":
            el.classList.add("translate-y-12");
            break;
          case "down":
            el.classList.add("-translate-y-12");
            break;
          case "in":
          default:
            el.classList.add("translate-y-4");
            break;
        }
      });

      // Observer animasi
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const el = entry.target;
            const direction = el.getAttribute("data-fade");

            el.classList.remove("opacity-0");

            switch (direction) {
              case "left":
                el.classList.remove("-translate-x-12");
                break;
              case "right":
                el.classList.remove("translate-x-12");
                break;
              case "up":
                el.classList.remove("translate-y-12");
                break;
              case "down":
                el.classList.remove("-translate-y-12");
                break;
              case "in":
              default:
                el.classList.remove("translate-y-4");
                break;
            }

            el.classList.add("opacity-100", "translate-x-0", "translate-y-0");
            observer.unobserve(el); // animasi sekali saja
          }
        });
      }, { threshold: 0.1 });

      fadeElements.forEach(el => observer.observe(el));
    });
  </script>

</body>
</html>