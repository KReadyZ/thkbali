<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asesor Panel — THK Bali Back Office</title>
    @vite(['resources/css/app.css'])
    <!-- FontAwesome for Dashboard icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-[#f2f7f5] text-forest-950 min-h-screen flex flex-col font-sans">

    <!-- Top Navigation Header -->
    <header class="bg-forest-950 text-white py-4 px-6 lg:px-12 flex items-center justify-between border-b border-gold-500/20 shrink-0 sticky top-0 z-30 shadow-md">
        <div class="flex items-center gap-3">
            <svg class="w-8 h-8 text-gold-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="9" r="6" stroke="currentColor" />
                <circle cx="8" cy="15" r="6" stroke="currentColor" />
                <circle cx="16" cy="15" r="6" stroke="currentColor" />
            </svg>
            <div>
                <span class="font-serif font-bold text-base block tracking-wide">THK Bali Back Office</span>
                <div class="flex items-center gap-2">
                    <span class="text-[9px] text-gold-400 font-semibold tracking-widest uppercase block leading-none">Asesor Panel</span>
                    @if(Auth::user() && Auth::user()->specialization)
                        <span class="px-2 py-0.2 bg-gold-500/20 border border-gold-500/40 text-gold-300 text-[9px] font-bold rounded-full uppercase">
                            Spesialisasi: {{ ucfirst(Auth::user()->specialization) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <div class="text-xs text-white/90 font-bold">{{ Auth::user() ? Auth::user()->name : 'Asesor' }}</div>
                <div class="text-[10px] text-gold-400/80">{{ Auth::user() ? Auth::user()->email : '' }}</div>
            </div>
            <a href="{{ route('logout') }}" class="px-4 py-1.5 rounded-full border border-red-500/30 text-red-400 hover:bg-red-500 hover:text-white text-xs font-bold transition duration-300">
                Keluar
            </a>
        </div>
    </header>

    <div class="flex-1 flex flex-col lg:flex-row min-h-0">
        <!-- Sidebar Navigation -->
        <aside class="w-full lg:w-64 bg-forest-900 text-white shrink-0 border-r border-white/5 flex flex-col">
            <nav class="p-4 space-y-1">
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold bg-white/10 text-gold-400 border-l-4 border-gold-500 transition text-left cursor-pointer shadow-xs">
                    <i class="fas fa-clipboard-check w-5 text-center text-gold-500"></i> Evaluasi & Penilaian
                </button>
            </nav>
            <div class="mt-auto p-4 border-t border-white/5 space-y-2">
                <div class="p-3 bg-white/5 rounded-xl border border-white/10 text-[11px] text-white/70">
                    <span class="font-bold text-gold-400 block mb-0.5"><i class="fas fa-info-circle mr-1"></i> Info Asesor</span>
                    Nilai dan catatan evaluasi yang Anda kirimkan akan direkapitulasi secara otomatis di Panel Admin (Pak Laba).
                </div>
                <a href="{{ route('home') }}" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-gold-500/30 text-gold-500 hover:bg-gold-500 hover:text-forest-950 transition text-xs font-bold">
                    <i class="fas fa-external-link-alt"></i> Buka Website
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-10 overflow-y-auto">
            <!-- Success / Error Alert -->
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-2xl p-4 mb-6 text-sm flex items-start gap-2.5 shadow-sm">
                    <i class="fas fa-check-circle mt-0.5 text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 rounded-2xl p-4 mb-6 text-sm flex items-start gap-2.5 shadow-sm">
                    <i class="fas fa-exclamation-circle mt-0.5 text-red-600"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <section class="space-y-6">
                <!-- Header Banner -->
                <div class="bg-white rounded-3xl border border-[#c6e1d7] p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2.5 py-0.5 bg-forest-900 text-gold-400 text-[10px] font-black uppercase rounded-full tracking-wider">
                                Panel Evaluasi 3 Pilar
                            </span>
                            <span class="text-xs font-bold text-forest-700">Tri Hita Karana Awards</span>
                        </div>
                        <h2 class="font-serif text-2xl font-bold text-forest-950">Penilaian Dokumen & Lapangan Peserta</h2>
                        <p class="text-xs text-forest-700/80 font-medium mt-1">
                            Periksa berkas proposal, buka tautan dokumen pilar (Parahyangan, Pawongan, Palemahan), dan masukkan nilai evaluasi Anda untuk diserahkan ke Admin / Pak Laba.
                        </p>
                    </div>
                </div>

                <!-- Proposals Table Card -->
                <div class="bg-white rounded-3xl border border-[#c6e1d7] p-6 md:p-8 shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-[#c6e1d7] text-forest-800/70 uppercase text-[10px] tracking-wider font-bold">
                                    <th class="py-3 px-4">Instansi Peserta</th>
                                    <th class="py-3 px-4">Kategori</th>
                                    <th class="py-3 px-4">Penugasan Asesor 3 Pilar</th>
                                    <th class="py-3 px-4">Status Nilai 3 Pilar</th>
                                    <th class="py-3 px-4">Tahapan</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e2efe9]">
                                @forelse($proposals as $prop)
                                    @php
                                        $currentUserId = Auth::id();
                                        $userSpec = Auth::user()->specialization;
                                        $isAssignedParah = ($prop->assessor_parahyangan_id == $currentUserId);
                                        $isAssignedPawo = ($prop->assessor_pawongan_id == $currentUserId);
                                        $isAssignedPalem = ($prop->assessor_palemahan_id == $currentUserId);
                                        $isGeneralAssessor = ($userSpec === 'umum' || empty($userSpec));
                                    @endphp
                                    <tr class="hover:bg-[#f6faf8] transition">
                                        <!-- Instansi Peserta -->
                                        <td class="py-4 px-4">
                                            <div class="font-bold text-forest-950 text-sm">{{ $prop->institution_name }}</div>
                                            <div class="text-[11px] text-forest-700/70 font-medium">CP: {{ $prop->contact_name }} ({{ $prop->contact_wa }})</div>
                                            <div class="text-[10px] text-forest-600/60 mt-0.5">Akun: {{ $prop->user ? $prop->user->email : '-' }}</div>
                                        </td>

                                        <!-- Kategori -->
                                        <td class="py-4 px-4">
                                            <span class="bg-[#eaf4f0] border border-[#c6e1d7] text-forest-900 rounded-lg px-2.5 py-1 text-xs font-semibold inline-block">
                                                {{ $prop->category }}
                                            </span>
                                        </td>

                                        <!-- Penugasan 3 Pilar -->
                                        <td class="py-4 px-4 text-xs space-y-1">
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $isAssignedParah ? 'bg-amber-100 text-amber-900 border border-amber-300 font-black' : 'bg-gray-100 text-gray-700' }}">
                                                    Parahyangan:
                                                </span>
                                                <span class="text-[11px] {{ $isAssignedParah ? 'font-black text-amber-900' : 'text-forest-800' }}">
                                                    {{ $prop->assessorParahyangan ? $prop->assessorParahyangan->name : 'Belum Ditugaskan' }}
                                                    @if($isAssignedParah) <span class="text-[9px] text-amber-700 font-bold">(Tugas Anda)</span> @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $isAssignedPawo ? 'bg-blue-100 text-blue-900 border border-blue-300 font-black' : 'bg-gray-100 text-gray-700' }}">
                                                    Pawongan:
                                                </span>
                                                <span class="text-[11px] {{ $isAssignedPawo ? 'font-black text-blue-900' : 'text-forest-800' }}">
                                                    {{ $prop->assessorPawongan ? $prop->assessorPawongan->name : 'Belum Ditugaskan' }}
                                                    @if($isAssignedPawo) <span class="text-[9px] text-blue-700 font-bold">(Tugas Anda)</span> @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded {{ $isAssignedPalem ? 'bg-emerald-100 text-emerald-900 border border-emerald-300 font-black' : 'bg-gray-100 text-gray-700' }}">
                                                    Palemahan:
                                                </span>
                                                <span class="text-[11px] {{ $isAssignedPalem ? 'font-black text-emerald-900' : 'text-forest-800' }}">
                                                    {{ $prop->assessorPalemahan ? $prop->assessorPalemahan->name : 'Belum Ditugaskan' }}
                                                    @if($isAssignedPalem) <span class="text-[9px] text-emerald-700 font-bold">(Tugas Anda)</span> @endif
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Status Nilai 3 Pilar -->
                                        <td class="py-4 px-4 text-xs space-y-1">
                                            <div class="flex items-center justify-between gap-2">
                                                <span class="text-[10px] text-forest-700 font-medium">Parahyangan:</span>
                                                @if(!is_null($prop->score_parahyangan))
                                                    <span class="px-2 py-0.5 bg-amber-100 text-amber-900 font-black rounded-md text-[10px]">{{ $prop->score_parahyangan }}</span>
                                                @else
                                                    <span class="text-[10px] text-gray-400 italic">Belum Dinilai</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center justify-between gap-2">
                                                <span class="text-[10px] text-forest-700 font-medium">Pawongan:</span>
                                                @if(!is_null($prop->score_pawongan))
                                                    <span class="px-2 py-0.5 bg-blue-100 text-blue-900 font-black rounded-md text-[10px]">{{ $prop->score_pawongan }}</span>
                                                @else
                                                    <span class="text-[10px] text-gray-400 italic">Belum Dinilai</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center justify-between gap-2">
                                                <span class="text-[10px] text-forest-700 font-medium">Palemahan:</span>
                                                @if(!is_null($prop->score_palemahan))
                                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-900 font-black rounded-md text-[10px]">{{ $prop->score_palemahan }}</span>
                                                @else
                                                    <span class="text-[10px] text-gray-400 italic">Belum Dinilai</span>
                                                @endif
                                            </div>
                                            @if(!is_null($prop->final_score))
                                                <div class="border-t border-[#c6e1d7] pt-1 flex items-center justify-between">
                                                    <span class="text-[10px] font-black text-forest-900">Rata-rata:</span>
                                                    <span class="px-2 py-0.5 bg-gold-500 text-forest-950 font-black rounded-md text-xs shadow-xs">{{ $prop->final_score }}</span>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Tahapan (Status Ditetapkan Admin) -->
                                        <td class="py-4 px-4">
                                            @if($prop->status === 'Pengajuan')
                                                <span class="px-2.5 py-1 bg-gray-100 border border-gray-300 text-gray-700 text-[11px] font-bold rounded-full inline-block">
                                                    Pengajuan
                                                </span>
                                            @elseif($prop->status === 'Verifikasi Admin')
                                                <span class="px-2.5 py-1 bg-blue-50 border border-blue-200 text-blue-800 text-[11px] font-bold rounded-full inline-block">
                                                    Verifikasi Admin
                                                </span>
                                            @elseif($prop->status === 'Penilaian Lapangan')
                                                <span class="px-2.5 py-1 bg-amber-50 border border-amber-300 text-amber-900 text-[11px] font-bold rounded-full inline-block">
                                                    Penilaian Lapangan
                                                </span>
                                            @elseif($prop->status === 'Hasil Penilaian')
                                                <span class="px-2.5 py-1 bg-purple-50 border border-purple-200 text-purple-900 text-[11px] font-bold rounded-full inline-block">
                                                    Hasil Penilaian
                                                </span>
                                            @elseif($prop->status === 'Penghargaan')
                                                <span class="px-2.5 py-1 bg-emerald-50 border border-emerald-300 text-emerald-900 text-[11px] font-black rounded-full inline-block">
                                                    🏆 Penghargaan
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 bg-gray-100 text-gray-700 text-[11px] font-bold rounded-full inline-block">
                                                    {{ $prop->status }}
                                                </span>
                                            @endif
                                        </td>

                                        <!-- Aksi -->
                                        <td class="py-4 px-4 text-right space-x-2">
                                            <button onclick="openScoringModalById({{ $prop->id }})" class="px-3.5 py-1.5 bg-gold-500 hover:bg-gold-400 text-forest-950 font-black text-xs rounded-xl shadow-xs transition inline-flex items-center gap-1.5 cursor-pointer">
                                                <i class="fas fa-edit"></i> Beri Nilai
                                            </button>
                                            <button onclick="openAssessorProposalDetailById({{ $prop->id }})" class="px-3 py-1.5 bg-[#eaf4f0] hover:bg-[#dfeee8] text-forest-900 border border-[#b8dad0] font-bold text-xs rounded-xl transition inline-flex items-center gap-1 cursor-pointer">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-10 text-center text-sm text-forest-700/50 italic">Belum ada berkas pendaftaran peserta yang diajukan ke sistem.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- ==================== MODAL FORM PENILAIAN ASESOR 3 PILAR ==================== -->
    <div id="modal-scoring" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-[#c6e1d7] max-w-xl w-full p-6 md:p-8 max-h-[92vh] overflow-y-auto relative shadow-2xl">
            <!-- Close Button -->
            <button onclick="closeScoringModal()" class="absolute top-4 right-4 p-2 text-forest-400 hover:text-forest-950 hover:bg-forest-100 rounded-full transition cursor-pointer" aria-label="Tutup">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-5 pb-4 border-b border-[#c6e1d7]">
                <span class="text-[10px] font-black uppercase text-gold-600 tracking-wider">Formulir Evaluasi Lapangan</span>
                <h3 class="font-serif text-xl font-bold text-forest-950" id="score-modal-inst-title">Beri Nilai Instansi</h3>
                <p class="text-xs text-forest-700 font-medium mt-0.5">Masukkan skor 0 - 100 dan catatan evaluasi lapangan untuk pilar yang Anda ampu.</p>
            </div>

            <form id="form-submit-score" method="POST" action="" class="space-y-5">
                @csrf
                
                <!-- Pilih Pilar Penilaian -->
                <div>
                    <label class="block text-[11px] font-bold text-forest-900 uppercase mb-1" for="score-pillar-select">
                        Pilar Filosofis yang Dinilai <span class="text-red-500">*</span>
                    </label>
                    <select id="score-pillar-select" name="pillar" required onchange="onPillarSelectChange()" class="w-full bg-[#f4faf8] border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm font-bold outline-none focus:border-gold-500 cursor-pointer">
                        <option value="parahyangan">1. Bidang Parahyangan (Spiritual / Tempat Suci / Ritual)</option>
                        <option value="pawongan">2. Bidang Pawongan (Sosial / Karyawan / Masyarakat Adat)</option>
                        <option value="palemahan">3. Bidang Palemahan (Lingkungan / Alam / Pengolahan Sampah)</option>
                    </select>
                </div>

                <!-- Tautan Berkas Pilar Terkait -->
                <div class="p-3.5 bg-[#eaf4f0] rounded-2xl border border-[#c6e1d7] flex items-center justify-between gap-3">
                    <div>
                        <span class="text-[10px] font-bold text-forest-700 block uppercase">Dokumen Pendukung Pilar Ini:</span>
                        <a id="score-pillar-link-btn" href="#" target="_blank" class="text-xs font-black text-gold-600 hover:text-gold-700 hover:underline flex items-center gap-1.5 mt-0.5">
                            <i class="fas fa-external-link-alt"></i> <span id="score-pillar-link-text">Buka Link Dokumen Pilar</span>
                        </a>
                        <span id="score-pillar-link-empty" class="text-xs font-semibold text-gray-500 italic hidden">Belum ada tautan yang dilampirkan peserta</span>
                    </div>
                    <a id="score-proposal-doc-btn" href="#" target="_blank" class="px-3 py-1.5 bg-white border border-[#b8dad0] text-forest-900 text-xs font-bold rounded-xl hover:border-gold-500 shadow-2xs shrink-0">
                        <i class="fas fa-file-pdf text-red-500 mr-1"></i> Proposal Utama
                    </a>
                </div>

                <!-- Input Skor Nilai -->
                <div>
                    <label class="block text-[11px] font-bold text-forest-900 uppercase mb-1" for="score-input">
                        Skor Nilai Pilar (Skala 0 - 100) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0" max="100" id="score-input" name="score" required placeholder="Contoh: 92.50" class="w-full bg-[#f4faf8] border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-base font-black outline-none focus:border-gold-500 placeholder-gray-400">
                        <span class="absolute inset-y-0 right-4 flex items-center text-xs font-bold text-forest-700/60">/ 100</span>
                    </div>
                </div>

                <!-- Input Catatan Evaluasi Lapangan -->
                <div>
                    <label class="block text-[11px] font-bold text-forest-900 uppercase mb-1" for="score-notes">
                        Catatan Evaluasi Lapangan & Temuan Asesor <span class="text-[10px] text-gray-500 font-normal">(Opsional)</span>
                    </label>
                    <textarea id="score-notes" name="notes" rows="4" placeholder="Tuliskan ulasan penilaian, kesesuaian kriteria adat, kelebihan, serta aspek yang perlu ditingkatkan..." class="w-full bg-[#f4faf8] border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-gold-500 placeholder-gray-400"></textarea>
                </div>

                <!-- Tombol Submit Nilai -->
                <div class="pt-3 border-t border-[#c6e1d7] flex items-center justify-end gap-3">
                    <button type="button" onclick="closeScoringModal()" class="px-5 py-2.5 border border-[#b8dad0] text-forest-800 rounded-xl text-xs font-bold hover:bg-gray-100 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-forest-950 hover:bg-gold-500 text-gold-400 hover:text-forest-950 font-black rounded-xl text-xs shadow-md transition duration-300 flex items-center gap-2 cursor-pointer">
                        <i class="fas fa-paper-plane"></i> Kirim Nilai ke Admin / Pak Laba
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== ASSESSOR PROPOSAL DETAIL MODAL ==================== -->
    <div id="modal-assessor-proposal-detail" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-[#c6e1d7] max-w-2xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto relative flex flex-col shadow-2xl">
            <button onclick="closeAssessorProposalDetail()" class="absolute top-4 right-4 p-2 text-forest-400 hover:text-forest-950 rounded-full transition cursor-pointer" aria-label="Tutup">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="font-serif text-xl font-bold text-forest-900 mb-6">Detail Pendaftaran & Dokumen</h3>
            
            <div class="space-y-6 text-sm">
                <!-- Section 1: Informasi Instansi -->
                <div class="bg-[#f4faf8] p-4 rounded-2xl border border-[#c6e1d7]">
                    <h4 class="font-bold text-forest-900 border-b border-[#c6e1d7] pb-2 mb-3 uppercase tracking-wider text-xs">
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
                <div class="bg-[#f4faf8] p-4 rounded-2xl border border-[#c6e1d7]">
                    <h4 class="font-bold text-forest-900 border-b border-[#c6e1d7] pb-2 mb-3 uppercase tracking-wider text-xs">
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

                <!-- Section 3: Unggahan Berkas -->
                <div class="bg-[#f4faf8] p-4 rounded-2xl border border-[#c6e1d7]">
                    <h4 class="font-bold text-forest-900 border-b border-[#c6e1d7] pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-file-archive text-gold-600 mr-1.5"></i> Berkas Pendukung & Bukti Pembayaran
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs md:text-sm">
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Berkas Sertifikasi</span>
                            <a id="det-file-proposal" href="#" target="_blank" class="text-gold-600 font-bold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-file-pdf text-red-500"></i> Lihat Berkas
                            </a>
                            <span id="det-file-proposal-empty" class="text-red-500 font-medium hidden">Belum Unggah</span>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Bukti Pembayaran</span>
                            <a id="det-file-payment" href="#" target="_blank" class="text-gold-600 font-bold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-file-invoice-dollar text-emerald-600"></i> Lihat Bukti
                            </a>
                            <span id="det-file-payment-empty" class="text-red-500 font-medium hidden">Belum Unggah</span>
                        </div>
                        <div>
                            <span class="text-forest-700/60 block text-[10px] uppercase font-bold">Akreditasi Sebelumnya</span>
                            <a id="det-file-accred" href="#" target="_blank" class="text-gold-600 font-bold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-medal text-gold-600"></i> Lihat Hasil
                            </a>
                            <span id="det-file-accred-empty" class="text-red-500 font-medium hidden">Belum Unggah</span>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Tautan Dokumen Pilar THK -->
                <div class="bg-[#f4faf8] p-4 rounded-2xl border border-[#c6e1d7]">
                    <h4 class="font-bold text-forest-900 border-b border-[#c6e1d7] pb-2 mb-3 uppercase tracking-wider text-xs">
                        <i class="fas fa-link text-gold-600 mr-1.5"></i> Tautan Dokumen 3 Pilar Filosofis
                    </h4>
                    <div class="space-y-3 text-xs md:text-sm">
                        <div class="flex items-center justify-between border-b border-[#c6e1d7]/60 pb-2">
                            <span class="text-forest-900 font-bold">1. Link Bidang Parahyangan:</span>
                            <a id="det-link-parahyangan" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                        <div class="flex items-center justify-between border-b border-[#c6e1d7]/60 pb-2">
                            <span class="text-forest-900 font-bold">2. Link Bidang Pawongan:</span>
                            <a id="det-link-pawongan" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                        <div class="flex items-center justify-between pb-1">
                            <span class="text-forest-900 font-bold">3. Link Bidang Palemahan:</span>
                            <a id="det-link-palemahan" href="#" target="_blank" class="text-gold-600 font-bold hover:underline break-all">-</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button onclick="closeAssessorProposalDetail()" class="px-6 py-2 bg-forest-900 text-white rounded-full text-xs font-bold hover:bg-forest-950 transition cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        let currentPropData = null;
        const loggedInUserSpec = "{{ Auth::user() ? Auth::user()->specialization : '' }}";

        const modalScoring = document.getElementById('modal-scoring');
        const formSubmitScore = document.getElementById('form-submit-score');
        const pillarSelect = document.getElementById('score-pillar-select');
        const scoreInput = document.getElementById('score-input');
        const scoreNotes = document.getElementById('score-notes');
        const pillarLinkBtn = document.getElementById('score-pillar-link-btn');
        const pillarLinkText = document.getElementById('score-pillar-link-text');
        const pillarLinkEmpty = document.getElementById('score-pillar-link-empty');
        const proposalDocBtn = document.getElementById('score-proposal-doc-btn');

        function openScoringModal(prop) {
            currentPropData = prop;
            formSubmitScore.action = `/assessor/proposal/score/${prop.id}`;
            document.getElementById('score-modal-inst-title').textContent = `Beri Nilai: ${prop.institution_name}`;

            if (loggedInUserSpec && ['parahyangan', 'pawongan', 'palemahan'].includes(loggedInUserSpec)) {
                pillarSelect.value = loggedInUserSpec;
            }

            if (prop.file_path && prop.file_path !== '-') {
                proposalDocBtn.href = prop.file_path;
                proposalDocBtn.classList.remove('hidden');
            } else {
                proposalDocBtn.classList.add('hidden');
            }

            onPillarSelectChange();

            modalScoring.classList.remove('hidden');
            modalScoring.classList.add('flex');
        }

        function closeScoringModal() {
            modalScoring.classList.add('hidden');
            modalScoring.classList.remove('flex');
        }

        function onPillarSelectChange() {
            if (!currentPropData) return;
            const p = pillarSelect.value;
            let currentScore = '';
            let currentNotes = '';
            let currentLink = '';

            if (p === 'parahyangan') {
                currentScore = currentPropData.score_parahyangan ?? '';
                currentNotes = currentPropData.notes_parahyangan ?? '';
                currentLink = currentPropData.link_parahyangan;
            } else if (p === 'pawongan') {
                currentScore = currentPropData.score_pawongan ?? '';
                currentNotes = currentPropData.notes_pawongan ?? '';
                currentLink = currentPropData.link_pawongan;
            } else if (p === 'palemahan') {
                currentScore = currentPropData.score_palemahan ?? '';
                currentNotes = currentPropData.notes_palemahan ?? '';
                currentLink = currentPropData.link_palemahan;
            }

            scoreInput.value = currentScore;
            scoreNotes.value = currentNotes;

            if (currentLink && currentLink !== '-') {
                const formatted = (currentLink.startsWith('http://') || currentLink.startsWith('https://')) ? currentLink : `https://${currentLink}`;
                pillarLinkBtn.href = formatted;
                pillarLinkText.textContent = `Buka Link (${currentLink})`;
                pillarLinkBtn.classList.remove('hidden');
                pillarLinkEmpty.classList.add('hidden');
            } else {
                pillarLinkBtn.classList.add('hidden');
                pillarLinkEmpty.classList.remove('hidden');
            }
        }

        const modalAssessorPropDetail = document.getElementById('modal-assessor-proposal-detail');
        function openAssessorProposalDetail(item) {
            if (!modalAssessorPropDetail) return;
            
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

            const fileProp = document.getElementById('det-file-proposal');
            const filePropEmpty = document.getElementById('det-file-proposal-empty');
            if (item.file_path && item.file_path !== '-') {
                fileProp.href = item.file_path;
                fileProp.classList.remove('hidden');
                filePropEmpty.classList.add('hidden');
            } else {
                fileProp.classList.add('hidden');
                filePropEmpty.classList.remove('hidden');
            }
            
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
                if (!lnk || lnk === '-') return '#';
                if (!lnk.startsWith('http://') && !lnk.startsWith('https://')) {
                    return 'https://' + lnk;
                }
                return lnk;
            };

            const linkParah = document.getElementById('det-link-parahyangan');
            linkParah.href = formatLink(item.link_parahyangan);
            linkParah.textContent = (item.link_parahyangan && item.link_parahyangan !== '-') ? item.link_parahyangan : '-';

            const linkPawo = document.getElementById('det-link-pawongan');
            linkPawo.href = formatLink(item.link_pawongan);
            linkPawo.textContent = (item.link_pawongan && item.link_pawongan !== '-') ? item.link_pawongan : '-';

            const linkPalem = document.getElementById('det-link-palemahan');
            linkPalem.href = formatLink(item.link_palemahan);
            linkPalem.textContent = (item.link_palemahan && item.link_palemahan !== '-') ? item.link_palemahan : '-';

            modalAssessorPropDetail.classList.remove('hidden');
            modalAssessorPropDetail.classList.add('flex');
        }
        function closeAssessorProposalDetail() {
            if (!modalAssessorPropDetail) return;
            modalAssessorPropDetail.classList.add('hidden');
            modalAssessorPropDetail.classList.remove('flex');
        }

        // Global Proposals Map for Assessor Modals
        const assessorProposals = @json($proposals);
        const assessorProposalsById = {};
        if (Array.isArray(assessorProposals)) {
            assessorProposals.forEach(p => { assessorProposalsById[p.id] = p; });
        }

        function openScoringModalById(id) {
            const item = assessorProposalsById[id];
            if (item) openScoringModal(item);
        }

        function openAssessorProposalDetailById(id) {
            const item = assessorProposalsById[id];
            if (item) openAssessorProposalDetail(item);
        }
    </script>
</body>
</html>
