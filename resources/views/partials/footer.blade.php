<!-- ==========================================================================
   FOOTER
   ========================================================================== -->
<footer class="bg-forest-950 text-white pt-16 pb-8 px-6 lg:px-12 border-t-2 border-gold-500/20">
    <div class="max-w-6xl mx-auto flex flex-col gap-12">
@php
    $webSetting = \App\Models\PaymentSetting::first();
@endphp
        <!-- Top Footer Bar -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 pb-10 border-b border-white/10">
            <!-- Left: Logo -->
            <div class="flex items-center gap-3">
                @if(isset($webSetting->logo_path) && $webSetting->logo_path)
                    <img src="{{ asset($webSetting->logo_path) }}" class="w-8 h-8 object-contain rounded-full border border-gold-500/20" alt="Logo">
                @else
                    <svg class="w-8 h-8 text-gold-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="9" r="6" stroke="currentColor" />
                        <circle cx="8" cy="15" r="6" stroke="currentColor" />
                        <circle cx="16" cy="15" r="6" stroke="currentColor" />
                    </svg>
                @endif
                <div>
                    <span class="font-serif font-bold text-white text-base tracking-wide block leading-tight">THK Bali</span>
                    <span class="text-[9px] text-white/50 font-semibold tracking-wider uppercase block">Tri Hita Karana</span>
                </div>
            </div>
            
            <!-- Center Links -->
            <nav class="flex flex-wrap justify-center gap-6 md:gap-8 text-white/70 text-sm">
                <a href="#tentang-thk" class="hover:text-gold-400 transition">Tentang THK</a>
                <a href="#thk-awards" class="hover:text-gold-400 transition">THK Awards</a>
                <a href="#berita" class="hover:text-gold-400 transition">Berita</a>
                <a href="#galeri" class="hover:text-gold-400 transition">Galeri</a>
                <a href="#contact" class="open-contact-btn hover:text-gold-400 transition">Hubungi Kami</a>
            </nav>
            
            <!-- Right Social Icons -->
            <div class="flex items-center gap-4">
                <!-- Envelope -->
                <a href="mailto:thkbaliofficial@gmail.com" class="w-10 h-10 rounded-full border border-white/15 text-gold-500 hover:border-gold-500 hover:bg-gold-500/10 flex items-center justify-center transition" aria-label="Kirim Email">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="https://instagram.com/thkbaliofc" class="w-10 h-10 rounded-full border border-white/15 text-gold-500 hover:border-gold-500 hover:bg-gold-500/10 flex items-center justify-center transition" aria-label="Ikuti Instagram">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4v10a4 4 0 004 4z"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                        <circle cx="17" cy="7" r="0.5" fill="currentColor"/>
                    </svg>
                </a>
                <!-- Facebook -->   
                <a href="https://www.facebook.com/profile.php?id=61592632646903&sk=directory_intro" class="w-10 h-10 rounded-full border border-white/15 text-gold-500 hover:border-gold-500 hover:bg-gold-500/10 flex items-center justify-center transition" aria-label="Ikuti Facebook">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Bottom copyrights bar -->
        <div class="text-center text-xs text-white/40 font-light">
            &copy; 2026 THK Bali — Hak Cipta Dilindungi
        </div>
    </div>
</footer>
