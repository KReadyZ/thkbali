<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesor Panel — THK Bali</title>
    @vite(['resources/css/app.css'])
    <!-- FontAwesome for Dashboard icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-beige-100 text-forest-950 h-screen flex flex-col font-sans overflow-hidden">

    <!-- Top Navigation Header -->
    <header class="bg-forest-950 text-white py-4 px-6 lg:px-12 flex items-center justify-between border-b border-gold-500/20 shrink-0 sticky top-0 z-30">
        <div class="flex items-center gap-3">
            <svg class="w-8 h-8 text-gold-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="9" r="6" stroke="currentColor" />
                <circle cx="8" cy="15" r="6" stroke="currentColor" />
                <circle cx="16" cy="15" r="6" stroke="currentColor" />
            </svg>
            <div>
                <span class="font-serif font-bold text-base block tracking-wide">THK Bali Back Office</span>
                <span class="text-[9px] text-gold-400 font-semibold tracking-widest uppercase block leading-none">Asesor Panel</span>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <span class="hidden md:inline text-xs text-white/70">Masuk sebagai Asesor: <strong class="text-white">{{ Auth::user() ? Auth::user()->name : 'Asesor' }}</strong></span>
            <a href="{{ route('logout') }}" class="px-4 py-1.5 rounded-full border border-red-500/30 text-red-400 hover:bg-red-500 hover:text-white text-xs font-bold transition duration-300">
                Keluar
            </a>
        </div>
    </header>

    <div class="flex-1 flex flex-col lg:flex-row min-h-0 overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside class="w-full lg:w-64 bg-forest-900 text-white shrink-0 border-r border-white/5 flex flex-col overflow-y-auto">
            <nav class="p-4 space-y-1">
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold bg-white/10 text-gold-400 border-l-4 border-gold-500 transition text-left cursor-pointer">
                    <i class="fas fa-file-invoice w-5 text-center text-gold-500"></i> Evaluasi Pendaftaran
                </button>
            </nav>
            <div class="mt-auto p-4 border-t border-white/5">
                <a href="{{ route('home') }}" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-gold-500/30 text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition text-xs font-bold">
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

            <section class="tab-pane active-tab-pane">
                <div class="bg-white rounded-3xl border border-beige-200 p-6 md:p-8 shadow-sm">
                    <div class="mb-6">
                        <h2 class="font-serif text-2xl font-bold text-forest-900">Evaluasi Pendaftaran & Berkas Peserta</h2>
                        <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Periksa berkas dokumen pendaftar dan lakukan pembaharuan status kemajuan evaluasi lapangan secara berkala.</p>
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
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @forelse($proposals as $prop)
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
                                            <form action="{{ route('assessor.proposal.status', $prop->id) }}" method="POST" class="inline-block">
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-sm text-forest-700/50 italic">Belum ada berkas pendaftaran peserta yang diajukan ke sistem.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
