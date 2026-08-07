<!-- ==========================================================================
   THK AWARDS SECTION
   ========================================================================== -->
<section id="thk-awards" class="py-12 lg:py-16 px-6 lg:px-12 bg-forest-700 text-white relative min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="max-w-6xl mx-auto w-full">
        <!-- Header Section -->
        <div class="mb-6 scroll-reveal">
            <span class="text-gold-400 font-bold tracking-widest text-xs uppercase block mb-2">— Sorotan</span>
            <h2 class="font-serif text-4xl lg:text-5xl font-bold">THK Awards</h2>
        </div>
        
        <!-- Horizontal Slide Bar for Category Tabs -->
        <div class="relative w-full mb-8 scroll-reveal">
            <!-- Left Navigation Button -->
            <button id="award-scroll-left" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-forest-900/80 border border-gold-500/30 rounded-full flex items-center justify-center text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition duration-300 shadow-lg cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Scroll Container -->
            <div id="award-tabs-container" class="overflow-x-auto scrollbar-hidden flex gap-4 px-12 py-2 scroll-smooth">
                @foreach($awardCategories as $index => $cat)
                    <button class="award-tab flex items-center gap-3 px-5 py-3 rounded-2xl border transition duration-300 shrink-0 select-none cursor-pointer {{ $index === 0 ? 'border-gold-500 bg-forest-800/80' : 'border-transparent bg-forest-800/30 hover:bg-forest-800/50' }}" 
                            data-tab="{{ $cat->key }}">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shrink-0 border border-white/10">
                            <img src="{{ $cat->image }}" alt="{{ $cat->name_id }} Thumbnail" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <span class="font-serif font-bold text-xs md:text-sm block tracking-wide text-white">{{ $cat->name_id }}</span>
                        </div>
                    </button>
                @endforeach
            </div>

            <!-- Right Navigation Button -->
            <button id="award-scroll-right" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-forest-900/80 border border-gold-500/30 rounded-full flex items-center justify-center text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition duration-300 shadow-lg cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        
        <!-- Main Showcase Card -->
        <div class="max-w-4xl mx-auto w-full mb-8 scroll-reveal scroll-reveal-delay-1">
            @php
                $firstCat = $awardCategories->first();
            @endphp
            @if($firstCat)
                <div id="award-showcase-card" class="bg-forest-800/60 rounded-3xl overflow-hidden border border-white/10 shadow-xl flex flex-col md:flex-row md:h-[350px] transition-all duration-300 ease-out opacity-100 transform translate-y-0">
                    <!-- Left Side Image -->
                    <div class="relative h-64 md:h-full md:w-1/2 shrink-0">
                        <img id="award-showcase-image" 
                             src="{{ $firstCat->image }}" 
                             alt="{{ $firstCat->name_id }}" 
                             class="w-full h-full object-cover">
                        <!-- Location Badge -->
                        <div class="absolute bottom-4 left-4 px-3 py-1.5 bg-black/60 backdrop-blur-md text-white/90 text-xs rounded-full flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Bali, Indonesia</span>
                        </div>
                    </div>
                    
                    <!-- Right Side Details -->
                    <div class="p-6 md:py-6 md:px-8 flex flex-col justify-between flex-1 md:h-full overflow-hidden">
                        <div>
                            <!-- Tags / Badges -->
                            <div id="award-showcase-badges" class="flex flex-wrap gap-2 mb-3">
                                @foreach($firstCat->badges_id as $badge)
                                    <span class="px-3 py-1 text-xs border border-white/20 rounded-full text-white/80 tracking-wider uppercase bg-white/5">{{ $badge }}</span>
                                @endforeach
                            </div>
                            
                            <!-- Title -->
                            <h3 id="award-showcase-title" class="font-serif text-white text-xl lg:text-2xl font-bold mb-3">{{ $firstCat->name_id }}</h3>
                            
                            <!-- Description -->
                            <p id="award-showcase-desc" class="text-white/70 text-xs md:text-sm leading-relaxed mb-4 font-light line-clamp-2 md:line-clamp-3">
                                {{ $firstCat->description_id }}
                            </p>
                        </div>
                        
                        <!-- Assessor and CTA -->
                        <div class="border-t border-white/10 pt-6 flex flex-col sm:flex-row gap-4 sm:items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div id="award-showcase-asesor-init" class="w-10 h-10 rounded-full bg-gold-500 text-forest-950 font-bold flex items-center justify-center">{{ $firstCat->asesor_init }}</div>
                                <div>
                                    <h4 id="award-showcase-asesor-name" class="text-white font-semibold text-sm">{{ $firstCat->asesor_name }}</h4>
                                    <span id="award-showcase-asesor-role" class="text-[10px] text-white/50 block">{{ $firstCat->asesor_role }}</span>
                                </div>
                            </div>
                            <button id="award-showcase-btn" class="learn-award-btn px-5 py-2.5 rounded-full border border-white/20 text-white text-xs font-semibold hover:border-gold-500 hover:text-gold-400 transition inline-flex items-center gap-1 group justify-center cursor-pointer">
                                Lihat Detail
                                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Timeline Alur Proses (Horizontal on Desktop) -->
        <div class="border-t border-white/10 pt-8 scroll-reveal">
            <div class="relative w-full mb-6 max-w-5xl mx-auto">
                <!-- Progress Bar Line (Stretches from 10% center of col 1 to 90% center of col 5) -->
                <div class="absolute top-1/2 left-[10%] right-[10%] h-[2px] bg-forest-800 transform -translate-y-1/2 z-0"></div>
                <div class="absolute top-1/2 left-[10%] right-[10%] h-[2px] transform -translate-y-1/2 z-0">
                    <div id="timeline-progress-bar" class="h-full bg-gold-500 transition-all duration-500" style="width: 0%;"></div>
                </div>
                
                <!-- Nodes Grid (Matches columns layout below) -->
                <div class="relative z-10 grid grid-cols-5 justify-items-center">
                    <!-- Node 1 -->
                    <button class="timeline-node w-10 h-10 rounded-full border-2 border-gold-500 bg-gold-500 text-forest-950 font-bold flex items-center justify-center cursor-pointer shadow-[0_0_10px_rgba(197,158,87,0.5)] focus:outline-none transition-all duration-300" aria-label="Step 1: Pengajuan">01</button>
                    <!-- Node 2 -->
                    <button class="timeline-node w-10 h-10 rounded-full border-2 border-forest-400 bg-forest-900 text-forest-400 font-bold flex items-center justify-center cursor-pointer focus:outline-none transition-all duration-300" aria-label="Step 2: Verifikasi Admin">02</button>
                    <!-- Node 3 -->
                    <button class="timeline-node w-10 h-10 rounded-full border-2 border-forest-400 bg-forest-900 text-forest-400 font-bold flex items-center justify-center cursor-pointer focus:outline-none transition-all duration-300" aria-label="Step 3: Penilaian Lapangan">03</button>
                    <!-- Node 4 -->
                    <button class="timeline-node w-10 h-10 rounded-full border-2 border-forest-400 bg-forest-900 text-forest-400 font-bold flex items-center justify-center cursor-pointer focus:outline-none transition-all duration-300" aria-label="Step 4: Hasil Penilaian">04</button>
                    <!-- Node 5 -->
                    <button class="timeline-node w-10 h-10 rounded-full border-2 border-forest-400 bg-forest-900 text-forest-400 font-bold flex items-center justify-center cursor-pointer focus:outline-none transition-all duration-300" aria-label="Step 5: Penghargaan">05</button>
                </div>
            </div>
            
            <!-- Description text details for each node -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 max-w-5xl mx-auto">
                <div class="timeline-step-detail text-center transition-all duration-300 text-white">
                    <h4 class="font-serif font-bold text-base mb-2">Pengajuan</h4>
                    <p class="text-white/60 text-xs leading-relaxed font-light font-sans max-w-[170px] mx-auto">Peserta mendaftar dan mengunggah berkas portofolio penilaian di sistem.</p>
                </div>
                <div class="timeline-step-detail text-center transition-all duration-300 opacity-60">
                    <h4 class="font-serif font-bold text-base mb-2">Verifikasi Admin</h4>
                    <p class="text-white/60 text-xs leading-relaxed font-light font-sans max-w-[170px] mx-auto">Admin memeriksa kelengkapan berkas administrasi dan dokumen pendukung.</p>
                </div>
                <div class="timeline-step-detail text-center transition-all duration-300 opacity-60">
                    <h4 class="font-serif font-bold text-base mb-2">Penilaian Lapangan</h4>
                    <p class="text-white/60 text-xs leading-relaxed font-light font-sans max-w-[170px] mx-auto">Asesor melakukan peninjauan dan penilaian langsung ke lokasi peserta.</p>
                </div>
                <div class="timeline-step-detail text-center transition-all duration-300 opacity-60">
                    <h4 class="font-serif font-bold text-base mb-2">Hasil Penilaian</h4>
                    <p class="text-white/60 text-xs leading-relaxed font-light font-sans max-w-[170px] mx-auto">Hasil penilaian dikompilasi oleh tim kurator dan disahkan dalam rapat pleno.</p>
                </div>
                <div class="timeline-step-detail text-center transition-all duration-300 opacity-60">
                    <h4 class="font-serif font-bold text-base mb-2">Penghargaan</h4>
                    <p class="text-white/60 text-xs leading-relaxed font-light font-sans max-w-[170px] mx-auto">Penyerahan penghargaan THK Awards kepada penerima dalam acara resmi tahunan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inject Category Details & Awardees to Client-side JavaScript -->
<script>
    window.awardTabDetails = @json($awardCategories->keyBy('key'));
    window.awardeesData = @json($awardees);
</script>
