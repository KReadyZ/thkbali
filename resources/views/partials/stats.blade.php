<!-- ==========================================================================
   STATS SECTION (Barisan Statistik)
   ========================================================================== -->
<section id="stats-section" class="bg-forest-900 border-b border-forest-800 py-10 px-6 lg:px-12 relative z-20">
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-5 gap-6 text-center">
        <div>
            <span class="stat-counter font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-gold-500 block mb-1" data-target="{{ $statistics?->pilar_filosofi ?? 3 }}" data-suffix="">0</span>
            <span class="text-white/60 text-[10px] md:text-xs font-semibold tracking-wider uppercase block">Pilar Filosofi</span>
        </div>
        <div>
            <span class="stat-counter font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-gold-500 block mb-1" data-target="{{ $statistics?->peserta_awards ?? 120 }}" data-suffix="+">0</span>
            <span class="text-white/60 text-[10px] md:text-xs font-semibold tracking-wider uppercase block">Peserta Awards</span>
        </div>
        <div>
            <span class="stat-counter font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-gold-500 block mb-1" data-target="{{ $statistics?->asesor_aktif ?? 45 }}" data-suffix="">0</span>
            <span class="text-white/60 text-[10px] md:text-xs font-semibold tracking-wider uppercase block">Asesor Aktif</span>
        </div>
        <div>
            <span class="stat-counter font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-gold-500 block mb-1" data-target="{{ $statistics?->kategori_awards ?? 12 }}" data-suffix="">0</span>
            <span class="text-white/60 text-[10px] md:text-xs font-semibold tracking-wider uppercase block">Kategori Awards</span>
        </div>
        <div class="col-span-2 md:col-span-1">
            <span class="stat-counter font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-gold-500 block mb-1" data-target="{{ $statistics?->desa_adat_penerima ?? 8 }}" data-suffix="">0</span>
            <span class="text-white/60 text-[10px] md:text-xs font-semibold tracking-wider uppercase block">Desa Adat Penerima</span>
        </div>
    </div>
</section>
