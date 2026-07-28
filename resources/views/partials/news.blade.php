<!-- ==========================================================================
   BERITA PILIHAN SECTION
   ========================================================================== -->
<section id="berita" class="py-12 lg:py-16 px-6 lg:px-12 bg-beige-100 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="max-w-6xl mx-auto w-full">
        <!-- Header Section -->
        <div class="max-w-xl mb-8 scroll-reveal">
            <span class="text-gold-600 font-bold tracking-widest text-xs uppercase block mb-2">— Berita</span>
            <h2 class="font-serif text-forest-700 text-3xl md:text-4xl lg:text-5xl font-bold mb-3">Berita Pilihan</h2>
        </div>

        <!-- Broadcast Style News Ticker -->
        <div class="relative overflow-hidden flex items-center bg-forest-950 border border-gold-500/10 rounded-2xl py-3 px-4 mb-10 shadow-sm scroll-reveal">
            <!-- Ticker Label Badge -->
            <div class="relative z-10 shrink-0 bg-red-600 text-white font-bold text-[10px] md:text-xs uppercase px-3 py-1 rounded flex items-center gap-1.5 shadow-md mr-4 select-none">
                <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                <span>Berita Terbaru</span>
            </div>
            
            <!-- Scrolling Text Area -->
            <div class="overflow-hidden flex-1 relative">
                <div class="flex whitespace-nowrap animate-marquee">
                    <div class="flex items-center gap-16 text-white/90 text-xs md:text-sm font-medium">
                        @foreach($news as $n)
                            <a href="#" class="hover:text-gold-400 transition open-news-btn" data-news-id="{{ $n->id }}">{{ $n->title_id }}</a>
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500/50"></span>
                        @endforeach
                    </div>
                    <!-- Duplicate for seamless loop -->
                    <div class="flex items-center gap-16 text-white/90 text-xs md:text-sm font-medium ml-16" aria-hidden="true">
                        @foreach($news as $n)
                            <a href="#" class="hover:text-gold-400 transition open-news-btn" data-news-id="{{ $n->id }}">{{ $n->title_id }}</a>
                            <span class="w-1.5 h-1.5 rounded-full bg-gold-500/50"></span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Category Filter Buttons -->
        <div class="flex flex-wrap gap-2 mb-10 pb-2 border-b border-beige-200 scroll-reveal">
            <button class="news-filter-btn px-5 py-2 rounded-full border border-transparent bg-forest-500 text-white text-xs md:text-sm font-semibold transition cursor-pointer" data-filter="Semua">Semua</button>
            <button class="news-filter-btn px-5 py-2 rounded-full border border-beige-300 text-forest-700/80 bg-transparent text-xs md:text-sm font-semibold transition hover:border-gold-500 hover:text-gold-600 cursor-pointer" data-filter="Filosofi">Filosofi</button>
            <button class="news-filter-btn px-5 py-2 rounded-full border border-beige-300 text-forest-700/80 bg-transparent text-xs md:text-sm font-semibold transition hover:border-gold-500 hover:text-gold-600 cursor-pointer" data-filter="THK Awards">THK Awards</button>
            <button class="news-filter-btn px-5 py-2 rounded-full border border-beige-300 text-forest-700/80 bg-transparent text-xs md:text-sm font-semibold transition hover:border-gold-500 hover:text-gold-600 cursor-pointer" data-filter="Komunitas">Komunitas</button>
        </div>
        
        <!-- News Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($news as $index => $n)
                <div class="news-card bg-white rounded-3xl overflow-hidden shadow-md border border-beige-200/50 hover:shadow-xl hover:scale-[1.01] transition-all duration-300 scroll-reveal cursor-pointer flex flex-col h-full {{ $index >= 3 ? 'hidden extra-news' : '' }}" 
                     data-category="{{ $n->category_id }}" 
                     data-news-id="{{ $n->id }}">
                    <div class="relative overflow-hidden h-48 shrink-0">
                        <img src="{{ $n->image }}" alt="{{ $n->title_id }}" class="w-full h-full object-cover">
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="px-3 py-1 bg-forest-950/80 text-white text-[10px] uppercase font-bold tracking-wider rounded-full">{{ $n->category_id }}</span>
                        </div>
                        @if($n->is_verified)
                            <div class="absolute top-4 right-4">
                                <span class="px-2.5 py-1 bg-gold-500 text-forest-950 text-[10px] font-bold rounded-full flex items-center gap-1 shadow-md">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a.75.75 0 00-.708.522L4.547 7.222a.75.75 0 00.193.772l1.625 1.488a.75.75 0 00.865.042l2.36-1.573a.75.75 0 00.322-.84L9.123 3.977a.75.75 0 00-.737-.522H6.267zm5.556 0a.75.75 0 00-.737.522l-.79 3.136a.75.75 0 00.322.84l2.36 1.573a.75.75 0 00.865-.042l1.625-1.488a.75.75 0 00.193-.772l-1.012-3.245a.75.75 0 00-.708-.522h-2.126zM4.364 9.387A.75.75 0 003.5 10v6a1 1 0 001 1h11a1 1 0 001-1v-6a.75.75 0 00-.864-.613L10 10.59 4.364 9.387z" clip-rule="evenodd"/></svg>
                                    Terverifikasi
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex flex-col justify-between flex-1">
                        <div>
                            <h3 class="font-serif text-forest-700 text-lg font-bold mb-2 hover:text-gold-600 transition line-clamp-2">
                                <a href="#" class="open-news-btn" data-news-id="{{ $n->id }}">{{ $n->title_id }}</a>
                            </h3>
                            <p class="text-forest-700/75 text-xs md:text-sm leading-relaxed mb-4 font-light line-clamp-3">
                                {{ isset($n->content_id[0]) ? $n->content_id[0] : '' }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between border-t border-beige-200/50 pt-3">
                            <span class="text-forest-700/50 text-[11px] font-medium">{{ $n->date }}</span>
                            <a href="#" class="open-news-btn text-gold-600 hover:text-gold-500 font-bold text-xs flex items-center gap-0.5 transition" data-news-id="{{ $n->id }}">
                                Baca Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Lihat Semua Berita Button -->
        <div class="flex justify-center mt-12 scroll-reveal scroll-reveal-delay-1">
            <button id="show-all-news-btn" class="px-8 py-3.5 border-2 border-forest-500 text-forest-500 hover:bg-forest-500 hover:text-white font-bold rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                Lihat Semua Berita
            </button>
        </div>
    </div>
</section>

<!-- Inject Mapped News Details into Client JavaScript -->
@php
    $jsNews = $news->mapWithKeys(function($item) {
        return [$item->id => [
            'id' => $item->id,
            'title' => $item->title_id,
            'titleEn' => $item->title_en,
            'category' => $item->category_id,
            'categoryEn' => $item->category_en,
            'date' => $item->date,
            'image' => $item->image,
            'content' => $item->content_id,
            'contentEn' => $item->content_en,
            'views' => $item->views ?? 0
        ]];
    });
@endphp
<script>
    window.newsData = @json($jsNews);
</script>
