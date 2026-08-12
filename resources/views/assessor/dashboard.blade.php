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
                    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-beige-50/50 p-4 rounded-2xl border border-beige-200/60 shadow-2xs">
                        <div>
                            <h2 class="font-serif text-2xl font-bold text-forest-900">Evaluasi Pendaftaran & Berkas Peserta</h2>
                            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider">Periksa berkas portofolio 3 pilar pendaftar dan berikan nilai evaluasi lapangan secara objektif.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-forest-800">Spesialisasi Anda:</span>
                            @if(isset($currentAssessor) && $currentAssessor->pillar_specialization === 'parahyangan')
                                <span class="px-3 py-1 bg-blue-100 border border-blue-300 text-blue-900 font-bold text-xs rounded-full flex items-center gap-1.5 shadow-2xs">
                                    <i class="fas fa-pray text-blue-600"></i> Asesor Parahyangan
                                </span>
                            @elseif(isset($currentAssessor) && $currentAssessor->pillar_specialization === 'pawongan')
                                <span class="px-3 py-1 bg-green-100 border border-green-300 text-green-900 font-bold text-xs rounded-full flex items-center gap-1.5 shadow-2xs">
                                    <i class="fas fa-users text-green-600"></i> Asesor Pawongan
                                </span>
                            @elseif(isset($currentAssessor) && $currentAssessor->pillar_specialization === 'palemahan')
                                <span class="px-3 py-1 bg-emerald-100 border border-emerald-300 text-emerald-900 font-bold text-xs rounded-full flex items-center gap-1.5 shadow-2xs">
                                    <i class="fas fa-leaf text-emerald-600"></i> Asesor Palemahan
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gold-100 border border-gold-300 text-gold-900 font-bold text-xs rounded-full flex items-center gap-1.5 shadow-2xs">
                                    <i class="fas fa-star text-gold-600"></i> Semua Pilar (Umum)
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Proposals Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="border-b border-beige-200 text-forest-700/60 uppercase text-[10px] tracking-wider font-semibold">
                                    <th class="py-3 px-4">Instansi & Peserta</th>
                                    <th class="py-3 px-4">Kategori & Berkas</th>
                                    <th class="py-3 px-4">Tautan 3 Pilar THK</th>
                                    <th class="py-3 px-4">Nilai Evaluasi</th>
                                    <th class="py-3 px-4">Status Evaluasi</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-beige-100">
                                @forelse($proposals as $prop)
                                    <tr class="hover:bg-beige-50/50 transition">
                                        <td class="py-3 px-4">
                                            <div class="font-bold text-forest-900">{{ $prop->institution_name }}</div>
                                            <div class="text-[11px] text-forest-700/60">{{ $prop->user ? $prop->user->name : 'N/A' }} ({{ $prop->user ? $prop->user->email : 'N/A' }})</div>
                                        </td>
                                        <td class="py-3 px-4 text-xs">
                                            <span class="bg-beige-50 border border-beige-300 rounded-md px-2 py-0.5 inline-block font-semibold text-forest-800 mb-1">
                                                {{ $prop->category }}
                                            </span>
                                            <div>
                                                @if($prop->file_path && $prop->file_path !== '-')
                                                    <a href="{{ $prop->file_path }}" target="_blank" class="inline-flex items-center gap-1 text-gold-600 hover:text-gold-500 font-bold text-[11px]">
                                                        <i class="fas fa-file-pdf"></i> Proposal
                                                    </a>
                                                @else
                                                    <span class="text-red-500 text-[10px] font-medium">Belum Unggah</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-xs space-y-1">
                                            <div>
                                                <span class="text-[10px] font-bold text-blue-900">Parahyangan:</span>
                                                @if($prop->link_parahyangan && $prop->link_parahyangan !== '-')
                                                    <a href="{{ str_starts_with($prop->link_parahyangan, 'http') ? $prop->link_parahyangan : 'https://'.$prop->link_parahyangan }}" target="_blank" class="text-gold-600 hover:underline font-bold text-[11px] ml-1">
                                                        <i class="fas fa-external-link-alt text-[9px]"></i> Buka Link
                                                    </a>
                                                @else
                                                    <span class="text-forest-700/50 text-[10px] ml-1">-</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="text-[10px] font-bold text-green-900">Pawongan:</span>
                                                @if($prop->link_pawongan && $prop->link_pawongan !== '-')
                                                    <a href="{{ str_starts_with($prop->link_pawongan, 'http') ? $prop->link_pawongan : 'https://'.$prop->link_pawongan }}" target="_blank" class="text-gold-600 hover:underline font-bold text-[11px] ml-1">
                                                        <i class="fas fa-external-link-alt text-[9px]"></i> Buka Link
                                                    </a>
                                                @else
                                                    <span class="text-forest-700/50 text-[10px] ml-1">-</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="text-[10px] font-bold text-emerald-900">Palemahan:</span>
                                                @if($prop->link_palemahan && $prop->link_palemahan !== '-')
                                                    <a href="{{ str_starts_with($prop->link_palemahan, 'http') ? $prop->link_palemahan : 'https://'.$prop->link_palemahan }}" target="_blank" class="text-gold-600 hover:underline font-bold text-[11px] ml-1">
                                                        <i class="fas fa-external-link-alt text-[9px]"></i> Buka Link
                                                    </a>
                                                @else
                                                    <span class="text-forest-700/50 text-[10px] ml-1">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-xs">
                                            <div class="flex items-center gap-1.5 mb-1">
                                                <span class="px-1.5 py-0.5 bg-blue-50 text-blue-800 border border-blue-200 rounded text-[9px] font-bold" title="Nilai Parahyangan">
                                                    Pra: {{ $prop->score_parahyangan ?? '-' }}
                                                </span>
                                                <span class="px-1.5 py-0.5 bg-green-50 text-green-800 border border-green-200 rounded text-[9px] font-bold" title="Nilai Pawongan">
                                                    Pwo: {{ $prop->score_pawongan ?? '-' }}
                                                </span>
                                                <span class="px-1.5 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded text-[9px] font-bold" title="Nilai Palemahan">
                                                    Plm: {{ $prop->score_palemahan ?? '-' }}
                                                </span>
                                            </div>
                                            <div class="text-[11px] font-bold text-forest-900">
                                                Rata-rata: <span class="text-gold-600 font-bold">{{ $prop->calculated_average_score ?? '-' }}</span>
                                            </div>
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
                                        <td class="py-3 px-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button onclick="openEvaluateModal({{ json_encode($prop) }})" class="px-3 py-1 bg-gold-500 hover:bg-gold-400 text-forest-950 font-bold text-xs rounded-lg transition shadow-xs cursor-pointer flex items-center gap-1">
                                                    <i class="fas fa-edit text-[10px]"></i> Beri Nilai
                                                </button>
                                                <button onclick="openAssessorProposalDetail({{ json_encode($prop) }})" class="px-2.5 py-1 bg-beige-100 hover:bg-beige-200 text-forest-800 font-semibold text-xs rounded-lg transition border border-beige-300 cursor-pointer">
                                                    Detail
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-sm text-forest-700/50 italic">Belum ada berkas pendaftaran peserta yang diajukan ke sistem.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- ==================== MODAL EVALUASI ASESOR ==================== -->
    <div id="modal-assessor-evaluate" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-lg w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto relative flex flex-col">
            <button onclick="closeEvaluateModal()" class="absolute top-4 right-4 p-2 text-forest-400 hover:text-forest-950 rounded-full transition cursor-pointer" aria-label="Tutup">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 class="font-serif text-xl font-bold text-forest-900 mb-1 flex items-center gap-2">
                <i class="fas fa-star-half-alt text-gold-600"></i> Form Penilaian & Evaluasi Pilar
            </h3>
            <p class="text-xs text-forest-700/60 font-medium uppercase tracking-wider mb-6">Instansi: <strong id="eval-inst-name" class="text-forest-900">-</strong></p>

            <form id="form-assessor-evaluate" method="POST" class="space-y-5 text-xs">
                @csrf
                <!-- Pilih Pilar yang dinilai -->
                <div>
                    <label class="block font-bold uppercase text-forest-900 text-[11px] mb-1.5">Pilar yang Dinilai</label>
                    <select id="eval-pillar" name="pillar" onchange="updatePillarDocLink()" required class="w-full bg-beige-50 border border-beige-300 rounded-xl px-3 py-2.5 text-forest-950 text-xs font-bold outline-none focus:border-gold-500 cursor-pointer">
                        <option value="parahyangan">1. Parahyangan (Spiritual / Ketuhanan)</option>
                        <option value="pawongan">2. Pawongan (Sosial / Kemanusiaan)</option>
                        <option value="palemahan">3. Palemahan (Lingkungan / Alam)</option>
                    </select>
                </div>

                <!-- Tautan Dokumen Pendukung Peserta -->
                <div class="p-3.5 bg-blue-50/70 border border-blue-200 rounded-xl flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-blue-900 block">Tautan Dokumen Pilar Terpilih:</span>
                        <a id="eval-doc-link" href="#" target="_blank" class="text-gold-600 font-bold hover:underline text-xs break-all">-</a>
                    </div>
                    <a id="eval-doc-btn" href="#" target="_blank" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-lg text-[10px] hover:bg-blue-700 transition shrink-0">
                        <i class="fas fa-external-link-alt"></i> Buka Link
                    </a>
                </div>

                <!-- Skor Nilai (0 - 100) -->
                <div>
                    <label class="block font-bold uppercase text-forest-900 text-[11px] mb-1.5">
                        Skor Nilai Evaluasi (0 - 100) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" id="eval-score" name="score" min="0" max="100" required placeholder="Contoh: 85" class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-base font-black text-forest-950 outline-none focus:border-gold-500">
                        <span class="absolute right-4 top-2.5 text-xs text-forest-700/60 font-bold">/ 100</span>
                    </div>
                </div>

                <!-- Catatan Evaluasi Lapangan -->
                <div>
                    <label class="block font-bold uppercase text-forest-900 text-[11px] mb-1.5">
                        Catatan & Rekomendasi Evaluasi Lapangan <span class="text-[10px] text-forest-700/60 font-normal">(Wajib Diisi)</span>
                    </label>
                    <textarea id="eval-notes" name="notes" rows="4" required placeholder="Berikan evaluasi terhadap implementasi pilar pada instansi peserta (misal: kesesuaian SOP pura, partisipasi gotong royong, efisiensi instalasi pengolahan limbah)..." class="w-full bg-beige-50 border border-beige-300 rounded-xl px-4 py-2.5 text-xs text-forest-950 outline-none focus:border-gold-500 leading-relaxed"></textarea>
                </div>

                <div class="flex justify-end gap-2.5 pt-3 border-t border-beige-200">
                    <button type="button" onclick="closeEvaluateModal()" class="px-5 py-2 bg-beige-200 hover:bg-beige-300 text-forest-900 rounded-full font-semibold transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 bg-gold-500 hover:bg-gold-400 text-forest-950 rounded-full font-bold shadow-sm transition cursor-pointer flex items-center gap-1.5">
                        <i class="fas fa-paper-plane"></i> Kirim Nilai ke Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- ==================== ASSESSOR PROPOSAL DETAIL MODAL ==================== -->
    <div id="modal-assessor-proposal-detail" class="fixed inset-0 bg-black/75 z-40 hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-beige-200 max-w-2xl w-full p-6 md:p-8 max-h-[90vh] overflow-y-auto relative flex flex-col">
            <button onclick="closeAssessorProposalDetail()" class="absolute top-4 right-4 p-2 text-forest-400 hover:text-forest-950 rounded-full transition cursor-pointer" aria-label="Tutup">
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
                            <span id="det-file-proposal-empty" class="text-red-500 font-medium hidden">Belum Unggah</span>
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
                <button onclick="closeAssessorProposalDetail()" class="px-6 py-2 bg-forest-900 text-white rounded-full text-xs font-bold hover:bg-forest-950 transition cursor-pointer">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
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

        // ==================== ASSESSOR EVALUATION MODAL JS ====================
        const modalEvaluate = document.getElementById('modal-assessor-evaluate');
        const formEvaluate = document.getElementById('form-assessor-evaluate');
        let currentItemForEvaluation = null;

        function openEvaluateModal(item) {
            if (!modalEvaluate) return;
            currentItemForEvaluation = item;
            document.getElementById('eval-inst-name').textContent = item.institution_name || '-';
            formEvaluate.action = `/assessor/proposal/evaluate/${item.id}`;

            // Check current assessor's pillar specialization from blade
            const userPillar = "{{ isset($currentAssessor) ? $currentAssessor->pillar_specialization : 'umum' }}";
            const pillarSelect = document.getElementById('eval-pillar');
            if (userPillar && userPillar !== 'umum') {
                pillarSelect.value = userPillar;
            } else {
                pillarSelect.value = 'parahyangan';
            }

            // Populate current existing score and notes for this pillar
            updatePillarDocLink();

            modalEvaluate.classList.remove('hidden');
            modalEvaluate.classList.add('flex');
        }

        function updatePillarDocLink() {
            if (!currentItemForEvaluation) return;
            const selectedPillar = document.getElementById('eval-pillar').value;
            const scoreInput = document.getElementById('eval-score');
            const notesInput = document.getElementById('eval-notes');
            const docLinkEl = document.getElementById('eval-doc-link');
            const docBtnEl = document.getElementById('eval-doc-btn');

            let link = '';
            let score = '';
            let notes = '';

            if (selectedPillar === 'parahyangan') {
                link = currentItemForEvaluation.link_parahyangan;
                score = currentItemForEvaluation.score_parahyangan;
                notes = currentItemForEvaluation.notes_parahyangan;
            } else if (selectedPillar === 'pawongan') {
                link = currentItemForEvaluation.link_pawongan;
                score = currentItemForEvaluation.score_pawongan;
                notes = currentItemForEvaluation.notes_pawongan;
            } else if (selectedPillar === 'palemahan') {
                link = currentItemForEvaluation.link_palemahan;
                score = currentItemForEvaluation.score_palemahan;
                notes = currentItemForEvaluation.notes_palemahan;
            }

            scoreInput.value = (score !== null && score !== undefined) ? score : '';
            notesInput.value = notes || '';

            if (link && link !== '-') {
                const fullLink = (!link.startsWith('http://') && !link.startsWith('https://')) ? 'https://' + link : link;
                docLinkEl.href = fullLink;
                docLinkEl.textContent = link;
                docBtnEl.href = fullLink;
                docBtnEl.classList.remove('opacity-50', 'pointer-events-none');
            } else {
                docLinkEl.href = '#';
                docLinkEl.textContent = 'Belum Ada Tautan Dokumen';
                docBtnEl.href = '#';
                docBtnEl.classList.add('opacity-50', 'pointer-events-none');
            }
        }

        function closeEvaluateModal() {
            if (!modalEvaluate) return;
            modalEvaluate.classList.add('hidden');
            modalEvaluate.classList.remove('flex');
        }
    </script>
</body>
</html>
