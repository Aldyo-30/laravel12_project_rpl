<div class="relative z-10 flex items-center h-full shadow">
        <div class="max-w-screen-xl mx-auto px-6 md:px-10 w-full">
            <div class=" max-w-3xl">
                <h1 class="text-3xl md:text-6xl font-bold mb-4 leading-tight text-center md:text-left text-white">
                {{ $slot }}
                </h1>
                <p class="md:text-lg text-md mb-6 text-center md:text-left text-gray-300 font-thin">Tempat di mana keindahan alam dan kearifan lokal berpadu harmonis</p>
                <div class="flex justify-center md:justify-start">
                    <a href="#about" 
                    class="inline-flex items-center px-5 py-3 text-md rounded-xl shadow-lg font-semibold text-white 
                            bg-gradient-to-r from-[#0e45e9] via-[#2c5eff] to-[#2978ff] 
                            hover:from-[#0c3ecf] hover:via-[#2563eb] hover:to-[#4b5fd9] 
                            transition">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute("href")).scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
        });
    });
    </script>