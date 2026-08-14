<!-- ==========================================================================
   AGENDA SECTION
   ========================================================================== -->
<section id="agenda" class="py-12 lg:py-16 px-6 lg:px-12 bg-beige-100 min-h-[calc(100vh-80px)] flex flex-col justify-center border-t border-beige-200">
    <div class="max-w-6xl mx-auto w-full">
        <!-- Header Section -->
        <div class="max-w-xl mb-8 scroll-reveal">
            <span class="text-gold-600 font-bold tracking-widest text-xs uppercase block mb-2">— Agenda</span>
            <h2 class="font-serif text-forest-700 text-3xl md:text-4xl lg:text-5xl font-bold mb-3">Agenda Kegiatan</h2>
            <p class="text-forest-700/80 text-sm md:text-base leading-relaxed">
                Ikuti berbagai agenda diskusi ilmiah, program sertifikasi, dan sosialisasi terkait nilai kearifan lokal Tri Hita Karana.
            </p>
        </div>

        <!-- Agenda Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($agendas as $agenda)
                <div class="agenda-card bg-white rounded-3xl overflow-hidden shadow-md border border-beige-200/50 hover:shadow-xl hover:scale-[1.01] transition-all duration-300 scroll-reveal cursor-pointer flex flex-col sm:flex-row h-full"
                     data-agenda-id="{{ $agenda->id }}">
                    <!-- Flyer Thumbnail Left -->
                    <div class="relative w-full sm:w-48 shrink-0 h-48 sm:h-auto bg-forest-950 flex items-center justify-center overflow-hidden">
                        <img src="{{ $agenda->image }}" alt="{{ $agenda->title }}" class="w-full h-full object-cover">
                        <!-- Stats Badge -->
                        <div class="absolute top-3 left-3 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-full flex items-center gap-1 text-[10px] text-white">
                            <svg class="w-3.5 h-3.5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ $agenda->views }} Dibaca</span>
                        </div>
                    </div>

                    <!-- Details Right -->
                    <div class="p-6 flex flex-col justify-between flex-1">
                        <div>
                            <span class="text-gold-600 text-xs font-bold uppercase tracking-wider block mb-1">Book Chapter / Seminar</span>
                            <h3 class="font-serif text-forest-700 text-lg font-bold mb-3 hover:text-gold-600 transition line-clamp-2">{{ $agenda->title }}</h3>
                            
                            <div class="space-y-1.5 text-xs text-forest-700/80 font-medium mb-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <span class="truncate">{{ $agenda->date_range }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $agenda->place }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-beige-200/50 pt-3 flex items-center justify-between">
                            <span class="text-forest-700/50 text-[10px] truncate">Oleh: {{ $agenda->contributor }}</span>
                            <button class="open-agenda-btn text-gold-600 hover:text-gold-500 font-bold text-xs flex items-center gap-0.5 transition cursor-pointer" data-agenda-id="{{ $agenda->id }}">
                                Selengkapnya
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Agenda Detail Modal (Overlay) -->
<div id="agenda-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-md opacity-0 transition-opacity duration-300 px-4">
    <div class="modal-dialog bg-forest-900 border border-gold-500/30 w-full max-w-4xl rounded-3xl overflow-hidden shadow-2xl scale-95 opacity-0 transition-all duration-300 max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="p-6 border-b border-white/10 flex justify-between items-start shrink-0">
            <div>
                <span class="text-gold-400 font-semibold tracking-wider text-xs uppercase block mb-1">Detail Agenda Kegiatan</span>
                <h3 id="agenda-modal-title" class="font-serif text-white text-xl md:text-2xl font-bold leading-tight">Agenda Title</h3>
            </div>
            <button id="agenda-modal-close" class="text-white/60 hover:text-white transition p-1 bg-white/5 rounded-full cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Modal Body (Scrollable) -->
        <div class="p-6 md:p-8 overflow-y-auto flex-1 text-white">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Flyer Image Left (md:col-span-5) -->
                <div class="md:col-span-5 flex flex-col items-center">
                    <div class="w-full bg-forest-950 rounded-2xl overflow-hidden shadow-lg border border-white/10">
                        <img id="agenda-modal-image" src="" alt="Flyer" class="w-full h-auto">
                    </div>
                    <!-- Meta info row -->
                    <div class="mt-4 w-full flex justify-between text-xs text-white/55">
                        <span id="agenda-modal-views">0 dibaca</span>
                        <span id="agenda-modal-contributor">Kontributor: </span>
                    </div>
                </div>

                <!-- Text details Right (md:col-span-7) -->
                <div class="md:col-span-7 flex flex-col justify-between">
                    <div>
                        <!-- Event Info Table -->
                        <div class="bg-forest-950/80 border border-white/10 rounded-2xl p-5 mb-6 text-sm space-y-3">
                            <div class="grid grid-cols-3 border-b border-white/5 pb-2.5">
                                <span class="text-gold-400 font-semibold">Hari/Tanggal</span>
                                <span class="col-span-2 text-white/90" id="agenda-modal-date">Date range</span>
                            </div>
                            <div class="grid grid-cols-3 border-b border-white/5 pb-2.5">
                                <span class="text-gold-400 font-semibold">Pukul</span>
                                <span class="col-span-2 text-white/90" id="agenda-modal-time">00.00</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-gold-400 font-semibold">Tempat</span>
                                <span class="col-span-2 text-white/90" id="agenda-modal-place">Denpasar Institute</span>
                            </div>
                        </div>

                        <!-- Description & Topics -->
                        <div class="space-y-4">
                            <h4 class="text-gold-400 font-serif font-bold text-lg">Deskripsi Acara</h4>
                            <div id="agenda-modal-desc" class="text-white/80 leading-relaxed text-sm whitespace-pre-line font-light">
                                Deskripsi Agenda
                            </div>
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="flex flex-wrap gap-2 py-3 border-y border-white/10 my-4" id="agenda-share-container">
                            <a href="#" id="agenda-share-fb" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#3b5998] hover:bg-[#3b5998]/90 text-white text-[11px] font-bold transition">
                                <i class="fab fa-facebook-f"></i> Share
                            </a>
                            <a href="#" id="agenda-share-wa" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#25d366] hover:bg-[#25d366]/90 text-white text-[11px] font-bold transition">
                                <i class="fab fa-whatsapp"></i> Share
                            </a>
                            <a href="#" id="agenda-share-line" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#06c755] hover:bg-[#06c755]/90 text-white text-[11px] font-bold transition">
                                <i class="fab fa-line"></i> Share
                            </a>
                            <a href="#" id="agenda-share-tg" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#0088cc] hover:bg-[#0088cc]/90 text-white text-[11px] font-bold transition">
                                <i class="fab fa-telegram-plane"></i> Share
                            </a>
                            <a href="#" id="agenda-share-x" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black hover:bg-black/90 text-white text-[11px] font-bold transition border border-white/10">
                                <i class="fa-brands fa-x-twitter"></i> Post
                            </a>
                            <button id="agenda-share-copy" class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#8cc63f] hover:bg-[#8cc63f]/90 text-white transition cursor-pointer" title="Salin Tautan">
                                <i class="fas fa-share-alt text-[11px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Action CTA -->
                    <div class="mt-8 border-t border-white/10 pt-5 flex justify-end gap-3 shrink-0">
                        <button id="agenda-modal-cancel" class="px-5 py-2.5 rounded-full border border-white/20 text-white hover:bg-white/10 transition text-xs font-semibold cursor-pointer">
                            Tutup
                        </button>
                        <a id="agenda-modal-wa" href="https://wa.me/081337644463" target="_blank" class="px-6 py-2.5 rounded-full bg-gold-500 text-forest-950 hover:bg-gold-400 transition text-xs font-black flex items-center gap-1.5 shadow-md">
                            Hubungi Narahubung via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inject Agenda Details to Client-side JavaScript -->
<script>
    window.agendaData = @json($agendas->keyBy('id'));
</script>
