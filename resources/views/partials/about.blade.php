<!-- ==========================================================================
   TENTANG THK (TIGA PILAR HARMONI)
   ========================================================================== -->
<section id="tentang-thk" class="py-12 lg:py-16 px-6 lg:px-12 bg-beige-100 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="max-w-6xl mx-auto w-full">
        <!-- Header Section -->
        <div class="max-w-xl mb-8 scroll-reveal">
            <span class="text-gold-600 font-bold tracking-widest text-xs uppercase block mb-2">— Tentang THK</span>
            <h2 class="font-serif text-forest-700 text-3xl md:text-4xl lg:text-5xl font-bold mb-3">Tiga Pilar Harmoni</h2>
            <p class="text-forest-700/80 text-sm md:text-base leading-relaxed">
                Setiap pilar menuntun keseimbangan hidup masyarakat Bali — dengan Tuhan, sesama manusia, dan alam semesta.
            </p>
        </div>
        
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            <!-- Pilar 1: Parahyangan -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col justify-between border border-beige-200/50 scroll-reveal">
                <div>
                    <!-- Container Image with zoom hover effect -->
                    <div class="relative overflow-hidden h-40">
                        <img src="{{ asset('images/parahyangan.png') }}" 
                             alt="Parahyangan Bali Temple" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <!-- Badge -->
                        <span class="absolute bottom-4 left-4 px-3 py-1 bg-forest-950/80 backdrop-blur-sm text-white text-xs rounded-full font-medium">
                            Hubungan dengan Tuhan
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-forest-700 text-2xl font-bold mb-3">Parahyangan</h3>
                        <p class="text-forest-700/70 text-sm leading-relaxed mb-4">
                            Hubungan harmonis antara manusia dengan Tuhan, terwujud lewat persembahyangan, upacara, dan pura yang menyatu dengan kehidupan sehari-hari.
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button class="learn-more-btn text-gold-600 font-bold text-sm inline-flex items-center gap-1 group hover:text-gold-700 transition" data-pillar="parahyangan">
                        Pelajari Lebih Lanjut
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Pilar 2: Pawongan -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col justify-between border border-beige-200/50 scroll-reveal scroll-reveal-delay-1">
                <div>
                    <div class="relative overflow-hidden h-40">
                        <img src="{{ asset('images/pawongan.png') }}" 
                             alt="Pawongan Balinese Community" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute bottom-4 left-4 px-3 py-1 bg-forest-950/80 backdrop-blur-sm text-white text-xs rounded-full font-medium">
                            Hubungan Antar Manusia
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-forest-700 text-2xl font-bold mb-3">Pawongan</h3>
                        <p class="text-forest-700/70 text-sm leading-relaxed mb-4">
                            Hubungan harmonis antar sesama manusia — gotong royong, musyawarah banjar, dan kepedulian yang merajut kehidupan bermasyarakat.
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button class="learn-more-btn text-gold-600 font-bold text-sm inline-flex items-center gap-1 group hover:text-gold-700 transition" data-pillar="pawongan">
                        Pelajari Lebih Lanjut
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Pilar 3: Palemahan -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 flex flex-col justify-between border border-beige-200/50 scroll-reveal scroll-reveal-delay-2">
                <div>
                    <div class="relative overflow-hidden h-40">
                        <img src="{{ asset('images/palemahan.png') }}" 
                             alt="Palemahan Subak Rice Fields" 
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                        <span class="absolute bottom-4 left-4 px-3 py-1 bg-forest-950/80 backdrop-blur-sm text-white text-xs rounded-full font-medium">
                            Hubungan dengan Alam
                        </span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-serif text-forest-700 text-2xl font-bold mb-3">Palemahan</h3>
                        <p class="text-forest-700/70 text-sm leading-relaxed mb-4">
                            Hubungan harmonis manusia dengan alam — tercermin dalam sistem Subak, pelestarian hutan, dan tanggung jawab menjaga lingkungan.
                        </p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <button class="learn-more-btn text-gold-600 font-bold text-sm inline-flex items-center gap-1 group hover:text-gold-700 transition" data-pillar="palemahan">
                        Pelajari Lebih Lanjut
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
