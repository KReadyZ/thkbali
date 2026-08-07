<!-- ==========================================================================
   GALERI SECTION (Bali, dalam Keseimbangan)
   ========================================================================== -->
<section id="galeri" class="py-12 lg:py-16 px-6 lg:px-12 bg-forest-950 text-white relative border-t border-forest-900 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="max-w-6xl mx-auto w-full">
        <!-- Header Section -->
        <div class="max-w-xl mb-8 scroll-reveal">
            <span class="text-gold-400 font-bold tracking-widest text-xs uppercase block mb-2">— Galeri</span>
            <h2 class="font-serif text-white text-3xl md:text-4xl lg:text-5xl font-bold mb-3">Bali, dalam Keseimbangan</h2>
        </div>
        
        <!-- Gallery Slider Wrapper -->
        <div class="relative w-full scroll-reveal">
            <!-- Left Arrow Button -->
            <button id="gallery-scroll-left" class="absolute -left-4 md:-left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-forest-900/90 border border-gold-500/30 rounded-full hidden md:flex items-center justify-center text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition duration-300 shadow-xl cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Scrollable Track -->
            <div id="gallery-track" class="overflow-x-auto scrollbar-hidden flex gap-6 px-2 py-4 scroll-smooth snap-x snap-mandatory">
                @foreach($galleries as $gal)
                    <div class="gallery-item snap-center shrink-0 w-72 sm:w-80 md:w-[400px] h-52 sm:h-60 md:h-[260px] relative group overflow-hidden rounded-3xl cursor-pointer shadow-lg border border-white/5" 
                         data-title="{{ $gal->title_id }}">
                        <img src="{{ $gal->image }}" alt="{{ $gal->title_id }}" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-forest-950/90 via-forest-950/20 to-transparent opacity-90 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <div>
                                <span class="text-gold-400 font-bold text-xs uppercase block mb-1">{{ $gal->category_id }}</span>
                                <h4 class="font-serif text-white font-bold text-base md:text-lg leading-tight">{{ $gal->title_id }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right Arrow Button -->
            <button id="gallery-scroll-right" class="absolute -right-4 md:-right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 bg-forest-900/90 border border-gold-500/30 rounded-full hidden md:flex items-center justify-center text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition duration-300 shadow-xl cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</section>
