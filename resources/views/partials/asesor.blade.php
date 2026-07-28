<!-- ==========================================================================
   ASESOR AKTIF SECTION (KONSULTAN)
   ========================================================================== -->
<section id="asesor-seksi" class="py-12 lg:py-16 px-6 lg:px-12 bg-white text-forest-950 relative border-t border-beige-200 min-h-[calc(100vh-80px)] flex flex-col justify-center">
    <div class="max-w-6xl mx-auto w-full">
        <!-- Header Section -->
        <div class="max-w-xl mb-10 scroll-reveal">
            <span class="text-gold-600 font-bold tracking-widest text-xs uppercase block mb-2">— Rekan Kerja Kami</span>
            <h2 class="font-serif text-forest-700 text-3xl md:text-4xl lg:text-5xl font-bold mb-3">Asesor Aktif</h2>
            <p class="text-forest-700/80 text-sm md:text-base leading-relaxed">
                Tim kurator, verifikator, dan penilai independen yang mendampingi proses penilaian standardisasi Tri Hita Karana.
            </p>
        </div>

        <!-- Assessors Grid (As shown in image copy.png) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
            @foreach($assessors as $ass)
                <div class="bg-beige-50 rounded-3xl overflow-hidden shadow-sm border border-beige-200/50 hover:shadow-md transition-all duration-300 flex flex-col scroll-reveal">
                    <!-- Top Card Background (Sunset Landscape) -->
                    <div class="h-28 w-full bg-cover bg-center shrink-0 relative" 
                         style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=400&q=80');">
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>
                    
                    <!-- Consultant Profile Overlay -->
                    <div class="relative flex flex-col items-center px-4 pb-6 pt-12 flex-1">
                        <!-- Profile Image (Overlapping half of the top background) -->
                        <div class="absolute -top-12 w-24 h-24 rounded-full border-4 border-white bg-white overflow-hidden shadow-md">
                            <img src="{{ $ass->image }}" alt="{{ $ass->name }}" class="w-full h-full object-cover">
                        </div>

                        <!-- Name and Degrees -->
                        <div class="text-center mt-2 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-serif font-bold text-forest-900 text-sm md:text-base mb-1 hover:text-gold-600 transition">{{ $ass->name }}</h3>
                                <span class="text-forest-700/60 text-[10px] md:text-xs block leading-tight font-medium mb-4">{{ $ass->title }}</span>
                            </div>

                            <!-- Social Links Row -->
                            <div class="flex justify-center items-center gap-3 text-forest-700/50 pt-2 border-t border-beige-200/50">
                                @if($ass->instagram)
                                    <a href="{{ $ass->instagram }}" target="_blank" class="hover:text-gold-500 transition"><i class="fab fa-instagram text-xs"></i></a>
                                @endif
                                @if($ass->facebook)
                                    <a href="{{ $ass->facebook }}" target="_blank" class="hover:text-gold-500 transition"><i class="fab fa-facebook-f text-xs"></i></a>
                                @endif
                                @if($ass->youtube)
                                    <a href="{{ $ass->youtube }}" target="_blank" class="hover:text-gold-500 transition"><i class="fab fa-youtube text-xs"></i></a>
                                @endif
                                @if($ass->linkedin)
                                    <a href="{{ $ass->linkedin }}" target="_blank" class="hover:text-gold-500 transition"><i class="fab fa-linkedin-in text-xs"></i></a>
                                @endif
                                @if($ass->website)
                                    <a href="{{ $ass->website }}" target="_blank" class="hover:text-gold-500 transition"><i class="fas fa-globe text-xs"></i></a>
                                @endif
                                
                                <!-- Fallback default icons if none are set, for a clean look as in the image -->
                                @if(!$ass->instagram && !$ass->facebook && !$ass->youtube && !$ass->linkedin && !$ass->website)
                                    <span class="text-[9px] uppercase tracking-wider text-forest-700/40 select-none">Tim Verifikator</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Links -->
        @if ($assessors->hasPages())
            <div class="flex flex-wrap justify-center items-center gap-2 mt-12 pb-4 scroll-reveal">
                {{-- Previous Page Link --}}
                @if ($assessors->onFirstPage())
                    <span class="w-10 h-10 rounded-full border border-beige-300 bg-white text-beige-300 flex items-center justify-center text-xs font-medium select-none cursor-not-allowed">Prev</span>
                @else
                    <a href="{{ $assessors->previousPageUrl() }}" class="w-10 h-10 rounded-full border border-beige-300 bg-white text-gold-600 hover:bg-beige-200 hover:text-forest-950 flex items-center justify-center text-xs font-medium transition cursor-pointer">Prev</a>
                @endif

                {{-- Pagination Pages --}}
                @foreach ($assessors->getUrlRange(1, $assessors->lastPage()) as $page => $url)
                    @if ($page == $assessors->currentPage())
                        <span class="w-10 h-10 rounded-full bg-beige-200 border border-beige-300 text-forest-950 flex items-center justify-center text-xs font-bold select-none shadow-inner">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-10 h-10 rounded-full border border-beige-300 bg-white text-gold-600 hover:bg-beige-200 hover:text-forest-950 flex items-center justify-center text-xs font-medium transition cursor-pointer">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($assessors->hasMorePages())
                    <a href="{{ $assessors->nextPageUrl() }}" class="w-10 h-10 rounded-full border border-beige-300 bg-white text-gold-600 hover:bg-beige-200 hover:text-forest-950 flex items-center justify-center text-xs font-medium transition cursor-pointer">Next</a>
                @else
                    <span class="w-10 h-10 rounded-full border border-beige-300 bg-white text-beige-300 flex items-center justify-center text-xs font-medium select-none cursor-not-allowed">Next</span>
                @endif

                {{-- Last Page Link --}}
                @if ($assessors->currentPage() < $assessors->lastPage())
                    <a href="{{ $assessors->url($assessors->lastPage()) }}" class="w-10 h-10 rounded-full border border-beige-300 bg-white text-gold-600 hover:bg-beige-200 hover:text-forest-950 flex items-center justify-center text-xs font-medium transition cursor-pointer">Last</a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Include FontAwesome icons for the social badges if not already loaded -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
