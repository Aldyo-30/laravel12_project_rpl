<nav x-data="{ isOpen: false }" :class="isOpen ? 'bg-gray-900' : 'bg-transparent'" class="absolute top-0 w-full z-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex h-16 items-center justify-between">
            <div class="shrink-0 flex items-center space-x-2">
                <a href="/">
                    <img src="/img/LogoDesaNgrawan-fix.png" alt="Desa Ngrawan" class="h-12 md:h-16 mr-3">
                </a>
            </div>
            <div class="hidden md:block">
                <div class="flex items-baseline space-x-4">
                    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
                    <x-nav-link href="/infografis" :active="request()->is('infografis')">Infografis</x-nav-link>
                    <x-nav-link href="/berita" :active="request()->is('berita')">Berita</x-nav-link>
                    <x-nav-link href="/gallery" :active="request()->is('gallery')">Gallery</x-nav-link>
                    <x-nav-link href="/produk" :active="request()->is('produk')">Produk</x-nav-link>
                    <x-nav-link href="/wisata" :active="request()->is('wisata')">Wisata</x-nav-link>
                    <x-nav-link href="/layanan" :active="request()->is('layanan')">Layanan</x-nav-link>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button @click="isOpen = !isOpen" type="button" class="relative inline-flex items-center justify-center rounded-md bg-white/10 backdrop-blur-sm p-2 text-sky-100 hover:bg-white/20 hover:text-white transition-all duration-200" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div x-show="isOpen" class="md:hidden px-4 pt-2 pb-3 space-y-1 bg-gray-800">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <x-nav-link href="/" :active="request()->is('/')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">Beranda</x-nav-link>
            <x-nav-link href="/infografis" :active="request()->is('infografis')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">infografis</x-nav-link>
            <x-nav-link href="/berita" :active="request()->is('berita')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">Berita</x-nav-link>
            <x-nav-link href="/gallery" :active="request()->is('gallery')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">Gallery</x-nav-link>
            <x-nav-link href="/produk" :active="request()->is('produk')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">Produk</x-nav-link>
            <x-nav-link href="/wisata" :active="request()->is('wisata')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">Wisata</x-nav-link>
            <x-nav-link href="/layanan" :active="request()->is('layanan')" class="block text-sky-100 hover:text-white px-3 py-2 rounded-md transition-all duration-300 hover:bg-white/10 hover:translate-x-2">Layanan</x-nav-link>
        </div>
    </div>
</nav>