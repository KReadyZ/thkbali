<!-- ==========================================================================
   HERO SECTION
   ========================================================================== -->
<section id="home" class="relative min-h-screen flex items-center justify-center bg-cover bg-center pt-24 pb-16 px-6 lg:px-12" 
         style="background-image: linear-gradient(rgba(4, 28, 21, 0.55), rgba(10, 61, 46, 0.75)), url('{{ asset('images/Ulun Danu Beratan.jpg') }}');">
    
    <div class="max-w-4xl w-full text-center relative z-10 flex flex-col items-center">
        <!-- Label Atas -->
        <span class="inline-block text-gold-400 font-bold tracking-widest text-xs lg:text-sm uppercase mb-4 scroll-reveal">
            — Filosofi Hidup Masyarakat Bali —
        </span>
        
        <!-- Judul Utama -->
        <h1 class="font-serif text-white text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-tight mb-6 max-w-3xl scroll-reveal scroll-reveal-delay-1">
            Discover Bali <span class="text-gold-500 italic font-normal text-shadow-glow">Through Harmony</span>
        </h1>
        
        <!-- Paragraph Penjelasan -->
        <p class="text-white/80 text-base md:text-lg lg:text-xl font-light leading-relaxed max-w-2xl mb-10 scroll-reveal scroll-reveal-delay-2">
            Tri Hita Karana mengajarkan keseimbangan antara manusia, alam, dan Tuhan — filosofi yang menjaga harmoni Bali dari generasi ke generasi.
        </p>
        
        <!-- Bar Pencarian Interaktif -->
        <div class="relative w-full max-w-xl mb-6 shadow-2xl rounded-full z-30 scroll-reveal scroll-reveal-delay-3">
            <div class="flex items-center bg-white/95 backdrop-blur-md rounded-full px-5 py-3 border border-white/20 focus-within:ring-2 focus-within:ring-gold-500/50 transition">
                <svg class="w-5 h-5 text-forest-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="hero-search-input" 
                       placeholder="Cari filosofi, kategori THK Awards, berita..." 
                       class="w-full bg-transparent border-0 outline-none text-forest-900 placeholder-forest-700/60 text-sm md:text-base"
                       autocomplete="off">
            </div>
            
            <!-- Autocomplete Dropdown suggestions list -->
            <ul id="search-suggestions" class="absolute left-0 right-0 mt-2 bg-forest-900 border border-gold-500/30 rounded-2xl shadow-2xl hidden max-h-60 overflow-y-auto text-left py-2 backdrop-blur-md z-40">
            </ul>
        </div>
        
        <!-- Quick search tags -->
        <div class="flex flex-wrap justify-center gap-2 mb-8 max-w-xl scroll-reveal scroll-reveal-delay-4">
            <button class="quick-tag px-4 py-1.5 rounded-full border border-white/20 bg-white/5 hover:bg-white/10 hover:border-gold-500 text-white/90 text-xs md:text-sm transition duration-300" data-tag="Tri Hita Karana">Tri Hita Karana</button>
            <button class="quick-tag px-4 py-1.5 rounded-full border border-white/20 bg-white/5 hover:bg-white/10 hover:border-gold-500 text-white/90 text-xs md:text-sm transition duration-300" data-tag="Parahyangan">Parahyangan</button>
            <button class="quick-tag px-4 py-1.5 rounded-full border border-white/20 bg-white/5 hover:bg-white/10 hover:border-gold-500 text-white/90 text-xs md:text-sm transition duration-300" data-tag="Pawongan">Pawongan</button>
            <button class="quick-tag px-4 py-1.5 rounded-full border border-white/20 bg-white/5 hover:bg-white/10 hover:border-gold-500 text-white/90 text-xs md:text-sm transition duration-300" data-tag="Palemahan">Palemahan</button>
            <button class="quick-tag px-4 py-1.5 rounded-full border border-white/20 bg-white/5 hover:bg-white/10 hover:border-gold-500 text-white/90 text-xs md:text-sm transition duration-300" data-tag="THK Awards">THK Awards</button>
        </div>
        
        <!-- Action Button -->
        <a href="#tentang-thk" class="scroll-reveal scroll-reveal-delay-5 inline-flex items-center gap-2 px-8 py-3.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full shadow-lg hover:shadow-gold-500/20 hover:scale-105 transition-all duration-300 group">
            Jelajahi THK
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
    
    <!-- Bottom Curve shape style decoration -->
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-forest-900 to-transparent"></div>
</section>
