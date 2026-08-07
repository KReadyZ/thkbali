<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4 px-6 lg:px-12 bg-transparent">
    <div class="flex items-center justify-between w-full">
        <!-- Logo Column -->
        <div class="flex-1 flex justify-start">
            <a href="#home" class="flex items-center gap-3 group">
                <div class="relative w-10 h-10 flex items-center justify-center bg-gold-500/10 rounded-full border border-gold-500/20 group-hover:border-gold-500/50 transition duration-300 overflow-hidden">
                    @if(isset($webSetting) && $webSetting->logo_path)
                        <img src="{{ asset($webSetting->logo_path) }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        <!-- Triquetra SVG symbol -->
                        <svg class="w-7 h-7 text-gold-500 transition-transform duration-500 group-hover:rotate-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="9" r="6" stroke="currentColor" />
                            <circle cx="8" cy="15" r="6" stroke="currentColor" />
                            <circle cx="16" cy="15" r="6" stroke="currentColor" />
                        </svg>
                    @endif
                </div>
                <div>
                    <span class="font-serif font-bold text-white text-lg tracking-wide block leading-tight">{{ $webSetting->website_name ?? 'THK Bali' }}</span>
                    <span class="text-[10px] text-gold-400 font-semibold tracking-widest uppercase block">Tri Hita Karana</span>
                </div>
            </a>
        </div>

        <!-- Desktop Menu Column (Perfectly Centered) -->
        <div class="hidden lg:block lg:mx-6 xl:mx-10">
            <nav class="flex items-center gap-5 xl:gap-8 text-white/90 font-medium">
                <a href="#home" class="nav-link hover:text-gold-400 transition text-sm">
                    <span class="lang-id-text">Beranda</span>
                    <span class="lang-en-text">Home</span>
                    <span class="lang-jv-text notranslate">Beranda</span>
                </a>
                <a href="#tentang-thk" class="nav-link hover:text-gold-400 transition text-sm">
                    <span class="lang-id-text">Tentang THK</span>
                    <span class="lang-en-text">About THK</span>
                    <span class="lang-jv-text notranslate">Babagan THK</span>
                </a>
                <a href="#thk-awards" class="nav-link hover:text-gold-400 transition text-sm">
                    <span class="lang-id-text">THK Awards</span>
                    <span class="lang-en-text">THK Awards</span>
                    <span class="lang-jv-text notranslate">THK Awards</span>
                </a>
                <a href="#berita" class="nav-link hover:text-gold-400 transition text-sm">
                    <span class="lang-id-text">Berita</span>
                    <span class="lang-en-text">News</span>
                    <span class="lang-jv-text notranslate">Pawarta</span>
                </a>
                <a href="#agenda" class="nav-link hover:text-gold-400 transition text-sm">
                    <span class="lang-id-text">Agenda</span>
                    <span class="lang-en-text">Agenda</span>
                    <span class="lang-jv-text notranslate">Agenda</span>
                </a>
                <a href="#galeri" class="nav-link hover:text-gold-400 transition text-sm">
                    <span class="lang-id-text">Galeri</span>
                    <span class="lang-en-text">Gallery</span>
                    <span class="lang-jv-text notranslate">Galeri</span>
                </a>
            </nav>
        </div>

        <!-- Navbar Buttons Column -->
        <div class="flex-1 flex justify-end items-center gap-3">
            @auth
                <div class="hidden lg:flex items-center gap-3">
                    <!-- Actions for Peserta -->
                    @if(Auth::user()->role === 'peserta')
                        <button id="open-upload-btn" class="px-4 py-2 rounded-full bg-gold-500 text-forest-950 text-xs font-bold hover:bg-gold-400 hover:shadow-lg hover:shadow-gold-500/20 transition duration-300 cursor-pointer whitespace-nowrap">
                            <i class="fas fa-cloud-upload-alt mr-1"></i> Unggah Berkas
                        </button>
                    @endif

                    <!-- User Name & Greeting with nested Status Badge -->
                    <span class="text-white text-xs font-bold flex items-center gap-2 bg-black/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/10 shadow-sm whitespace-nowrap">
                        <i class="far fa-user-circle text-gold-400 text-sm"></i>
                        <span>Halo, {{ Auth::user()->name }}</span>
                        @if(Auth::user()->role === 'peserta' && isset($userProposal))
                            <span class="ml-1 px-2 py-0.5 rounded-full bg-gold-500/20 border border-gold-500/40 text-gold-300 text-[10px] font-bold uppercase tracking-wider">
                                {{ $userProposal->status }}
                            </span>
                        @endif
                    </span>

                    <!-- Panel Asesor (if Assessor) -->
                    @if(Auth::user()->role === 'asesor')
                        <a href="{{ route('assessor.dashboard') }}" class="px-4 py-2 rounded-full bg-gold-500 text-forest-950 text-xs font-bold hover:bg-gold-400 transition duration-300 whitespace-nowrap">
                            <i class="fas fa-clipboard-check mr-1"></i> Panel Asesor
                        </a>
                    @endif

                    <!-- Panel Admin (if Admin) -->
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full bg-forest-500 text-white text-xs font-bold hover:bg-forest-600 transition duration-300 whitespace-nowrap">
                            <i class="fas fa-user-shield mr-1"></i> Panel Admin
                        </a>
                    @endif

                    <!-- Logout Button -->
                    <a href="{{ route('logout') }}" class="px-4 py-2 rounded-full border border-white/20 text-white/80 text-xs font-bold hover:border-red-500/50 hover:text-red-400 hover:bg-red-500/10 transition bg-black/15 whitespace-nowrap">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        <span class="lang-id-text">Keluar</span>
                        <span class="lang-en-text">Logout</span>
                        <span class="lang-jv-text notranslate">Medal</span>
                    </a>
                </div>
            @else
                <div class="hidden lg:flex items-center gap-4">
                    <button class="open-login-btn px-6 py-2 rounded-full border border-white/30 text-white text-sm font-medium hover:border-gold-500 hover:text-gold-400 transition duration-300 bg-black/10 backdrop-blur-sm">
                        <span class="lang-id-text">Masuk</span>
                        <span class="lang-en-text">Login</span>
                        <span class="lang-jv-text notranslate">Mlebet</span>
                    </button>
                    <button class="open-register-btn px-6 py-2 rounded-full bg-gold-500 text-forest-950 text-sm font-bold hover:bg-gold-400 hover:shadow-lg hover:shadow-gold-500/20 transition duration-300">
                        <span class="lang-id-text">Daftar</span>
                        <span class="lang-en-text">Register</span>
                        <span class="lang-jv-text notranslate">Daftar</span>
                    </button>
                </div>
            @endauth

            {{-- 
            <!-- Sleek Language Switcher -->
            <div class="hidden lg:flex items-center gap-1 border border-white/20 rounded-full p-0.5 bg-black/10 backdrop-blur-sm ml-2">
                <button class="lang-btn px-3 py-1 rounded-full text-xs font-bold transition duration-300" data-lang="id">ID</button>
                <button class="lang-btn px-3 py-1 rounded-full text-xs font-bold transition duration-300" data-lang="en">EN</button>
            </div>
            --}}

            <!-- Hamburger Icon (Mobile) -->
            <button id="mobile-menu-btn" class="lg:hidden text-white hover:text-gold-400 focus:outline-none p-2" aria-label="Open Mobile Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Drawer Menu Overlay -->
<div id="mobile-menu-overlay" class="fixed inset-0 z-50 hidden bg-forest-950/98 text-white transition-all duration-300 opacity-0 translate-x-full">
    <div class="flex flex-col h-full p-6 justify-between">
        <div class="flex items-center justify-between border-b border-white/10 pb-4">
            <div class="flex items-center gap-3">
                <div class="relative w-8 h-8 flex items-center justify-center bg-gold-500/10 rounded-full border border-gold-500/20 overflow-hidden shrink-0">
                    @if(isset($webSetting) && $webSetting->logo_path)
                        <img src="{{ asset($webSetting->logo_path) }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        <!-- Triquetra SVG symbol -->
                        <svg class="w-6 h-6 text-gold-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="9" r="6" stroke="currentColor" />
                            <circle cx="8" cy="15" r="6" stroke="currentColor" />
                            <circle cx="16" cy="15" r="6" stroke="currentColor" />
                        </svg>
                    @endif
                </div>
                <span class="font-serif font-bold text-white text-lg">{{ $webSetting->website_name ?? 'THK Bali' }}</span>
            </div>
            <button id="mobile-menu-close-btn" class="text-white hover:text-gold-400 focus:outline-none p-2" aria-label="Close Mobile Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <nav class="flex flex-col gap-6 py-8 text-xl font-serif text-center">
            <a href="#home" class="nav-scroll-link hover:text-gold-400 transition">
                <span class="lang-id-text">Beranda</span>
                <span class="lang-en-text">Home</span>
                <span class="lang-jv-text notranslate">Beranda</span>
            </a>
            <a href="#tentang-thk" class="nav-scroll-link hover:text-gold-400 transition">
                <span class="lang-id-text">Tentang THK</span>
                <span class="lang-en-text">About THK</span>
                <span class="lang-jv-text notranslate">Babagan THK</span>
            </a>
            <a href="#thk-awards" class="nav-scroll-link hover:text-gold-400 transition">
                <span class="lang-id-text">THK Awards</span>
                <span class="lang-en-text">THK Awards</span>
                <span class="lang-jv-text notranslate">THK Awards</span>
            </a>
            <a href="#berita" class="nav-scroll-link hover:text-gold-400 transition">
                <span class="lang-id-text">Berita</span>
                <span class="lang-en-text">News</span>
                <span class="lang-jv-text notranslate">Pawarta</span>
            </a>
            <a href="#agenda" class="nav-scroll-link hover:text-gold-400 transition">
                <span class="lang-id-text">Agenda</span>
                <span class="lang-en-text">Agenda</span>
                <span class="lang-jv-text notranslate">Agenda</span>
            </a>
            <a href="#galeri" class="nav-scroll-link hover:text-gold-400 transition">
                <span class="lang-id-text">Galeri</span>
                <span class="lang-en-text">Gallery</span>
                <span class="lang-jv-text notranslate">Galeri</span>
            </a>
        </nav>

        <div class="flex flex-col gap-4 border-t border-white/10 pt-6">
            {{--
            <!-- Mobile Language Switcher -->
            <div class="flex items-center justify-center gap-2 border border-white/20 rounded-full p-0.5 bg-black/10 backdrop-blur-sm mx-auto w-40 mb-2">
                <button class="lang-btn w-1/2 py-1.5 rounded-full text-xs font-bold transition duration-300 text-center" data-lang="id">ID</button>
                <button class="lang-btn w-1/2 py-1.5 rounded-full text-xs font-bold transition duration-300 text-center" data-lang="en">EN</button>
            </div>
            --}}
            
            @auth
                <div class="text-center space-y-4">
                    <div class="text-white text-base font-bold bg-white/5 border border-white/10 py-3 rounded-2xl">
                        Halo, {{ Auth::user()->name }}
                    </div>

                    @if(Auth::user()->role === 'asesor')
                        <a href="{{ route('assessor.dashboard') }}" class="block w-full py-3 text-center rounded-full bg-gold-500 text-forest-950 font-bold hover:bg-gold-400 transition">
                            <i class="fas fa-clipboard-check mr-1"></i> Panel Asesor
                        </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block w-full py-3 text-center rounded-full bg-forest-500 text-white font-bold hover:bg-forest-600 transition">
                            <i class="fas fa-user-shield mr-1"></i> Panel Admin
                        </a>
                    @endif
                    
                    @if(Auth::user()->role === 'peserta')
                        @if(isset($userProposal))
                            <div class="text-xs font-semibold text-gold-400 bg-gold-500/10 border border-gold-500/20 py-2 rounded-xl">
                                Status: {{ $userProposal->status }}
                            </div>
                        @endif
                        <button id="open-upload-btn-mobile" class="w-full py-3 rounded-full bg-gold-500 text-forest-950 font-bold hover:bg-gold-400 transition">
                            <i class="fas fa-cloud-upload-alt mr-1"></i> Unggah Berkas
                        </button>
                    @endif
                    
                    <a href="{{ route('logout') }}" class="block w-full py-3 text-center rounded-full border border-red-500/30 text-red-400 font-bold hover:bg-red-500/10 transition">
                        <span class="lang-id-text">Keluar</span>
                        <span class="lang-en-text">Logout</span>
                        <span class="lang-jv-text notranslate">Medal</span>
                    </a>
                </div>
            @else
                <button class="open-login-btn w-full py-3 rounded-full border border-white/30 text-white font-medium hover:border-gold-500 hover:text-gold-400 transition">
                    <span class="lang-id-text">Masuk</span>
                    <span class="lang-en-text">Login</span>
                    <span class="lang-jv-text notranslate">Mlebet</span>
                </button>
                <button class="open-register-btn w-full py-3 rounded-full bg-gold-500 text-forest-950 font-bold hover:bg-gold-400 transition">
                    <span class="lang-id-text">Daftar</span>
                    <span class="lang-en-text">Register</span>
                    <span class="lang-jv-text notranslate">Daftar</span>
                </button>
            @endauth
        </div>
    </div>
</div>
