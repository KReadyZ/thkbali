<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — THK Bali</title>
    @vite(['resources/css/app.css'])
    <!-- FontAwesome for Dashboard icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- jQuery (required by Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Summernote Lite CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<body class="bg-beige-100 text-forest-950 h-screen flex flex-col font-sans overflow-hidden">

    <!-- Top Navigation Header -->
    <header class="bg-forest-950 text-white py-4 px-6 lg:px-12 flex items-center justify-between border-b border-gold-500/20 shrink-0 sticky top-0 z-30">
        <div class="flex items-center gap-3">
            @if(isset($webSetting) && $webSetting->logo_path)
                <img src="{{ asset($webSetting->logo_path) }}" alt="Logo" class="w-8 h-8 object-contain">
            @else
                <svg class="w-8 h-8 text-gold-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="9" r="6" stroke="currentColor" />
                    <circle cx="8" cy="15" r="6" stroke="currentColor" />
                    <circle cx="16" cy="15" r="6" stroke="currentColor" />
                </svg>
            @endif
            <div>
                <span class="font-serif font-bold text-base block tracking-wide">{{ $webSetting->website_name ?? 'THK Bali' }} Back Office</span>
                <span class="text-[9px] text-gold-400 font-semibold tracking-widest uppercase block leading-none">Administrator Panel</span>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <span class="hidden md:inline text-xs text-white/70">Masuk sebagai: <strong class="text-white">{{ Auth::user() ? Auth::user()->name : 'Admin' }}</strong></span>
            <a href="{{ route('admin.logout') }}" class="px-4 py-1.5 rounded-full border border-red-500/30 text-red-400 hover:bg-red-500 hover:text-white text-xs font-bold transition duration-300">
                Keluar
            </a>
        </div>
    </header>

    <div class="flex-1 flex flex-col lg:flex-row min-h-0 overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside class="w-full lg:w-64 bg-forest-900 text-white shrink-0 border-b lg:border-b-0 lg:border-r border-white/5 flex flex-col min-w-0">
            <nav class="p-4 flex flex-row lg:flex-col gap-2 lg:gap-0 lg:space-y-1 overflow-x-auto lg:overflow-y-auto scrollbar-hidden w-full shrink-0">
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer active-tab-btn whitespace-nowrap shrink-0" data-tab-id="stats">
                    <i class="fas fa-chart-line w-5 text-center text-gold-500"></i> Statistik Homepage
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="news">
                    <i class="far fa-newspaper w-5 text-center text-gold-500"></i> Kelola Berita
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="categories">
                    <i class="fas fa-award w-5 text-center text-gold-500"></i> Kategori THK Awards
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="assessors">
                    <i class="fas fa-users-cog w-5 text-center text-gold-500"></i> Kelola Asesor
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="agendas">
                    <i class="far fa-calendar-alt w-5 text-center text-gold-500"></i> Kelola Agenda
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="gallery">
                    <i class="far fa-images w-5 text-center text-gold-500"></i> Galeri Foto
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="awardees">
                    <i class="fas fa-medal w-5 text-center text-gold-500"></i> Penerima Awards
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="proposals">
                    <i class="fas fa-file-invoice w-5 text-center text-gold-500"></i> Kelola Pendaftaran
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="payment">
                    <i class="fas fa-university w-5 text-center text-gold-500"></i> Info Pembayaran
                </button>
                <button class="tab-btn flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium hover:bg-white/5 hover:text-gold-400 transition text-left cursor-pointer whitespace-nowrap shrink-0" data-tab-id="websetting">
                    <i class="fas fa-cog w-5 text-center text-gold-500"></i> Pengaturan Web
                </button>
                
                <a href="{{ route('home') }}" target="_blank" class="lg:hidden flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold border border-gold-500/30 text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition whitespace-nowrap shrink-0">
                    <i class="fas fa-external-link-alt text-center w-5"></i> Buka Website
                </a>
            </nav>
            <div class="hidden lg:block mt-auto p-4 border-t border-white/5">
                <a href="{{ route('home') }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-gold-500/30 text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition text-xs font-bold">
                    <i class="fas fa-external-link-alt"></i> Buka Website
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-10 overflow-y-auto">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-2xl p-4 mb-6 text-sm flex items-start gap-2.5 shadow-sm">
                    <i class="fas fa-check-circle mt-0.5 text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 rounded-2xl p-4 mb-6 text-sm flex flex-col gap-1 shadow-sm">
                    <div class="flex items-start gap-2.5 font-bold mb-1">
                        <i class="fas fa-exclamation-circle mt-0.5 text-red-600"></i>
                        <span>Ada kesalahan pengisian data:</span>
                    </div>
                    <ul class="list-disc pl-6 space-y-0.5 text-xs text-red-800/90">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ==================== TAB: STATISTIK ==================== -->
            <section id="tab-content-stats" class="tab-pane active-tab-pane">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <h2 class="font-serif text-2xl font-bold text-forest-900 mb-2">Edit Counter Statistik Homepage</h2>
                    <p class="text-xs text-forest-700/60 mb-6 font-medium uppercase tracking-wider">Perubahan langsung tercermin pada barisan statistik beranda secara realtime.</p>
                    
                    <form action="{{ route('admin.stats.update') }}" method="POST" class="max-w-2xl space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Pilar Filosofi</label>
                                <input type="number" name="pilar_filosofi" value="{{ $statistics->pilar_filosofi }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Peserta Awards</label>
                                <input type="number" name="peserta_awards" value="{{ $statistics->peserta_awards }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Asesor Aktif</label>
                                <input type="number" name="asesor_aktif" value="{{ $statistics->asesor_aktif }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Kategori Awards</label>
                                <input type="number" name="kategori_awards" value="{{ $statistics->kategori_awards }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Desa Adat Penerima</label>
                                <input type="number" name="desa_adat_penerima" value="{{ $statistics->desa_adat_penerima }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition">
                            </div>
                        </div>
                        <button type="submit" class="px-6 py-3 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full transition shadow-md cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </section>

            <!-- ==================== TAB: NEWS ==================== -->
            <section id="tab-content-news" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-forest-900">Kelola Berita Pilihan</h2>
                            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Tambah, edit, atau hapus artikel berita di website.</p>
                        </div>
                        <button class="px-5 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full transition text-xs flex items-center gap-1.5 shadow-sm cursor-pointer" onclick="openAddNewsModal()">
                            <i class="fas fa-plus"></i> Tambah Berita
                        </button>
                    </div>

                    <!-- News Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Gambar</th>
                                    <th class="py-3 px-4">Judul (ID)</th>
                                    <th class="py-3 px-4">Kategori (ID)</th>
                                    <th class="py-3 px-4">Tanggal</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @foreach($news as $item)
                                    <tr class="hover:bg-beige-50/50 transition">
                                        <td class="py-3 px-4">
                                            <img src="{{ $item->image }}" class="w-16 h-10 object-cover rounded-lg border border-beige-200">
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-forest-900 max-w-xs truncate">{{ $item->title_id }}</td>
                                        <td class="py-3 px-4 text-xs font-semibold text-white bg-forest-500/80 px-2 py-0.5 rounded-full inline-block mt-4">{{ $item->category_id }}</td>
                                        <td class="py-3 px-4 text-xs text-forest-700/60">{{ $item->date }}</td>
                                        <td class="py-3 px-4 text-right space-x-2">
                                            <button class="text-gold-600 hover:text-gold-500 font-bold text-xs cursor-pointer" onclick="openEditNewsModal({{ json_encode($item) }})">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.news.delete', $item->id) }}" class="delete-confirm-btn text-red-500 hover:text-red-400 font-bold text-xs" data-message="Apakah Anda yakin ingin menghapus berita ini?">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $news->appends(request()->query())->links() }}
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: CATEGORIES ==================== -->
            <section id="tab-content-categories" class="tab-pane hidden">
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                        <h2 class="font-serif text-2xl font-bold text-forest-900 mb-2">Edit Kategori THK Awards</h2>
                        <p class="text-xs text-forest-700/60 mb-6 font-medium uppercase tracking-wider">Perbarui deskripsi, lencana, dan info kurator untuk ke-6 kategori awards.</p>

                        <div class="space-y-6 divide-y divide-beige-200">
                            @foreach($awardCategories as $cat)
                                <div class="pt-6 first:pt-0">
                                    <h3 class="font-serif text-lg font-bold text-forest-700 mb-4 flex items-center gap-2">
                                        <span class="w-8 h-8 rounded-full bg-gold-500 text-forest-950 flex items-center justify-center text-xs font-bold shrink-0">{{ $cat->asesor_init }}</span>
                                        {{ $cat->name_id }}
                                    </h3>
                                    
                                    <form action="{{ route('admin.category.save', $cat->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        @csrf
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Nama (ID)</label>
                                            <input type="text" name="name_id" value="{{ $cat->name_id }}" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none">
                                        </div>
                                        <input type="hidden" name="name_en" value="{{ $cat->name_en }}">
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Deskripsi (ID)</label>
                                            <textarea name="description_id" rows="3" required class="w-full bg-beige-50 border border-beige-300 rounded-xl p-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none">{{ $cat->description_id }}</textarea>
                                        </div>
                                        <textarea name="description_en" class="hidden">{{ $cat->description_en }}</textarea>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Lencana (ID) <span class="text-[10px] text-forest-700/50 normal-case">(Pisah koma)</span></label>
                                            <input type="text" name="badges_id" value="{{ implode(', ', $cat->badges_id) }}" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none">
                                        </div>
                                        <input type="hidden" name="badges_en" value="{{ implode(', ', $cat->badges_en) }}">
                                        <div>
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Inisial Asesor</label>
                                            <input type="text" name="asesor_init" value="{{ $cat->asesor_init }}" required maxlength="2" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Nama Asesor/Kurator</label>
                                            <input type="text" name="asesor_name" value="{{ $cat->asesor_name }}" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Role Asesor/Kurator</label>
                                            <input type="text" name="asesor_role" value="{{ $cat->asesor_role }}" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold uppercase text-forest-700 mb-1.5">Ganti Cover Gambar</label>
                                            <input type="file" name="image_file" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-xs">
                                        </div>
                                        <div class="md:col-span-2 text-right">
                                            <button type="submit" class="px-5 py-2.5 bg-forest-500 hover:bg-forest-600 text-white font-bold rounded-full transition text-xs shadow-sm cursor-pointer">
                                                Update Kategori
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: ASSESSORS ==================== -->
            <section id="tab-content-assessors" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-forest-900">Kelola Tim Asesor</h2>
                            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Perbarui dan tambahkan profil Asesor Aktif yang ditunjukkan di website.</p>
                        </div>
                        <button class="px-5 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full transition text-xs flex items-center gap-1.5 shadow-sm cursor-pointer" onclick="openAddAssessorModal()">
                            <i class="fas fa-plus"></i> Tambah Asesor
                        </button>
                    </div>

                    <!-- Assessors Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Foto</th>
                                    <th class="py-3 px-4">Nama</th>
                                    <th class="py-3 px-4">Spesialisasi</th>
                                    <th class="py-3 px-4">Sosmed</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @foreach($assessors as $ass)
                                    <tr class="hover:bg-beige-50/50 transition">
                                        <td class="py-3 px-4">
                                            <img src="{{ $ass->image }}" class="w-10 h-10 object-cover rounded-full border border-beige-200">
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-forest-900">{{ $ass->name }}</td>
                                        <td class="py-3 px-4 text-xs text-forest-700/80">{{ $ass->title }}</td>
                                        <td class="py-3 px-4 text-xs space-x-1.5 text-forest-700/50">
                                            @if($ass->instagram) <i class="fab fa-instagram"></i> @endif
                                            @if($ass->facebook) <i class="fab fa-facebook-f"></i> @endif
                                            @if($ass->linkedin) <i class="fab fa-linkedin-in"></i> @endif
                                        </td>
                                        <td class="py-3 px-4 text-right space-x-2">
                                            <button class="text-gold-600 hover:text-gold-500 font-bold text-xs cursor-pointer" onclick="openEditAssessorModal({{ json_encode($ass) }})">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.assessor.delete', $ass->id) }}" class="delete-confirm-btn text-red-500 hover:text-red-400 font-bold text-xs" data-message="Apakah Anda yakin ingin menghapus asesor ini?">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $assessors->appends(request()->query())->links() }}
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: AGENDAS ==================== -->
            <section id="tab-content-agendas" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-forest-900">Kelola Agenda Kegiatan</h2>
                            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Kelola agenda kegiatan seperti Call for Book Chapter, Lokakarya, dan Seminar.</p>
                        </div>
                        <button class="px-5 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full transition text-xs flex items-center gap-1.5 shadow-sm cursor-pointer" onclick="openAddAgendaModal()">
                            <i class="fas fa-plus"></i> Tambah Agenda
                        </button>
                    </div>

                    <!-- Agenda Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Flyer</th>
                                    <th class="py-3 px-4">Judul Agenda</th>
                                    <th class="py-3 px-4">Kontributor</th>
                                    <th class="py-3 px-4">Tempat / Tanggal</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @foreach($agendas as $ag)
                                    <tr class="hover:bg-beige-50/50 transition">
                                        <td class="py-3 px-4">
                                            <img src="{{ $ag->image }}" class="w-12 h-16 object-cover rounded-lg border border-beige-200">
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-forest-900 max-w-xs truncate">{{ $ag->title }}</td>
                                        <td class="py-3 px-4 text-xs text-forest-700/80">{{ $ag->contributor }}</td>
                                        <td class="py-3 px-4 text-xs text-forest-700/60">
                                            <div>{{ $ag->place }}</div>
                                            <div class="text-[10px]">{{ $ag->date_range }}</div>
                                        </td>
                                        <td class="py-3 px-4 text-right space-x-2">
                                            <button class="text-gold-600 hover:text-gold-500 font-bold text-xs cursor-pointer" onclick="openEditAgendaModal({{ json_encode($ag) }})">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.agenda.delete', $ag->id) }}" class="delete-confirm-btn text-red-500 hover:text-red-400 font-bold text-xs" data-message="Apakah Anda yakin ingin menghapus agenda ini?">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $agendas->appends(request()->query())->links() }}
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: GALLERY ==================== -->
            <section id="tab-content-gallery" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-forest-900">Kelola Galeri Foto</h2>
                            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Tambahkan foto-foto pesona harmoni Bali ke dalam carousel geser beranda.</p>
                        </div>
                        <button class="px-5 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full transition text-xs flex items-center gap-1.5 shadow-sm cursor-pointer" onclick="openAddGalleryModal()">
                            <i class="fas fa-plus"></i> Tambah Foto Galeri
                        </button>
                    </div>

                    <!-- Gallery Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Foto</th>
                                    <th class="py-3 px-4">Judul (ID)</th>
                                    <th class="py-3 px-4">Kategori (ID)</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @foreach($galleries as $gal)
                                    <tr class="hover:bg-beige-50/50 transition">
                                        <td class="py-3 px-4">
                                            <img src="{{ $gal->image }}" class="w-16 h-10 object-cover rounded-lg border border-beige-200">
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-forest-900">{{ $gal->title_id }}</td>
                                        <td class="py-3 px-4 text-xs text-forest-700/70">{{ $gal->category_id }}</td>
                                        <td class="py-3 px-4 text-right space-x-2">
                                            <button class="text-gold-600 hover:text-gold-500 font-bold text-xs cursor-pointer" onclick="openEditGalleryModal({{ json_encode($gal) }})">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.gallery.delete', $gal->id) }}" class="delete-confirm-btn text-red-500 hover:text-red-400 font-bold text-xs" data-message="Apakah Anda yakin ingin menghapus foto ini?">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $galleries->appends(request()->query())->links() }}
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: AWARDEES ==================== -->
            <section id="tab-content-awardees" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-forest-900">Kelola Penerima Awards</h2>
                            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Kelola data Penerima THK Awards yang tampil di dropdown detail penghargaan.</p>
                        </div>
                    </div>

                    <!-- Search and Filters for Awardees -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-6 items-center justify-between border-b border-beige-100 pb-6">
                        <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                            <!-- Search Box -->
                            <div class="relative w-full sm:w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-forest-700/50">
                                    <i class="fas fa-search text-xs"></i>
                                </span>
                                <input type="text" id="awardee-search-input" placeholder="Cari nama penerima..." class="w-full bg-beige-50 border border-beige-300 rounded-xl pl-9 pr-4 py-2 text-xs focus:ring-1 focus:ring-gold-500 focus:border-gold-500 outline-none">
                            </div>
                            
                            <!-- Category Filter -->
                            <select id="awardee-category-filter" class="bg-beige-50 border border-beige-300 rounded-xl px-3 py-2 text-xs font-semibold text-forest-800 outline-none cursor-pointer focus:ring-1 focus:ring-gold-500">
                                <option value="">Semua Kategori</option>
                                <option value="desa-adat">Desa Adat</option>
                                <option value="akomodasi">Akomodasi</option>
                                <option value="destinasi">Destinasi</option>
                                <option value="restoran">Restoran</option>
                                <option value="pendidikan">Lembaga Pendidikan</option>
                            </select>

                            <!-- Medal Filter -->
                            <select id="awardee-medal-filter" class="bg-beige-50 border border-beige-300 rounded-xl px-3 py-2 text-xs font-semibold text-forest-800 outline-none cursor-pointer focus:ring-1 focus:ring-gold-500">
                                <option value="">Semua Medali</option>
                                <option value="Gold Award">Gold Award</option>
                                <option value="Silver Award">Silver Award</option>
                                <option value="Bronze Award">Bronze Award</option>
                            </select>

                            <!-- Year Filter -->
                            <select id="awardee-year-filter" class="bg-beige-50 border border-beige-300 rounded-xl px-3 py-2 text-xs font-semibold text-forest-800 outline-none cursor-pointer focus:ring-1 focus:ring-gold-500">
                                <option value="">Semua Tahun</option>
                                @foreach(\App\Models\Awardee::pluck('year')->unique()->sortDesc() as $y)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button class="px-5 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full transition text-xs flex items-center gap-1.5 shadow-sm cursor-pointer ml-auto" onclick="openAddAwardeeModal()">
                            <i class="fas fa-plus"></i> Tambah Penerima
                        </button>
                    </div>

                    <!-- Awardees Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Foto</th>
                                    <th class="py-3 px-4">Nama Penerima</th>
                                    <th class="py-3 px-4">Kategori</th>
                                    <th class="py-3 px-4">Penghargaan (Medali)</th>
                                    <th class="py-3 px-4">Tahun</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @foreach($awardees as $aw)
                                    <tr class="awardee-row hover:bg-beige-50/50 transition" data-name="{{ $aw->name }}" data-medal="{{ $aw->medal }}" data-year="{{ $aw->year }}" data-category="{{ $aw->category_key }}">
                                        <td class="py-3 px-4">
                                            <img src="{{ $aw->image }}" class="w-16 h-10 object-cover rounded-lg border border-beige-200">
                                        </td>
                                        <td class="py-3 px-4 font-semibold text-forest-900">{{ $aw->name }}</td>
                                        <td class="py-3 px-4 text-xs font-semibold text-forest-700">
                                            @if($aw->category_key === 'desa-adat') Desa Adat
                                            @elseif($aw->category_key === 'akomodasi') Akomodasi
                                            @elseif($aw->category_key === 'destinasi') Destinasi
                                            @elseif($aw->category_key === 'restoran') Restoran
                                            @elseif($aw->category_key === 'pendidikan') Lembaga Pendidikan
                                            @else {{ $aw->category_key }}
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-gold-500/10 text-gold-700 border border-gold-500/25">
                                                {{ $aw->medal }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-xs text-forest-700/70">{{ $aw->year }}</td>
                                        <td class="py-3 px-4 text-right space-x-2">
                                            <button class="text-gold-600 hover:text-gold-500 font-bold text-xs cursor-pointer" onclick="openEditAwardeeModal({{ json_encode($aw) }})">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.awardee.delete', $aw->id) }}" class="delete-confirm-btn text-red-500 hover:text-red-400 font-bold text-xs" data-message="Apakah Anda yakin ingin menghapus data penerima ini?">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $awardees->appends(request()->query())->links() }}
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: PROPOSALS ==================== -->
            <section id="tab-content-proposals" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="mb-6">
                        <h2 class="font-serif text-2xl font-bold text-forest-900">Kelola Pendaftaran Peserta & Proposal</h2>
                        <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Verifikasi berkas, ubah status evaluasi, atau hapus pendaftaran peserta secara permanen.</p>
                    </div>

                    <!-- Proposals Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Nama Peserta / Akun</th>
                                    <th class="py-3 px-4">Nama Lembaga / Instansi</th>
                                    <th class="py-3 px-4">Kategori Pendaftaran</th>
                                    <th class="py-3 px-4">Berkas Dokumen</th>
                                    <th class="py-3 px-4">Ubah Status Evaluasi</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @foreach($proposals as $prop)
                                    <tr class="hover:bg-beige-50/50 transition">
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-forest-900">{{ $prop->user ? $prop->user->name : 'N/A' }}</div>
                                            <div class="text-[10px] text-forest-700/50">{{ $prop->user ? $prop->user->email : 'N/A' }}</div>
                                        </td>
                                        <td class="py-3 px-4 font-medium text-forest-800">{{ $prop->institution_name }}</td>
                                        <td class="py-3 px-4 text-xs text-forest-700">
                                            <span class="bg-beige-50 border border-beige-300 rounded-md px-2 py-0.5 inline-block">
                                                {{ $prop->category }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-xs">
                                            @if($prop->file_path)
                                                <a href="{{ $prop->file_path }}" target="_blank" class="inline-flex items-center gap-1.5 text-gold-600 hover:text-gold-500 font-bold">
                                                    <i class="fas fa-file-pdf"></i> Lihat Berkas
                                                </a>
                                            @else
                                                <span class="text-red-500 font-medium">Belum Unggah</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <form action="{{ route('admin.proposal.status', $prop->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="bg-beige-50 border border-beige-300 rounded-xl px-2.5 py-1.5 text-xs font-semibold text-forest-800 outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 cursor-pointer">
                                                    <option value="Pengajuan" {{ $prop->status === 'Pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                                                    <option value="Verifikasi Admin" {{ $prop->status === 'Verifikasi Admin' ? 'selected' : '' }}>Verifikasi Admin</option>
                                                    <option value="Penilaian Lapangan" {{ $prop->status === 'Penilaian Lapangan' ? 'selected' : '' }}>Penilaian Lapangan</option>
                                                    <option value="Hasil Penilaian" {{ $prop->status === 'Hasil Penilaian' ? 'selected' : '' }}>Hasil Penilaian</option>
                                                    <option value="Penghargaan" {{ $prop->status === 'Penghargaan' ? 'selected' : '' }}>Penghargaan</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="py-3 px-4 text-right flex items-center justify-end">
                                            <button onclick="openAdminProposalDetail({{ json_encode($prop) }})" class="text-gold-600 hover:text-gold-500 font-bold text-xs mr-3 cursor-pointer">
                                                Detail
                                            </button>
                                            <a href="{{ route('admin.proposal.delete', $prop->id) }}" class="delete-confirm-btn text-red-500 hover:text-red-400 font-bold text-xs" data-message="PERHATIAN: Menghapus pendaftaran ini juga akan menghapus akun peserta (login) secara permanen di database. Apakah Anda yakin?">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-6">
                        {{ $proposals->appends(request()->query())->links() }}
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: PAYMENT ==================== -->
            <section id="tab-content-payment" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="mb-6">
                        <h2 class="font-serif text-2xl font-bold text-forest-900">Informasi Pembayaran Pendaftaran</h2>
                        <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Atur rekening bank, jumlah biaya pendaftaran, dan QR Code yang akan ditampilkan kepada calon peserta sebelum mengisi form pendaftaran.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left: Edit Form -->
                        <div>
                            <form action="{{ route('admin.payment.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Nama Bank</label>
                                    <input type="text" name="bank_name" value="{{ $paymentSetting->bank_name ?? 'BPD Bali' }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition" placeholder="Contoh: BPD Bali">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Nomor Rekening</label>
                                    <input type="text" name="account_number" value="{{ $paymentSetting->account_number ?? '009.02.12.00001-1' }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition" placeholder="Contoh: 009.02.12.00001-1">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Nama Pemilik Rekening / Atas Nama</label>
                                    <input type="text" name="account_name" value="{{ $paymentSetting->account_name ?? 'Yayasan THK Bali' }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition" placeholder="Contoh: Yayasan THK Bali">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Jumlah Biaya Pendaftaran</label>
                                    <input type="text" name="amount" value="{{ $paymentSetting->amount ?? 'Rp 500.000' }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition" placeholder="Contoh: Rp 500.000">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Catatan / Instruksi Transfer <span class="text-[10px] text-forest-700/50 font-normal">(Opsional)</span></label>
                                    <textarea name="description" rows="3" class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition" placeholder="Contoh: Transfer dengan mencantumkan nama instansi sebagai berita transfer.">{{ $paymentSetting->description ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Unggah / Ganti QR Code Pembayaran <span class="text-[10px] text-forest-700/50 font-normal">(JPG/PNG max 3MB)</span></label>
                                    <input type="file" name="qr_image" accept="image/*" class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-2 text-xs cursor-pointer">
                                </div>
                                <div class="pt-2">
                                    <button type="submit" class="px-6 py-3 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-sm shadow-sm cursor-pointer transition">
                                        <i class="fas fa-save mr-1.5"></i> Simpan Informasi Pembayaran
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Right: Preview -->
                        <div class="bg-beige-50 rounded-3xl border border-beige-200 p-6 flex flex-col items-center gap-5">
                            <h3 class="text-sm font-bold text-forest-900 uppercase tracking-wider text-center">Preview Tampilan di Form Pendaftaran</h3>

                            @if($paymentSetting->qr_image)
                                <div class="bg-white rounded-2xl p-3 shadow-sm border border-beige-200">
                                    <img src="{{ asset($paymentSetting->qr_image) }}" alt="QR Pembayaran" class="w-36 h-36 object-contain rounded-xl">
                                </div>
                            @else
                                <div class="bg-white rounded-2xl p-3 border-2 border-dashed border-beige-300 flex flex-col items-center justify-center w-36 h-36 text-center">
                                    <i class="fas fa-qrcode text-3xl text-beige-400 mb-1"></i>
                                    <span class="text-[10px] text-beige-500">Belum ada QR</span>
                                </div>
                            @endif

                            <div class="w-full text-center space-y-2 bg-white rounded-2xl p-4 border border-beige-200">
                                <div class="text-xs text-forest-700/60 font-bold uppercase tracking-widest">Transfer ke:</div>
                                <div class="text-xl font-black text-forest-900">{{ $paymentSetting->bank_name ?? 'BPD Bali' }}</div>
                                <div class="text-2xl font-black text-gold-600 tracking-widest">{{ $paymentSetting->account_number ?? '009.02.12.00001-1' }}</div>
                                <div class="text-sm font-semibold text-forest-700">a/n {{ $paymentSetting->account_name ?? 'Yayasan THK Bali' }}</div>
                                <div class="mt-2 py-1.5 px-3 bg-gold-100 rounded-xl border border-gold-300">
                                    <span class="text-xs font-bold text-gold-700">Biaya Pendaftaran: <span class="text-base text-gold-600">{{ $paymentSetting->amount ?? 'Rp 500.000' }}</span></span>
                                </div>
                                @if($paymentSetting->description)
                                    <p class="text-[10px] text-forest-700/60 leading-snug">{{ $paymentSetting->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== TAB: WEB SETTINGS ==================== -->
            <section id="tab-content-websetting" class="tab-pane hidden">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="mb-6">
                        <h2 class="font-serif text-2xl font-bold text-forest-900">Pengaturan Web</h2>
                        <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Atur logo website dan nama instansi/organisasi utama.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left: Edit Form -->
                        <div>
                            <form action="{{ route('admin.websetting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                                @csrf
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Nama Website / Organisasi</label>
                                    <input type="text" name="website_name" value="{{ $webSetting->website_name ?? 'THK Bali' }}" required class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-3 text-sm focus:border-gold-500 focus:ring-1 focus:ring-gold-500/20 outline-none transition" placeholder="Contoh: THK Bali">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-forest-700 mb-2">Unggah / Ganti Logo Website <span class="text-[10px] text-forest-700/50 font-normal">(JPG/PNG/SVG max 2MB)</span></label>
                                    <input type="file" name="logo_image" accept="image/*,.svg" class="w-full bg-beige-50 border border-beige-300 rounded-2xl px-4 py-2 text-xs cursor-pointer">
                                </div>
                                <div class="pt-2">
                                    <button type="submit" class="px-6 py-3 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-sm shadow-sm cursor-pointer transition">
                                        <i class="fas fa-save mr-1.5"></i> Simpan Pengaturan Web
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Right: Preview -->
                        <div class="bg-beige-50 rounded-3xl border border-beige-200 p-6 flex flex-col items-center justify-center gap-5 min-h-[300px]">
                            <h3 class="text-sm font-bold text-forest-900 uppercase tracking-wider text-center">Preview Logo Website Terpasang</h3>

                            @if($webSetting->logo_path)
                                <div class="bg-white rounded-2xl p-4 shadow-sm border border-beige-200 flex items-center justify-center">
                                    <img src="{{ asset($webSetting->logo_path) }}" alt="Logo Website" class="max-w-[150px] max-h-[150px] object-contain rounded-xl">
                                </div>
                                <div class="text-xs text-forest-500 font-medium">Path: <code class="bg-beige-100 px-2 py-1 rounded text-forest-950">{{ $webSetting->logo_path }}</code></div>
                            @else
                                <div class="bg-white rounded-2xl p-4 border-2 border-dashed border-beige-300 flex flex-col items-center justify-center w-36 h-36 text-center">
                                    <!-- Fallback svg -->
                                    <svg class="w-16 h-16 text-gold-500 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="9" r="6" stroke="currentColor" />
                                        <circle cx="8" cy="15" r="6" stroke="currentColor" />
                                        <circle cx="16" cy="15" r="6" stroke="currentColor" />
                                    </svg>
                                    <span class="text-[10px] text-beige-500">Logo Bawaan (SVG)</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- ==================== NEWS FORM OVERLAY MODAL ==================== -->
    <div id="modal-news" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-2xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <h3 id="news-modal-title-label" class="font-serif text-xl font-bold text-forest-900 mb-6">Tambah Berita Pilihan</h3>
            
            <form id="form-news" action="{{ route('admin.news.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Judul Berita (ID)</label>
                        <input type="text" id="news-title-id" name="title_id" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-sm">
                    </div>
                    <input type="hidden" id="news-title-en" name="title_en">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Kategori (ID)</label>
                        <input type="text" id="news-category-id" name="category_id" required placeholder="Contoh: Filosofi" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-sm">
                    </div>
                    <input type="hidden" id="news-category-en" name="category_en">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Tanggal</label>
                        <input type="text" id="news-date" name="date" required placeholder="Contoh: 12 Jun 2026" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Jumlah Pengunjung (Views)</label>
                        <input type="number" id="news-views" name="views" min="0" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Gambar Pendukung</label>
                        <input type="file" name="image_file" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Konten Paragraph (ID) <span class="text-[10px] text-forest-700/50 font-normal">(Tekan Enter untuk membuat paragraf baru)</span></label>
                    <textarea id="news-content-id" name="content_id" rows="6" required class="w-full bg-beige-50 border border-beige-300 rounded-xl p-3 text-sm"></textarea>
                </div>
                <textarea id="news-content-en" name="content_en" class="hidden"></textarea>

                <div class="flex justify-end gap-3 pt-4 border-t border-beige-200">
                    <button type="button" class="px-5 py-2.5 rounded-full border border-beige-300 text-forest-700 text-xs font-semibold cursor-pointer" onclick="closeNewsModal()">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-xs shadow-sm cursor-pointer">Simpan Berita</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== ASSESSOR FORM OVERLAY MODAL ==================== -->
    <div id="modal-assessor" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-lg w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <h3 id="assessor-modal-title-label" class="font-serif text-xl font-bold text-forest-900 mb-6">Tambah Asesor Baru</h3>
            
            <form id="form-assessor" action="{{ route('admin.assessor.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Nama Asesor & Gelar Lengkap</label>
                    <input type="text" id="ass-name" name="name" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Spesialisasi & Posisi</label>
                    <input type="text" id="ass-title" name="title" required placeholder="Contoh: Asesor Bidang Adat & Budaya" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Link Instagram</label>
                        <input type="url" id="ass-ig" name="instagram" placeholder="https://instagram.com/username" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Link Facebook</label>
                        <input type="url" id="ass-fb" name="facebook" placeholder="https://facebook.com/username" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Link LinkedIn</label>
                        <input type="url" id="ass-li" name="linkedin" placeholder="https://linkedin.com/in/username" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Link Website Pribadi</label>
                        <input type="url" id="ass-web" name="website" placeholder="https://website.com" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Foto Profil</label>
                    <input type="file" name="image_file" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-beige-200">
                    <button type="button" class="px-5 py-2.5 rounded-full border border-beige-300 text-forest-700 text-xs font-semibold cursor-pointer" onclick="closeAssessorModal()">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-xs shadow-sm cursor-pointer">Simpan Asesor</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== AGENDA FORM OVERLAY MODAL ==================== -->
    <div id="modal-agenda" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-2xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <h3 id="agenda-modal-title-label" class="font-serif text-xl font-bold text-forest-900 mb-6">Tambah Agenda Baru</h3>
            
            <form id="form-agenda" action="{{ route('admin.agenda.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Judul Agenda</label>
                        <input type="text" id="ag-title" name="title" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Kontributor</label>
                        <input type="text" id="ag-contributor" name="contributor" required placeholder="Contoh: Ni Putu Veny Narlanti, S.S., M.Hum." class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Rentang Tanggal</label>
                        <input type="text" id="ag-date" name="date_range" required placeholder="Contoh: Selasa, 04 Februari 2025 s/d Jumat, 28 Februari 2025" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Pukul</label>
                        <input type="text" id="ag-time" name="time" required placeholder="Contoh: 00.00 atau 09.00 WITA" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Tempat</label>
                        <input type="text" id="ag-place" name="place" required placeholder="Contoh: Denpasar Institute" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Jumlah Pengunjung (Views)</label>
                        <input type="number" id="ag-views" name="views" min="0" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Flyer / Brosur Gambar</label>
                        <input type="file" name="image_file" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Deskripsi Detail Agenda</label>
                    <textarea id="ag-desc" name="description" rows="8" required placeholder="Masukkan materi, ketentuan, manfaat, dan narahubung agenda secara detail..." class="w-full bg-beige-50 border border-beige-300 rounded-xl p-3 text-sm"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-beige-200">
                    <button type="button" class="px-5 py-2.5 rounded-full border border-beige-300 text-forest-700 text-xs font-semibold cursor-pointer" onclick="closeAgendaModal()">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-xs shadow-sm cursor-pointer">Simpan Agenda</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== GALLERY FORM OVERLAY MODAL ==================== -->
    <div id="modal-gallery" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-md w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <h3 id="gallery-modal-title-label" class="font-serif text-xl font-bold text-forest-900 mb-6">Tambah Foto Galeri</h3>
            
            <form id="form-gallery" action="{{ route('admin.gallery.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Judul Foto (ID)</label>
                    <input type="text" id="gal-title-id" name="title_id" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                </div>
                <input type="hidden" id="gal-title-en" name="title_en">
                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Kategori Pilar (ID)</label>
                    <input type="text" id="gal-category-id" name="category_id" required placeholder="Contoh: Parahyangan" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                </div>
                <input type="hidden" id="gal-category-en" name="category_en">
                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Unggah Foto</label>
                    <input type="file" name="image_file" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-xs">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-beige-200">
                    <button type="button" class="px-5 py-2.5 rounded-full border border-beige-300 text-forest-700 text-xs font-semibold cursor-pointer" onclick="closeGalleryModal()">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-xs shadow-sm cursor-pointer">Simpan Foto</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== AWARDEE FORM OVERLAY MODAL ==================== -->
    <div id="modal-awardee" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto">
            <h3 id="awardee-modal-title-label" class="font-serif text-xl font-bold text-forest-900 mb-6">Tambah Penerima Awards</h3>
            
            <form id="form-awardee" action="{{ route('admin.awardee.save') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-left">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Nama Penerima</label>
                        <input type="text" id="aw-name" name="name" required placeholder="Contoh: Desa Adat Ubud / Maya Resort" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Kategori</label>
                        <select id="aw-category-key" name="category_key" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                            <option value="desa-adat">Desa Adat</option>
                            <option value="akomodasi">Akomodasi</option>
                            <option value="destinasi">Destinasi</option>
                            <option value="restoran">Restoran</option>
                            <option value="pendidikan">Lembaga Pendidikan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Tingkat Medali (Penghargaan)</label>
                        <select id="aw-medal" name="medal" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                            <option value="Gold Award">Gold Award</option>
                            <option value="Silver Award">Silver Award</option>
                            <option value="Bronze Award">Bronze Award</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Tahun Penghargaan</label>
                        <input type="text" id="aw-year" name="year" required placeholder="Contoh: 2026" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-forest-700 mb-1">Unggah Foto / Logo</label>
                        <input type="file" name="image_file" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2 text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-forest-700 mb-1">Deskripsi Umum Penerima</label>
                    <textarea id="aw-desc" name="description" required rows="3" placeholder="Tuliskan latar belakang singkat dan keunikan penerima..." class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm"></textarea>
                </div>

                <div class="border-t border-beige-100 pt-3 space-y-3">
                    <span class="text-xs font-bold text-forest-900 block">Rincian Pencapaian per Pilar THK (Realtime Detail):</span>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-forest-700 mb-1">1. Parahyangan (Hubungan dengan Tuhan)</label>
                            <input type="text" id="aw-parahyangan" name="parahyangan_achievement" placeholder="Contoh: Upacara ritual dan pelestarian kesucian Pura..." class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-forest-700 mb-1">2. Pawongan (Hubungan dengan Manusia)</label>
                            <input type="text" id="aw-pawongan" name="pawongan_achievement" placeholder="Contoh: Sistem pembagian tugas adat dan kerukunan banjar..." class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-forest-700 mb-1">3. Palemahan (Hubungan dengan Alam)</label>
                            <input type="text" id="aw-palemahan" name="palemahan_achievement" placeholder="Contoh: Hutan adat lindung dan sistem irigasi Subak..." class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-sm">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-beige-200">
                    <button type="button" class="px-5 py-2.5 rounded-full border border-beige-300 text-forest-700 text-xs font-semibold cursor-pointer" onclick="closeAwardeeModal()">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold rounded-full text-xs shadow-sm cursor-pointer">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== ADMIN PROPOSAL DETAIL MODAL ==================== -->
    <div id="modal-admin-proposal-detail" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-2xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto relative flex flex-col">
            <button onclick="closeAdminProposalDetail()" class="absolute top-4 right-4 p-2 text-forest-400 hover:text-forest-950 rounded-full transition cursor-pointer" aria-label="Tutup">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="font-serif text-xl font-bold text-forest-900 mb-6">Detail Pendaftaran & Dokumen</h3>
            
            <div class="space-y-6 text-sm">
                <!-- Section 1: Informasi Instansi -->
                <div class="bg-beige-50/50 p-4 rounded-2xl border border-beige-200/50">
                    <h4 class="font-bold text-forest-900 border-b border-beige-200 pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-building text-gold-600 mr-1.5"></i> Profil Instansi / Perusahaan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-4 text-xs md:text-sm">
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Nama Instansi</span>
                            <strong id="det-inst-name" class="text-forest-900">-</strong>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Kategori Penghargaan</span>
                            <strong id="det-inst-cat" class="text-forest-900">-</strong>
                        </div>
                        <div class="md:col-span-2">
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Alamat Lengkap</span>
                            <strong id="det-inst-address" class="text-forest-900">-</strong>
                        </div>
                        <div class="md:col-span-2">
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Link Google Maps</span>
                            <a id="det-inst-gmaps" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Informasi Kontak Person -->
                <div class="bg-beige-50/50 p-4 rounded-2xl border border-beige-200/50">
                    <h4 class="font-bold text-forest-900 border-b border-beige-200 pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-address-book text-gold-600 mr-1.5"></i> Kontak Person (CP)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs md:text-sm">
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Nama CP</span>
                            <strong id="det-cp-name" class="text-forest-900">-</strong>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">WhatsApp CP</span>
                            <a id="det-cp-wa" href="#" target="_blank" class="text-gold-600 font-bold hover:underline">-</a>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Email CP</span>
                            <a id="det-cp-email" href="#" class="text-gold-600 font-bold hover:underline">-</a>
                        </div>
                    </div>
                </div>

                <!-- Section: Struktur Tim THK -->
                <div class="bg-beige-50/50 p-4 rounded-2xl border border-beige-200/50">
                    <h4 class="font-bold text-forest-900 border-b border-beige-200 pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-users text-gold-600 mr-1.5"></i> Struktur Tim THK Perusahaan / Lembaga
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-4 text-xs md:text-sm">
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Ketua Tim THK</span>
                            <span id="det-thk-leader" class="text-forest-900 font-semibold">-</span>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">PIC Parahyangan</span>
                            <span id="det-pic-parahyangan" class="text-forest-900 font-semibold">-</span>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">PIC Pawongan</span>
                            <span id="det-pic-pawongan" class="text-forest-900 font-semibold">-</span>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">PIC Palemahan</span>
                            <span id="det-pic-palemahan" class="text-forest-900 font-semibold">-</span>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Unggahan Berkas -->
                <div class="bg-beige-50/50 p-4 rounded-2xl border border-beige-200/50">
                    <h4 class="font-bold text-forest-900 border-b border-beige-200 pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-file-archive text-gold-600 mr-1.5"></i> Berkas Pendukung & Bukti Pembayaran
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs md:text-sm">
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Berkas Sertifikasi</span>
                            <a id="det-file-proposal" href="#" target="_blank" class="text-gold-600 font-bold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-file-pdf"></i> Lihat Berkas
                            </a>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Bukti Pembayaran</span>
                            <a id="det-file-payment" href="#" target="_blank" class="text-gold-600 font-bold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-file-invoice-dollar"></i> Lihat Bukti
                            </a>
                            <span id="det-file-payment-empty" class="text-red-500 font-medium hidden">Belum Unggah</span>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Akreditasi Sebelumnya</span>
                            <a id="det-file-accred" href="#" target="_blank" class="text-gold-600 font-bold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-medal"></i> Lihat Hasil
                            </a>
                            <span id="det-file-accred-empty" class="text-red-500 font-medium hidden">Belum Unggah</span>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Tautan Dokumen Pilar THK -->
                <div class="bg-beige-50/50 p-4 rounded-2xl border border-beige-200/50">
                    <h4 class="font-bold text-forest-900 border-b border-beige-200 pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-link text-gold-600 mr-1.5"></i> Tautan Dokumen Pilar Filosofis
                    </h4>
                    <div class="space-y-3 text-xs md:text-sm">
                        <div class="flex items-center justify-between border-b border-beige-100 pb-1.5">
                            <span class="text-forest-800 font-medium">Link Bidang Parahyangan:</span>
                            <a id="det-link-parahyangan" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                        <div class="flex items-center justify-between border-b border-beige-100 pb-1.5">
                            <span class="text-forest-800 font-medium">Link Bidang Pawongan:</span>
                            <a id="det-link-pawongan" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                        <div class="flex items-center justify-between pb-0.5">
                            <span class="text-forest-800 font-medium">Link Bidang Palemahan:</span>
                            <a id="det-link-palemahan" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button onclick="closeAdminProposalDetail()" class="px-6 py-2 bg-forest-900 text-white rounded-full text-xs font-bold hover:bg-forest-950 transition cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript block for tabs toggle and edit actions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Tab switcher
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabId = btn.getAttribute('data-tab-id');
                    localStorage.setItem('admin-active-tab', tabId);
                    
                    tabButtons.forEach(b => b.classList.remove('active-tab-btn', 'bg-white/5', 'text-gold-400'));
                    btn.classList.add('active-tab-btn', 'bg-white/5', 'text-gold-400');

                    tabPanes.forEach(pane => {
                        if (pane.id === `tab-content-${tabId}`) {
                            pane.classList.remove('hidden');
                        } else {
                            pane.classList.add('hidden');
                        }
                    });
                });
            });

            // Initialize Summernote Lite on textareas
            $('#news-content-id').summernote({
                placeholder: 'Masukkan konten berita secara detail...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#ag-desc').summernote({
                placeholder: 'Masukkan materi, ketentuan, manfaat, dan narahubung agenda secara detail...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Restore active tab from localStorage if exists
            const activeTabId = localStorage.getItem('admin-active-tab');
            if (activeTabId) {
                const activeBtn = document.querySelector(`.tab-btn[data-tab-id="${activeTabId}"]`);
                if (activeBtn) {
                    activeBtn.click();
                }
            }
        });

        // 5. Admin Proposal Detail Helpers
        const modalAdminPropDetail = document.getElementById('modal-admin-proposal-detail');
        function openAdminProposalDetail(item) {
            if (!modalAdminPropDetail) return;
            
            document.getElementById('det-inst-name').textContent = item.institution_name || '-';
            document.getElementById('det-inst-cat').textContent = item.category || '-';
            document.getElementById('det-inst-address').textContent = item.address || '-';
            
            const gmapsEl = document.getElementById('det-inst-gmaps');
            if (item.gmaps_link) {
                gmapsEl.href = item.gmaps_link;
                gmapsEl.textContent = item.gmaps_link;
                gmapsEl.classList.remove('hidden');
            } else {
                gmapsEl.href = '#';
                gmapsEl.textContent = 'Tidak Ada';
            }

            document.getElementById('det-cp-name').textContent = item.contact_name || '-';
            
            const cpWa = document.getElementById('det-cp-wa');
            if (item.contact_wa) {
                cpWa.href = `https://wa.me/${item.contact_wa.replace(/[^0-9]/g, '')}`;
                cpWa.textContent = item.contact_wa;
            } else {
                cpWa.href = '#';
                cpWa.textContent = '-';
            }

            const cpEmail = document.getElementById('det-cp-email');
            if (item.contact_email) {
                cpEmail.href = `mailto:${item.contact_email}`;
                cpEmail.textContent = item.contact_email;
            } else {
                cpEmail.href = '#';
                cpEmail.textContent = '-';
            }

            const thkLeaderEl = document.getElementById('det-thk-leader');
            if (thkLeaderEl) {
                const name = item.thk_leader_name || '-';
                const wa = item.thk_leader_wa ? ` (${item.thk_leader_wa})` : '';
                thkLeaderEl.textContent = name + wa;
            }
            const picParahEl = document.getElementById('det-pic-parahyangan');
            if (picParahEl) {
                const name = item.pic_parahyangan_name || '-';
                const wa = item.pic_parahyangan_wa ? ` (${item.pic_parahyangan_wa})` : '';
                picParahEl.textContent = name + wa;
            }
            const picPawoEl = document.getElementById('det-pic-pawongan');
            if (picPawoEl) {
                const name = item.pic_pawongan_name || '-';
                const wa = item.pic_pawongan_wa ? ` (${item.pic_pawongan_wa})` : '';
                picPawoEl.textContent = name + wa;
            }
            const picPalemEl = document.getElementById('det-pic-palemahan');
            if (picPalemEl) {
                const name = item.pic_palemahan_name || '-';
                const wa = item.pic_palemahan_wa ? ` (${item.pic_palemahan_wa})` : '';
                picPalemEl.textContent = name + wa;
            }

            document.getElementById('det-file-proposal').href = item.file_path || '#';
            
            const filePayment = document.getElementById('det-file-payment');
            const filePaymentEmpty = document.getElementById('det-file-payment-empty');
            if (item.payment_proof) {
                filePayment.href = item.payment_proof;
                filePayment.classList.remove('hidden');
                filePaymentEmpty.classList.add('hidden');
            } else {
                filePayment.classList.add('hidden');
                filePaymentEmpty.classList.remove('hidden');
            }

            const fileAccred = document.getElementById('det-file-accred');
            const fileAccredEmpty = document.getElementById('det-file-accred-empty');
            if (item.prev_accreditation) {
                fileAccred.href = item.prev_accreditation;
                fileAccred.classList.remove('hidden');
                fileAccredEmpty.classList.add('hidden');
            } else {
                fileAccred.classList.add('hidden');
                fileAccredEmpty.classList.remove('hidden');
            }

            const formatLink = (lnk) => {
                if (!lnk) return '#';
                if (!lnk.startsWith('http://') && !lnk.startsWith('https://')) {
                    return 'https://' + lnk;
                }
                return lnk;
            };

            const linkParah = document.getElementById('det-link-parahyangan');
            linkParah.href = formatLink(item.link_parahyangan);
            linkParah.textContent = item.link_parahyangan || '-';

            const linkPawo = document.getElementById('det-link-pawongan');
            linkPawo.href = formatLink(item.link_pawongan);
            linkPawo.textContent = item.link_pawongan || '-';

            const linkPalem = document.getElementById('det-link-palemahan');
            linkPalem.href = formatLink(item.link_palemahan);
            linkPalem.textContent = item.link_palemahan || '-';

            modalAdminPropDetail.classList.remove('hidden');
            modalAdminPropDetail.classList.add('flex');
        }
        function closeAdminProposalDetail() {
            if (!modalAdminPropDetail) return;
            modalAdminPropDetail.classList.add('hidden');
            modalAdminPropDetail.classList.remove('flex');
        }

        // 1. News Modal Helpers
        const modalNews = document.getElementById('modal-news');
        const formNews = document.getElementById('form-news');
        function openAddNewsModal() {
            document.getElementById('news-modal-title-label').textContent = 'Tambah Berita Pilihan Baru';
            formNews.action = "{{ route('admin.news.save') }}";
            document.getElementById('news-title-id').value = '';
            document.getElementById('news-title-en').value = '';
            document.getElementById('news-category-id').value = '';
            document.getElementById('news-category-en').value = '';
            document.getElementById('news-date').value = '';
            document.getElementById('news-views').value = '0';
            $('#news-content-id').summernote('code', '');
            document.getElementById('news-content-en').value = '';
            modalNews.classList.remove('hidden');
            modalNews.classList.add('flex');
        }
        function openEditNewsModal(item) {
            document.getElementById('news-modal-title-label').textContent = 'Edit Berita Pilihan';
            formNews.action = `/admin/news/save/${item.id}`;
            document.getElementById('news-title-id').value = item.title_id;
            document.getElementById('news-title-en').value = item.title_en;
            document.getElementById('news-category-id').value = item.category_id;
            document.getElementById('news-category-en').value = item.category_en;
            document.getElementById('news-date').value = item.date;
            document.getElementById('news-views').value = item.views || 0;
            $('#news-content-id').summernote('code', item.content_id.join('\n'));
            document.getElementById('news-content-en').value = item.content_en.join('\n');
            modalNews.classList.remove('hidden');
            modalNews.classList.add('flex');
        }
        function closeNewsModal() {
            modalNews.classList.add('hidden');
            modalNews.classList.remove('flex');
        }

        // 2. Assessor Modal Helpers
        const modalAssessor = document.getElementById('modal-assessor');
        const formAssessor = document.getElementById('form-assessor');
        function openAddAssessorModal() {
            document.getElementById('assessor-modal-title-label').textContent = 'Tambah Asesor Baru';
            formAssessor.action = "{{ route('admin.assessor.save') }}";
            document.getElementById('ass-name').value = '';
            document.getElementById('ass-title').value = '';
            document.getElementById('ass-ig').value = '';
            document.getElementById('ass-fb').value = '';
            document.getElementById('ass-li').value = '';
            document.getElementById('ass-web').value = '';
            modalAssessor.classList.remove('hidden');
            modalAssessor.classList.add('flex');
        }
        function openEditAssessorModal(item) {
            document.getElementById('assessor-modal-title-label').textContent = 'Edit Asesor';
            formAssessor.action = `/admin/assessor/save/${item.id}`;
            document.getElementById('ass-name').value = item.name;
            document.getElementById('ass-title').value = item.title;
            document.getElementById('ass-ig').value = item.instagram || '';
            document.getElementById('ass-fb').value = item.facebook || '';
            document.getElementById('ass-li').value = item.linkedin || '';
            document.getElementById('ass-web').value = item.website || '';
            modalAssessor.classList.remove('hidden');
            modalAssessor.classList.add('flex');
        }
        function closeAssessorModal() {
            modalAssessor.classList.add('hidden');
            modalAssessor.classList.remove('flex');
        }

        // 3. Agenda Modal Helpers
        const modalAgenda = document.getElementById('modal-agenda');
        const formAgenda = document.getElementById('form-agenda');
        function openAddAgendaModal() {
            document.getElementById('agenda-modal-title-label').textContent = 'Tambah Agenda Baru';
            formAgenda.action = "{{ route('admin.agenda.save') }}";
            document.getElementById('ag-title').value = '';
            document.getElementById('ag-contributor').value = '';
            document.getElementById('ag-date').value = '';
            document.getElementById('ag-time').value = '';
            document.getElementById('ag-place').value = '';
            document.getElementById('ag-views').value = '0';
            $('#ag-desc').summernote('code', '');
            modalAgenda.classList.remove('hidden');
            modalAgenda.classList.add('flex');
        }
        function openEditAgendaModal(item) {
            document.getElementById('agenda-modal-title-label').textContent = 'Edit Agenda';
            formAgenda.action = `/admin/agenda/save/${item.id}`;
            document.getElementById('ag-title').value = item.title;
            document.getElementById('ag-contributor').value = item.contributor;
            document.getElementById('ag-date').value = item.date_range;
            document.getElementById('ag-time').value = item.time;
            document.getElementById('ag-place').value = item.place;
            document.getElementById('ag-views').value = item.views || 0;
            $('#ag-desc').summernote('code', item.description);
            modalAgenda.classList.remove('hidden');
            modalAgenda.classList.add('flex');
        }
        function closeAgendaModal() {
            modalAgenda.classList.add('hidden');
            modalAgenda.classList.remove('flex');
        }

        // 4. Gallery Modal Helpers
        const modalGallery = document.getElementById('modal-gallery');
        const formGallery = document.getElementById('form-gallery');
        function openAddGalleryModal() {
            document.getElementById('gallery-modal-title-label').textContent = 'Tambah Foto Galeri Baru';
            formGallery.action = "{{ route('admin.gallery.save') }}";
            document.getElementById('gal-title-id').value = '';
            document.getElementById('gal-title-en').value = '';
            document.getElementById('gal-category-id').value = '';
            document.getElementById('gal-category-en').value = '';
            modalGallery.classList.remove('hidden');
            modalGallery.classList.add('flex');
        }
        function openEditGalleryModal(item) {
            document.getElementById('gallery-modal-title-label').textContent = 'Edit Foto Galeri';
            formGallery.action = `/admin/gallery/save/${item.id}`;
            document.getElementById('gal-title-id').value = item.title_id;
            document.getElementById('gal-title-en').value = item.title_en;
            document.getElementById('gal-category-id').value = item.category_id;
            document.getElementById('gal-category-en').value = item.category_en;
            modalGallery.classList.remove('hidden');
            modalGallery.classList.add('flex');
        }
        function closeGalleryModal() {
            modalGallery.classList.add('hidden');
            modalGallery.classList.remove('flex');
        }

        // 5. Awardee Modal Helpers
        const modalAwardee = document.getElementById('modal-awardee');
        const formAwardee = document.getElementById('form-awardee');
        function openAddAwardeeModal() {
            document.getElementById('awardee-modal-title-label').textContent = 'Tambah Penerima Awards Baru';
            formAwardee.action = "{{ route('admin.awardee.save') }}";
            document.getElementById('aw-name').value = '';
            document.getElementById('aw-category-key').value = 'desa-adat';
            document.getElementById('aw-medal').value = 'Gold Award';
            document.getElementById('aw-year').value = '2026';
            document.getElementById('aw-desc').value = '';
            document.getElementById('aw-parahyangan').value = '';
            document.getElementById('aw-pawongan').value = '';
            document.getElementById('aw-palemahan').value = '';
            modalAwardee.classList.remove('hidden');
            modalAwardee.classList.add('flex');
        }
        function openEditAwardeeModal(item) {
            document.getElementById('awardee-modal-title-label').textContent = 'Edit Penerima Awards';
            formAwardee.action = `/admin/awardee/save/${item.id}`;
            document.getElementById('aw-name').value = item.name;
            document.getElementById('aw-category-key').value = item.category_key || 'desa-adat';
            document.getElementById('aw-medal').value = item.medal;
            document.getElementById('aw-year').value = item.year;
            document.getElementById('aw-desc').value = item.description;
            document.getElementById('aw-parahyangan').value = item.parahyangan_achievement || '';
            document.getElementById('aw-pawongan').value = item.pawongan_achievement || '';
            document.getElementById('aw-palemahan').value = item.palemahan_achievement || '';
            modalAwardee.classList.remove('hidden');
            modalAwardee.classList.add('flex');
        }
        function closeAwardeeModal() {
            modalAwardee.classList.add('hidden');
            modalAwardee.classList.remove('flex');
        }

        // 6. Awardee/Penerima Filter Helpers
        const searchInput = document.getElementById('awardee-search-input');
        const categoryFilter = document.getElementById('awardee-category-filter');
        const medalFilter = document.getElementById('awardee-medal-filter');
        const yearFilter = document.getElementById('awardee-year-filter');
        const tableRows = document.querySelectorAll('.awardee-row');

        function filterAwardees() {
            const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';
            const selectedCategory = categoryFilter ? categoryFilter.value : '';
            const selectedMedal = medalFilter ? medalFilter.value : '';
            const selectedYear = yearFilter ? yearFilter.value : '';

            tableRows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                const category = row.getAttribute('data-category');
                const medal = row.getAttribute('data-medal');
                const year = row.getAttribute('data-year');

                const matchesSearch = name.includes(searchQuery);
                const matchesCategory = !selectedCategory || category === selectedCategory;
                const matchesMedal = !selectedMedal || medal === selectedMedal;
                const matchesYear = !selectedYear || year === selectedYear;

                if (matchesSearch && matchesCategory && matchesMedal && matchesYear) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        }

        if (searchInput) searchInput.addEventListener('input', filterAwardees);
        if (categoryFilter) categoryFilter.addEventListener('change', filterAwardees);
        if (medalFilter) medalFilter.addEventListener('change', filterAwardees);
        if (yearFilter) yearFilter.addEventListener('change', filterAwardees);

        // 7. Reusable Custom Confirmation Modal JS
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.delete-confirm-btn');
            if (btn) {
                e.preventDefault();
                const url = btn.getAttribute('href');
                const message = btn.getAttribute('data-message') || 'Apakah Anda yakin ingin menghapus data ini?';
                
                const modal = document.getElementById('confirm-delete-modal');
                const msgEl = document.getElementById('confirm-delete-message');
                const confirmLink = document.getElementById('btn-confirm-delete-link');
                
                if (modal && msgEl && confirmLink) {
                    msgEl.textContent = message;
                    confirmLink.setAttribute('href', url);
                    
                    // Show modal with animation
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    setTimeout(() => {
                        modal.classList.remove('opacity-0');
                        modal.classList.add('opacity-100');
                        modal.querySelector('.modal-box').classList.remove('scale-95', 'opacity-0');
                        modal.querySelector('.modal-box').classList.add('scale-100', 'opacity-100');
                    }, 10);
                }
            }
        });

        const cancelDeleteBtn = document.getElementById('btn-cancel-delete');
        if (cancelDeleteBtn) {
            cancelDeleteBtn.addEventListener('click', () => {
                closeDeleteModal();
            });
        }

        const deleteModal = document.getElementById('confirm-delete-modal');
        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        }

        function closeDeleteModal() {
            const modal = document.getElementById('confirm-delete-modal');
            if (modal) {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                const modalBox = modal.querySelector('.modal-box');
                if (modalBox) {
                    modalBox.classList.remove('scale-100', 'opacity-100');
                    modalBox.classList.add('scale-95', 'opacity-0');
                }
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>

    <style>
        .active-tab-btn {
            background-color: rgba(255, 255, 255, 0.08);
            color: var(--color-gold-400);
            border-left: 4px solid var(--color-gold-500);
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
        }
        @media (max-width: 1023px) {
            .active-tab-btn {
                border-left-width: 0px !important;
                border-bottom: 3px solid var(--color-gold-500) !important;
                border-radius: 0.75rem !important;
                border-bottom-left-radius: 0px !important;
                border-bottom-right-radius: 0px !important;
            }
        }
        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hidden {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <!-- Reusable Custom Confirmation Modal HTML -->
    <div id="confirm-delete-modal" class="fixed inset-0 bg-black/60 z-[999] hidden items-center justify-center p-4 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div class="modal-box bg-white rounded-3xl border border-beige-200 max-w-md w-full p-6 md:p-8 shadow-2xl transform scale-95 opacity-0 transition-all duration-300">
            <div class="text-center">
                <!-- Warning icon -->
                <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-4 border border-red-100">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="font-serif text-lg font-bold text-forest-900 mb-2">Konfirmasi Hapus</h3>
                <p id="confirm-delete-message" class="text-xs md:text-sm text-forest-700/70 leading-relaxed mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex items-center justify-center gap-3">
                    <button id="btn-cancel-delete" class="px-6 py-2.5 bg-beige-100 hover:bg-beige-200 text-forest-800 font-bold rounded-full text-xs md:text-sm transition cursor-pointer">
                        Batal
                    </button>
                    <a id="btn-confirm-delete-link" href="#" class="px-6 py-2.5 bg-red-600 hover:bg-red-500 text-white font-bold rounded-full text-xs md:text-sm transition shadow-md shadow-red-600/10">
                        Ya, Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
