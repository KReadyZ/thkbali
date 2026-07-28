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
                                    <th class="py-3 px-4 text-right">Aksi</th>
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
                                            @if($prop->file_path && $prop->file_path !== '-')
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
                                        <td class="py-3 px-4 text-right flex items-center justify-end">
                                            <button onclick="openAssessorProposalDetail({{ json_encode($prop) }})" class="text-gold-600 hover:text-gold-500 font-bold text-xs cursor-pointer">
                                                Detail
                                            </button>
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
    </script>
</body>
</html>
