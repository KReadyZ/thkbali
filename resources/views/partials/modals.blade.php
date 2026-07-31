<!-- ==========================================================================
   MODALS CONTAINER
   ========================================================================== -->
   
<!-- 1. AUTH MODAL (Login / Register Tabs) -->
<div id="auth-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-forest-950/60 backdrop-blur-md opacity-100 transition-opacity duration-300 px-4">
    <div class="modal-dialog bg-white border border-forest-100/50 w-full max-w-lg rounded-[28px] overflow-hidden shadow-[0_25px_60px_-15px_rgba(4,28,21,0.25)] scale-95 opacity-0 transition-all duration-300 relative flex flex-col max-h-[90vh]">
        <!-- Close Button (Top Right) -->
        <button id="auth-modal-close" class="absolute top-5 right-5 z-20 p-2 text-forest-400 hover:text-forest-950 hover:bg-forest-50 rounded-full transition cursor-pointer" aria-label="Tutup">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Tabs Header (Pill Style Segmented Control) -->
        <div class="px-6 md:px-8 pt-8 pb-3">
            <div class="flex p-1 bg-forest-900/5 backdrop-blur-sm rounded-[18px] border border-forest-900/10">
                <button id="tab-login" class="flex-1 py-3 text-center text-xs font-bold tracking-wider uppercase rounded-[12px] bg-white shadow-sm text-forest-950 transition duration-300 focus:outline-none cursor-pointer">
                    Masuk Akun
                </button>
                <button id="tab-register" class="flex-1 py-3 text-center text-xs font-bold tracking-wider uppercase rounded-[12px] bg-transparent text-forest-400 hover:text-forest-800 transition duration-300 focus:outline-none cursor-pointer">
                    Daftar Baru
                </button>
            </div>
        </div>
        
        <!-- Modal Body content -->
        <div class="p-6 md:p-8 pt-2 space-y-6 overflow-y-auto flex-1">
            <!-- Auth Alert Notice -->
            <div id="auth-alert" class="hidden p-4 rounded-2xl text-xs font-bold transition-all duration-300 transform scale-95 opacity-0 flex items-start gap-3">
                <div class="shrink-0 mt-0.5" id="auth-alert-icon"></div>
                <div class="flex-1" id="auth-alert-msg"></div>
            </div>

            <!-- Login Form -->
            <form id="form-login" class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="login-email">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-forest-500">
                            <i class="far fa-envelope text-xs"></i>
                        </span>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-10 pr-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="email" id="login-email" required placeholder="nama@email.com">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="login-pass">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-forest-500">
                            <i class="fas fa-lock text-xs"></i>
                        </span>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-10 pr-10 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="password" id="login-pass" required placeholder="••••••••">
                        <button type="button" id="toggle-login-pass" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-forest-400 hover:text-forest-950 cursor-pointer transition">
                            <i class="far fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 text-forest-700 hover:text-forest-900 cursor-pointer select-none">
                        <input type="checkbox" class="accent-forest-500 cursor-pointer border-slate-300 rounded-md"> Ingat saya
                    </label>
                    <a href="#" id="btn-forgot-password" class="text-forest-600 hover:text-forest-800 transition hover:underline font-medium">Lupa Password?</a>
                </div>
                <button type="submit" class="w-full py-3.5 bg-forest-500 hover:bg-forest-600 active:scale-[0.99] hover:scale-[1.01] text-white rounded-2xl transition-all duration-300 text-sm shadow-lg shadow-forest-500/10 hover:shadow-xl hover:shadow-forest-500/20 font-bold cursor-pointer mt-4">
                    Masuk Sekarang
                </button>
            </form>

            <!-- Reset Password Form -->
            <form id="form-reset-password" class="space-y-4 hidden">
                <div class="mb-2 bg-forest-50/50 p-4 border border-forest-100 rounded-2xl">
                    <p class="text-xs text-forest-800 leading-relaxed">Masukkan alamat email terdaftar Anda dan kata sandi baru untuk mengatur ulang kata sandi Anda secara langsung.</p>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reset-email">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-forest-500">
                            <i class="far fa-envelope text-xs"></i>
                        </span>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-10 pr-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="email" id="reset-email" required placeholder="nama@email.com">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reset-pass">Kata Sandi Baru</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-forest-500">
                            <i class="fas fa-lock text-xs"></i>
                        </span>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-10 pr-10 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="password" id="reset-pass" required placeholder="••••••••">
                        <button type="button" id="toggle-reset-pass" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-forest-400 hover:text-forest-950 cursor-pointer transition">
                            <i class="far fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reset-pass-confirm">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-forest-500">
                            <i class="fas fa-lock text-xs"></i>
                        </span>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-10 pr-10 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="password" id="reset-pass-confirm" required placeholder="••••••••">
                        <button type="button" id="toggle-reset-pass-confirm" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-forest-400 hover:text-forest-950 cursor-pointer transition">
                            <i class="far fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-between text-xs pt-1">
                    <button type="button" id="btn-back-to-login" class="text-forest-600 hover:text-forest-800 transition hover:underline font-medium">
                        Kembali ke Masuk
                    </button>
                </div>
                <button type="submit" class="w-full py-3.5 bg-forest-500 hover:bg-forest-600 active:scale-[0.99] hover:scale-[1.01] text-white rounded-2xl transition-all duration-300 text-sm shadow-lg shadow-forest-500/10 hover:shadow-xl hover:shadow-forest-500/20 font-bold cursor-pointer mt-4">
                    Ubah Kata Sandi
                </button>
            </form>
            
            <!-- Register Form -->
            <form id="form-register" class="space-y-4 hidden" enctype="multipart/form-data">
                <div>
                    <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-role">Daftar Sebagai</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-forest-500">
                            <i class="fas fa-users-cog text-xs"></i>
                        </span>
                        <select class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-10 pr-8 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition appearance-none cursor-pointer" id="reg-role" name="role" onchange="toggleRegisterFields()">
                            <option value="peserta" selected>Peserta / Pendaftar THK Awards</option>
                            <option value="umum">Masyarakat Umum</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-forest-500 pointer-events-none">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <!-- Fields for Peserta (Pendaftaran & Bukti Bayar) -->
                <div id="register-fields-peserta" class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-inst-name">Nama Instansi / Perusahaan</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-inst-name" name="institution_name" placeholder="Contoh: Hotel Grand Bali">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-inst-cat">Kategori Penghargaan</label>
                        <div class="relative">
                            <select class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl pl-4 pr-10 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition appearance-none cursor-pointer" id="reg-inst-cat" name="category">
                                <option value="Akomodasi" selected>Akomodasi / Perhotelan</option>
                                <option value="Destinasi">Destinasi Wisata</option>
                                <option value="Restoran">Restoran / Kuliner</option>
                                <option value="Lembaga Pendidikan">Kategori Pendidikan</option>
                                <option value="Desa Adat">Desa Adat</option>
                                <option value="Individu">Kategori Individu</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-forest-500 pointer-events-none">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-inst-address">Alamat Lengkap Perusahaan / Lembaga</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-inst-address" name="address" placeholder="Contoh: Jl. Sunset Road No. 99, Kuta">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-inst-gmaps">Link Google Maps <span class="text-[9px] text-forest-600/70 font-normal">(Opsional)</span></label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="url" id="reg-inst-gmaps" name="gmaps_link" placeholder="Contoh: https://maps.app.goo.gl/xxxx">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-cp-name">Nama Kontak Person (CP)</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-cp-name" name="contact_name" placeholder="Nama Lengkap CP">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-cp-wa">No. WhatsApp CP</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-cp-wa" name="contact_wa" placeholder="Contoh: 08123456789">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-cp-email">Email CP</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="email" id="reg-cp-email" name="contact_email" placeholder="nama.cp@email.com">
                    </div>

                    <!-- Struktur Tim THK -->
                    <div class="border-t border-slate-200 pt-5 mt-5 space-y-4">
                        <h4 class="text-xs font-bold text-forest-900 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fas fa-users text-gold-600"></i> Struktur Tim THK Perusahaan / Lembaga
                        </h4>
                        
                        <!-- Ketua Tim THK -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-thk-leader-name">Ketua Tim THK (Nama) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-thk-leader-name" name="thk_leader_name" placeholder="Nama Ketua Tim">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-thk-leader-wa">Ketua Tim THK (No. WA) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-thk-leader-wa" name="thk_leader_wa" placeholder="Contoh: 08123456789">
                            </div>
                        </div>

                        <!-- PIC Bidang Parahyangan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-pic-parahyangan-name">PIC Parahyangan (Nama) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-pic-parahyangan-name" name="pic_parahyangan_name" placeholder="Nama PIC Parahyangan">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-pic-parahyangan-wa">PIC Parahyangan (No. WA) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-pic-parahyangan-wa" name="pic_parahyangan_wa" placeholder="Contoh: 08123456789">
                            </div>
                        </div>

                        <!-- PIC Bidang Pawongan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-pic-pawongan-name">PIC Pawongan (Nama) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-pic-pawongan-name" name="pic_pawongan_name" placeholder="Nama PIC Pawongan">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-pic-pawongan-wa">PIC Pawongan (No. WA) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-pic-pawongan-wa" name="pic_pawongan_wa" placeholder="Contoh: 08123456789">
                            </div>
                        </div>

                        <!-- PIC Bidang Palemahan -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 border-b border-slate-200 pb-5">
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-pic-palemahan-name">PIC Palemahan (Nama) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-pic-palemahan-name" name="pic_palemahan_name" placeholder="Nama PIC Palemahan">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-forest-800 uppercase tracking-wide mb-1" for="reg-pic-palemahan-wa">PIC Palemahan (No. WA) <span class="text-[8px] text-forest-600/70 font-normal">(Opsional)</span></label>
                                <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-pic-palemahan-wa" name="pic_palemahan_wa" placeholder="Contoh: 08123456789">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-prev-acc">Hasil Akreditasi Sebelumnya <span class="text-[9px] text-forest-600/70 font-normal">(Opsional)</span></label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 cursor-pointer file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100 transition" type="file" id="reg-prev-acc" name="prev_accreditation" accept="image/*,.pdf">
                    </div>

                    <!-- Tampilan Pembayaran -->
                    <div class="mt-4 space-y-2">
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase">Informasi Pembayaran Pendaftaran</label>
                        <div class="bg-forest-50/40 rounded-2xl border border-forest-100 p-5 space-y-4 text-center">
                            <!-- QR Code -->
                            <div id="pay-qr-container" class="hidden flex justify-center">
                                <img id="pay-qr-img" src="" alt="QR Pembayaran" class="w-36 h-36 object-contain rounded-2xl border border-forest-100 shadow-sm bg-white">
                            </div>
                            <div id="pay-qr-placeholder" class="flex flex-col items-center gap-1.5 text-forest-500/40">
                                <i class="fas fa-spinner fa-spin text-xl"></i>
                                <span class="text-[10px]">Memuat info pembayaran...</span>
                            </div>

                            <!-- Bank Info -->
                            <div class="space-y-1.5" id="pay-bank-info">
                                <div class="text-[10px] font-bold text-forest-700/60 uppercase tracking-widest">Transfer ke:</div>
                                <div id="pay-bank-name" class="text-lg font-black text-forest-900">-</div>
                                <div id="pay-account-number" class="text-xl font-black text-gold-600 tracking-widest select-all">-</div>
                                <div id="pay-account-name" class="text-xs font-semibold text-forest-700 font-sans">a/n -</div>
                                <div class="mt-2 py-1.5 px-3.5 bg-forest-100/50 rounded-xl border border-forest-200 inline-block mx-auto">
                                    <span class="text-xs font-bold text-forest-800">Biaya Pendaftaran: <span id="pay-amount" class="text-sm font-black text-forest-900">-</span></span>
                                </div>
                            </div>
                            <p id="pay-description" class="text-[10px] text-forest-700/70 leading-relaxed hidden"></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-payment-proof">Bukti Pembayaran Pendaftaran <span class="text-[9px] text-forest-600/70 font-normal">(Opsional)</span></label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-2.5 text-forest-950 text-xs outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 cursor-pointer file:mr-4 file:py-1.5 file:px-3.5 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100 transition" type="file" id="reg-payment-proof" name="payment_proof" accept="image/*,.pdf">
                    </div>
                </div>

                <!-- Fields for Umum -->
                <div id="register-fields-umum" class="space-y-4 hidden">
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-name">Nama Lengkap</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="text" id="reg-name" name="name" placeholder="Nama Lengkap Anda">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-email">Alamat Email</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="email" id="reg-email" name="email" placeholder="nama@email.com">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-forest-900 tracking-wider uppercase mb-1.5" for="reg-pass">Kata Sandi Baru</label>
                        <input class="w-full bg-slate-50/50 border border-slate-200 rounded-2xl px-4 py-3 text-forest-950 text-sm outline-none focus:border-forest-500 focus:ring-4 focus:ring-forest-500/5 transition placeholder-slate-300" type="password" id="reg-pass" name="password" placeholder="Min. 8 karakter">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-forest-500 hover:bg-forest-600 active:scale-[0.99] hover:scale-[1.01] text-white rounded-2xl transition-all duration-300 text-sm shadow-lg shadow-forest-500/10 hover:shadow-xl hover:shadow-forest-500/20 font-bold cursor-pointer mt-4">
                    Kirim Pendaftaran
                </button>
            </form>
        </div>
    </div>
</div>
<!-- 2. CONTACT / HUBUNGI KAMI MODAL -->
<div id="contact-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/75 backdrop-blur-md opacity-100 transition-opacity duration-300 px-4">
    <div class="modal-dialog bg-forest-900 border border-gold-500/30 w-full max-w-lg rounded-3xl overflow-hidden shadow-2xl scale-95 opacity-0 transition-all duration-300">
        <div class="p-6 md:p-8">
            <h3 class="font-serif text-2xl font-bold text-white mb-2">Hubungi Tim THK Bali</h3>
            <p class="text-white/60 text-xs font-light leading-relaxed mb-6">
                Kirimkan pesan Anda untuk pengajuan pendaftaran, undangan asesor, akses admin platform, atau pertanyaan umum seputar program Tri Hita Karana.
            </p>
            
            <form id="contact-form" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-white/70 uppercase mb-1.5" for="c-name">Nama</label>
                        <input class="w-full bg-forest-950 border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition" type="text" id="c-name" required placeholder="Nama Lengkap">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-white/70 uppercase mb-1.5" for="c-email">Email</label>
                        <input class="w-full bg-forest-950 border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition" type="email" id="c-email" required placeholder="email@example.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-white/70 uppercase mb-1.5" for="c-subject">Subjek</label>
                    <select class="w-full bg-forest-950 border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition" id="c-subject">
                        <option value="pendaftaran">Pendaftaran THK Awards</option>
                        <option value="asesor">Undangan / Verifikasi Asesor</option>
                        <option value="admin">Akses Admin Internal</option>
                        <option value="kemitraan">Kemitraan & Sponsorship</option>
                        <option value="pertanyaan">Pertanyaan Umum</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-white/70 uppercase mb-1.5" for="c-msg">Pesan / Pengajuan</label>
                    <textarea rows="4" class="w-full bg-forest-950 border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition resize-none" id="c-msg" required placeholder="Tulis rincian pesan atau deskripsi peran yang diajukan..."></textarea>
                </div>
                
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/5">
                    <button type="button" id="contact-modal-close" class="px-5 py-2.5 rounded-full border border-white/10 text-white/75 hover:bg-white/5 text-sm transition">Batal</button>
                    <button type="submit" class="px-6 py-2.5 bg-gold-500 text-forest-950 font-bold rounded-full hover:bg-gold-400 hover:shadow-lg hover:shadow-gold-500/20 transition duration-300 text-sm">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 3. GALLERY LIGHTBOX MODAL -->
<div id="gallery-lightbox" class="fixed inset-0 z-50 hidden bg-black/95 items-center justify-center p-4 transition-opacity duration-300 opacity-0">
    <!-- Close button top-right -->
    <button id="lightbox-close" class="absolute top-6 right-6 text-white hover:text-gold-400 p-2 focus:outline-none" aria-label="Close Lightbox">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Left Nav Arrow Button -->
    <button id="lightbox-prev" class="absolute left-4 md:left-8 top-1/2 transform -translate-y-1/2 text-white/80 hover:text-gold-400 p-3 bg-white/5 hover:bg-white/10 rounded-full border border-white/10 transition z-10" aria-label="Previous Image">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <!-- Main Media Container -->
    <div class="max-w-4xl w-full flex flex-col items-center select-none">
        <img id="lightbox-image" src="" alt="Lightbox image" class="max-h-[75vh] max-w-full rounded-2xl object-contain shadow-2xl border border-white/5">
        <p id="lightbox-caption" class="text-white/90 text-sm md:text-base font-medium font-serif mt-6 text-center tracking-wide"></p>
    </div>

    <!-- Right Nav Arrow Button -->
    <button id="lightbox-next" class="absolute right-4 md:right-8 top-1/2 transform -translate-y-1/2 text-white/80 hover:text-gold-400 p-3 bg-white/5 hover:bg-white/10 rounded-full border border-white/10 transition z-10" aria-label="Next Image">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
</div>

<!-- ==========================================================================
   4. PILAR DETAIL DRAWER (SLIDE-OVER FROM RIGHT)
   ========================================================================== -->
<!-- Drawer Backdrop -->
<div id="pilar-drawer-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden opacity-0 transition-opacity duration-300"></div>

<!-- Drawer Container -->
<div id="pilar-drawer" class="fixed top-0 right-0 h-full w-full max-w-lg bg-forest-950 border-l border-gold-500/20 text-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-out flex flex-col">
    <!-- Header -->
    <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
        <div>
            <span id="drawer-badge" class="text-gold-500 text-xs font-semibold tracking-wider uppercase block mb-1">Pilar Tri Hita Karana</span>
            <h3 id="drawer-title" class="font-serif text-2xl font-bold tracking-wide">Pilar Detail</h3>
        </div>
        <button id="pilar-drawer-close" class="p-2 text-white/70 hover:text-gold-400 hover:bg-white/5 rounded-full transition" aria-label="Tutup Detail">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Scrollable Body Content -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6">
        <!-- Content for Parahyangan -->
        <div id="drawer-content-parahyangan" class="pilar-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/parahyangan.png') }}" 
                     alt="Parahyangan Bali Temple" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Parahyangan</strong> adalah pilar pertama dalam Tri Hita Karana yang memfokuskan pada hubungan harmonis antara manusia dengan Tuhan Yang Maha Esa (Sang Hyang Widhi Wasa). Filosofi ini menegaskan bahwa segala bentuk kehidupan dan keberadaan berasal dari sumber spiritual yang sama, sehingga kesadaran spiritual harus senantiasa dijaga.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Konsep & Landasan Filosofis</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Sradha & Bhakti:</strong> Landasan dasar berupa keyakinan yang kuat (Sradha) dan pengabdian yang tulus ikhlas (Bhakti) kepada Pencipta dalam setiap aspek kehidupan.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Yadnya (Persembahan Suci):</strong> Upaya persembahan rohani yang didasarkan pada rasa syukur mendalam atas napas kehidupan dan berkah alam semesta yang diberikan.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Karma Phala:</strong> Kesadaran bahwa setiap tindakan yang selaras dengan dharma (kebenaran rohani) akan membawa buah kebaikan bagi jiwa.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Implementasi dalam Kehidupan Bali</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Tri Sandhya & Sembahyang</span>
                        Menghubungkan diri dengan Pencipta secara rutin 3 kali sehari serta bersembahyang pada hari suci (Purnama, Tilem, Galungan, Kuningan).
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Pemeliharaan Pura & Tempat Suci</span>
                        Bergotong royong (Ngayah) menjaga kesucian dan kebersihan Pura Kahyangan Tiga di desa maupun pelinggih keluarga masing-masing.
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Upacara & Yadnya Harian (Mesaiban)</span>
                        Persembahan kecil sehari-hari setelah memasak sebagai wujud syukur dan penghormatan terhadap kehidupan sebelum kita menikmatinya.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Pawongan -->
        <div id="drawer-content-pawongan" class="pilar-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/pawongan.png') }}" 
                     alt="Pawongan Balinese Community" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Pawongan</strong> adalah pilar kedua yang menekankan pentingnya menjaga hubungan harmonis antara sesama manusia. Dalam falsafah Bali, kebahagiaan sejati tidak akan tercapai tanpa adanya perdamaian, saling menghormati, dan kebersamaan di dalam kehidupan bermasyarakat.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Konsep & Landasan Filosofis</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Tat Twam Asi:</strong> Berarti "Aku adalah kamu, kamu adalah aku." Falsafah empati yang mengajarkan bahwa menyakiti sesama manusia sama dengan menyakiti diri sendiri.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Menyama Braya:</strong> Semangat persaudaraan yang menganggap seluruh anggota masyarakat sebagai keluarga besar yang saling memiliki tanggung jawab sosial.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Vasudhaiva Kutumbakam:</strong> Falsafah universal yang menegaskan bahwa seluruh umat manusia di bumi ini adalah satu keluarga tunggal tanpa membeda-bedakan golongan.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Implementasi dalam Kehidupan Bali</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Sistem Krama Banjar & Gotong Royong</span>
                        Masyarakat adat aktif berkumpul di Banjar untuk bermusyawarah (Sangkep) dan bahu-membahu dalam kegiatan sosial maupun duka (Nyanggra).
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Saling Menghargai & Berbagi (Mebat)</span>
                        Tradisi memasak bersama dan saling membagikan makanan (Ngejot) saat hari raya keagamaan, mempererat tali persaudaraan antar-tetangga.
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Penyelesaian Konflik melalui Perdamaian</span>
                        Mengutamakan dialog kekeluargaan di bawah bimbingan tetua adat/prajuru desa untuk menjaga keharmonisan internal warga desa adat.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Palemahan -->
        <div id="drawer-content-palemahan" class="pilar-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/palemahan.png') }}" 
                     alt="Palemahan Subak Rice Fields" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Palemahan</strong> adalah pilar ketiga dalam Tri Hita Karana yang memfokuskan hubungan harmonis antara manusia dengan alam sekitar. Manusia Bali menyadari bahwa alam semesta adalah ibu kandung yang memberi kehidupan, sehingga wajib dilestarikan demi kelangsungan generasi mendatang.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Konsep & Landasan Filosofis</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Sad Kertih:</strong> Upaya penyucian dan pelestarian enam sumber daya alam utama, termasuk penyucian laut (Segara Kertih), gunung (Wana Kertih), dan sumber air (Danu Kertih).
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Tumpek Uduh & Tumpek Kandang:</strong> Hari pemuliaan khusus bagi flora (tumbuh-tumbuhan) dan fauna (hewan), wujud kesadaran ekologis yang tinggi untuk melindungi keanekaragaman hayati.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Sistem Subak:</strong> Sistem irigasi pertanian tradisional Bali warisan UNESCO yang mengutamakan keadilan pembagian air, pelestarian ekosistem sawah, dan upacara keagamaan.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Implementasi dalam Kehidupan Bali</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Konservasi Hutan Adat (Hutan Lindung)</span>
                        Menghormati kawasan hutan sakral (Wana Kertih) dan melarang keras penebangan liar demi menjaga pasokan air bawah tanah Bali.
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Pengelolaan Pertanian Organik Subak</span>
                        Melindungi pola rotasi tanam tradisional Bali dan meminimalkan pestisida kimia guna merawat kesuburan tanah sawah secara abadi.
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Hari Raya Nyepi (Pemulihan Ekologis)</span>
                        Satu hari penuh bebas polusi udara, suara, dan cahaya, memberikan waktu bagi bumi untuk bernapas dan memulihkan ekosistem secara alami.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Action -->
    <div class="px-6 py-4 bg-forest-950 border-t border-white/10 flex justify-end">
        <button id="pilar-drawer-action" class="px-6 py-2.5 bg-gold-500 text-forest-950 font-bold rounded-full hover:bg-gold-400 transition-all duration-300 text-sm">
            Tutup Detail
        </button>
    </div>
</div>

<!-- ==========================================================================
   5. THK AWARDS DETAIL DRAWER (SLIDE-OVER FROM RIGHT)
   ========================================================================== -->
<!-- Drawer Backdrop -->
<div id="award-drawer-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden opacity-0 transition-opacity duration-300"></div>

<!-- Drawer Container -->
<div id="award-drawer" class="fixed top-0 right-0 h-full w-full md:w-[450px] bg-forest-950 border-l border-gold-500/20 text-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-out flex flex-col overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
        <div>
            <span id="award-drawer-badge" class="text-gold-500 text-xs font-semibold tracking-wider uppercase block mb-1">Kategori THK Awards</span>
            <h3 id="award-drawer-title" class="font-serif text-2xl font-bold tracking-wide">Kategori Detail</h3>
        </div>
        <button id="award-drawer-close" class="p-2 text-white/70 hover:text-gold-400 hover:bg-white/5 rounded-full transition" aria-label="Tutup Detail">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Scrollable Body Content -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6">
        <!-- Content for Desa Adat -->
        <div id="drawer-content-desa-adat" class="award-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/Kategori desa adat.jpg') }}" 
                     alt="Kategori Desa Adat" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Kategori Desa Adat</strong> diberikan kepada desa adat di Bali yang telah secara nyata mempertahankan dan mempraktikkan filosofi Tri Hita Karana dalam kehidupan sehari-hari demi kelestarian budaya dan alam setempat.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Aspek Penilaian & Hubungan THK</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Parahyangan (Keagamaan):</strong> Pengelolaan Pura Kahyangan Tiga, pelaksanaan ritual berkala, serta pelestarian seni keagamaan dan adat.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Pawongan (Sosial):</strong> Kerukunan masyarakat adat, gotong-royong, musyawarah banjar (sangkep), dan keharmonisan hubungan sosial antar-warga.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Palemahan (Lingkungan):</strong> Tata ruang hijau desa adat, kelestarian sistem irigasi Subak, perlindungan sumber air, serta kebersihan lingkungan dari sampah.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Kriteria Kelayakan Khusus</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Aktivitas Gotong Royong (Ngayah)</span>
                        Adanya partisipasi tinggi krama desa dalam kegiatan pelestarian pura, seni, budaya, dan lingkungan tanpa paksaan.
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Awig-Awig & Peraturan Desa Adat</span>
                        Desa memiliki peraturan adat tertulis (Awig-awig) atau tidak tertulis (Pararem) yang menegakkan hukum adat untuk menjaga kelestarian alam dan perdamaian warga.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Individu -->
        <div id="drawer-content-individu" class="award-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/Kategori Individu.jpg') }}" 
                     alt="Kategori Individu" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Kategori Individu</strong> merupakan penghargaan tertinggi bagi perorangan (tokoh masyarakat, budayawan, akademisi, aktivis lingkungan) yang mendedikasikan hidupnya demi menjaga kerukunan, tradisi, dan alam Bali.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Aspek Penilaian & Hubungan THK</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Parahyangan:</strong> Keteladanan spiritual, pembinaan umat, serta kontribusi aktif dalam pelestarian nilai kesucian pura dan sastra suci.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Pawongan:</strong> Pengabdian sosial tanpa pamrih, pemberdayaan ekonomi atau pendidikan warga sekitar, dan pelopor perdamaian.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Palemahan:</strong> Pelopor penyelamatan lingkungan, pelestari satwa langka, aktivis pengurangan limbah/plastik, atau penggerak ketahanan pangan lokal.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Kriteria Kelayakan Khusus</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Dampak & Rekam Jejak Kegiatan</span>
                        Memiliki rekam jejak kegiatan minimal 3 tahun berturut-turut yang berdampak nyata bagi masyarakat adat setempat.
                    </div>
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Inspirasi & Kepemimpinan</span>
                        Mampu menginspirasi generasi muda Bali untuk peduli terhadap kebudayaan dan keseimbangan ekologi Bali.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Lembaga Pendidikan -->
        <div id="drawer-content-lembaga-pendidikan" class="award-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/kategori pendidikan.png') }}" 
                     alt="Kategori Lembaga Pendidikan" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Kategori Lembaga Pendidikan</strong> dianugerahkan kepada sekolah, universitas, atau lembaga pendidikan formal yang sukses mengintegrasikan nilai-nilai kearifan lokal Tri Hita Karana ke dalam kurikulum pembelajaran, etika akademik, dan aksi nyata pelestarian lingkungan kampus.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Aspek Penilaian & Hubungan THK</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Parahyangan:</strong> Ketersediaan sarana ibadah/pura sekolah yang kondusif, pelaksanaan ritual keagamaan rutin untuk siswa (seperti piodalan), dan penanaman budi pekerti luhur.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Pawongan:</strong> Hubungan kekeluargaan yang harmonis antara guru, siswa, dan staf, sistem konseling ramah anak, serta keterlibatan sosial dengan desa adat sekitar.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Palemahan:</strong> Area kampus hijau (green campus), program pemilahan sampah sekolah, penataan taman asri, dan larangan penggunaan plastik sekali pakai.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Kriteria Kelayakan Khusus</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Kurikulum Berbasis Kearifan Lokal</span>
                        Memiliki muatan pelajaran lokal atau kajian sains ekologi tradisional Bali yang diajarkan secara terstruktur kepada siswa.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Akomodasi -->
        <div id="drawer-content-akomodasi" class="award-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/akomodasi.png') }}" 
                     alt="Kategori Akomodasi" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Kategori Akomodasi</strong> ditujukan bagi hotel, resort, vila, atau homestay di Bali yang berhasil menyelaraskan layanan pariwisata berstandar internasional dengan pelestarian tradisi lokal, pemberdayaan pekerja adat, serta tata ruang bangunan berkonsep ramah lingkungan.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Aspek Penilaian & Hubungan THK</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Parahyangan:</strong> Adanya pelinggih/pura penunggun karang di area akomodasi, ketersediaan sesaji harian, dan dukungan upacara piodalan adat setempat.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Pawongan:</strong> Kesejahteraan dan hak-hak karyawan lokal banjar sekitar, kemitraan produk lokal Bali, dan hubungan harmonis dengan masyarakat sekitar hotel.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Palemahan:</strong> Sistem pengolahan air limbah mandiri (WWTP), efisiensi energi listrik/lampu LED, arsitektur arsitek Bali tradisional, dan penataan kebun asri penunjang flora lokal.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Kriteria Kelayakan Khusus</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Standardisasi Hijau (Green Policy)</span>
                        Memiliki kebijakan tertulis yang mewajibkan pengurangan emisi karbon dan pemilahan sampah organik & non-organik di lingkungan kerja.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Destinasi -->
        <div id="drawer-content-destinasi" class="award-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/destinasi.png') }}" 
                     alt="Kategori Destinasi" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Kategori Destinasi</strong> diberikan kepada pengelola objek wisata alam, budaya, maupun taman rekreasi di Bali yang mampu menyuguhkan keindahan pariwisata dengan tetap menjaga kesucian tata ruang spiritual, kelestarian ekosistem alamiah, serta kenyamanan pelayanan pengunjung.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Aspek Penilaian & Hubungan THK</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Parahyangan:</strong> Menjaga kesucian kawasan pura atau situs sakral di area destinasi wisata serta menyediakan panduan tata tertib berpakaian bagi wisatawan.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Pawongan:</strong> Pelibatan kelompok pemandu lokal, pembagian hasil retribusi tiket untuk desa adat, dan ketertiban penataan pedagang lokal agar rapi.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Palemahan:</strong> Kebersihan area toilet dan pedestrian, zonasi bebas kendaraan bermotor, pelestarian hutan/pantai/sawah dari pencemaran sampah plastik.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Kriteria Kelayakan Khusus</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Zona Perlindungan Ekologis</span>
                        Memiliki komitmen tata kelola bebas emisi atau pemulihan habitat alami flora/fauna endemik lokal yang dilindungi.
                    </div>
                </div>
            </div>
        </div>

        <!-- Content for Restoran -->
        <div id="drawer-content-restoran" class="award-content-section hidden space-y-6">
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img src="{{ asset('images/restoran.png') }}" 
                     alt="Kategori Restoran" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>
            
            <div class="space-y-4">
                <p class="text-white/80 leading-relaxed text-sm md:text-base">
                    <strong class="text-gold-400 font-serif text-lg">Kategori Restoran</strong> mengapresiasi pelaku usaha kuliner, rumah makan, atau kafe di Bali yang sukses menyajikan menu sehat berbasis bahan pangan lokal organik (farm-to-table), memiliki sistem pengelolaan limbah dapur mandiri, serta menghadirkan nuansa etnik Bali yang asri.
                </p>
                
                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Aspek Penilaian & Hubungan THK</h4>
                <ul class="space-y-3">
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Parahyangan:</strong> Rasa syukur atas rezeki pangan dengan ketersediaan pelinggih sesaji di restoran dan pelaksanaan ritual Tumpek Landep/Tumpek Wariga.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Pawongan:</strong> Keramahtamahan servis khas Bali, pemberdayaan koki dan pelayan lokal, serta kemitraan dengan petani organik lokal daerah setempat.
                        </div>
                    </li>
                    <li class="flex gap-3 text-sm">
                        <span class="text-gold-500 font-bold text-base mt-0.5">•</span>
                        <div>
                            <strong class="text-white">Palemahan:</strong> Pengurangan kemasan plastik makanan, pemilahan sisa sampah dapur menjadi kompos organik, penggunaan bahan dekorasi interior bambu/kayu alami.
                        </div>
                    </li>
                </ul>

                <h4 class="font-serif text-gold-400 text-lg font-semibold border-b border-white/10 pb-2">Kriteria Kelayakan Khusus</h4>
                <div class="grid grid-cols-1 gap-3 text-xs md:text-sm">
                    <div class="p-4 bg-white/5 rounded-xl border border-white/10 hover:border-gold-500/30 transition">
                        <span class="text-gold-500 font-semibold block mb-1">Daur Ulang Sampah Organik (Composting)</span>
                        Memiliki area/alat khusus untuk memproses sisa makanan dapur menjadi pupuk tanaman bermanfaat secara konsisten.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Action -->
    <div class="px-6 py-4 bg-forest-950 border-t border-white/10 flex items-center justify-between">
        <button id="award-drawer-see-villages" class="px-5 py-2.5 bg-transparent border border-gold-500 text-gold-500 hover:bg-gold-500 hover:text-forest-950 font-bold rounded-full transition-all duration-300 text-xs md:text-sm cursor-pointer">
            Lihat Penerima
        </button>
        <button id="award-drawer-action" class="px-6 py-2.5 bg-gold-500 text-forest-950 font-bold rounded-full hover:bg-gold-400 transition-all duration-300 text-xs md:text-sm cursor-pointer">
            Tutup Detail
        </button>
    </div>
</div>

<!-- Sliding Awardee Villages Panel (Slides from left side of screen) -->
<div id="awardee-villages-panel" class="fixed top-0 left-0 h-full w-full md:w-[calc(100%-450px)] bg-forest-950 border-r border-gold-500/20 text-white shadow-2xl z-50 flex flex-col transition-transform duration-300 ease-out" style="transform: translateX(-100%);">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
            <div>
                <span class="text-gold-500 text-xs font-semibold tracking-wider uppercase block mb-1">Desa Penerima</span>
                <h3 class="font-serif text-xl font-bold tracking-wide text-white">Penerima THK Awards</h3>
            </div>
            <button id="awardee-villages-panel-back" class="p-2 text-white/70 hover:text-gold-400 hover:bg-white/5 rounded-full transition cursor-pointer" aria-label="Kembali">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </button>
        </div>

        <!-- Panel Body Content -->
        <div class="flex-1 overflow-y-auto p-6 space-y-5">
            <!-- Dropdown Select Form -->
            <div class="space-y-2 text-left">
                <label class="block text-xs font-semibold uppercase tracking-wider text-white/70" for="awardee-village-select">Pilih Penerima / Desa Adat:</label>
                <select id="awardee-village-select" class="w-full bg-forest-900 border border-white/20 rounded-2xl px-4 py-3 text-white text-sm outline-none focus:border-gold-500 focus:ring-1 focus:ring-gold-500/30 transition">
                    <option value="" disabled selected>-- Pilih Penerima --</option>
                    @foreach($awardees as $aw)
                        <option value="{{ $aw->id }}">{{ $aw->name }} ({{ $aw->medal }} - {{ $aw->year }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Information Card (Populated Dynamically via JS) -->
            <div id="awardee-village-detail" class="hidden space-y-5 text-left">
                <div class="relative rounded-2xl overflow-hidden h-40 border border-white/10">
                    <img id="awardee-detail-image" src="" alt="Desa Adat" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
                    <!-- Medal Badge -->
                    <span id="awardee-detail-medal" class="absolute top-3 right-3 px-3 py-1 bg-gold-500 text-forest-950 text-[10px] font-bold rounded-full uppercase tracking-wider"></span>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 id="awardee-detail-name" class="font-serif text-white text-lg font-bold"></h4>
                        <span id="awardee-detail-year" class="text-xs text-white/50 block"></span>
                    </div>

                    <p id="awardee-detail-desc" class="text-white/70 text-xs leading-relaxed font-light"></p>

                    <!-- Achievements Per Pillar -->
                    <div class="space-y-3 pt-2">
                        <h5 class="font-serif text-gold-400 text-sm font-semibold border-b border-white/10 pb-1">Detail Pencapaian 3 Pilar THK:</h5>
                        
                        <div class="space-y-2.5">
                            <div class="text-xs p-3 bg-white/5 rounded-xl border border-white/5">
                                <strong class="text-white block mb-0.5">Parahyangan (Ritual/Keagamaan):</strong>
                                <span id="awardee-detail-parahyangan" class="text-white/70 font-light"></span>
                            </div>
                            <div class="text-xs p-3 bg-white/5 rounded-xl border border-white/5">
                                <strong class="text-white block mb-0.5">Pawongan (Hubungan Sosial):</strong>
                                <span id="awardee-detail-pawongan" class="text-white/70 font-light"></span>
                            </div>
                            <div class="text-xs p-3 bg-white/5 rounded-xl border border-white/5">
                                <strong class="text-white block mb-0.5">Palemahan (Alam/Lingkungan):</strong>
                                <span id="awardee-detail-palemahan" class="text-white/70 font-light"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome/Instruction Placeholder -->
            <div id="awardee-village-placeholder" class="text-center py-10 space-y-3">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-white/5 rounded-full border border-white/10 text-white/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-xs text-white/40 max-w-[240px] mx-auto">Silakan pilih desa adat dari dropdown di atas untuk melihat detail dokumentasi dan aspek penilaian THK.</p>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================================================
   5. NEWS DETAIL DRAWER (SLIDE-OVER FROM RIGHT)
   ========================================================================== -->
<!-- Drawer Backdrop -->
<div id="news-drawer-backdrop" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden opacity-0 transition-opacity duration-300"></div>

<!-- Drawer Container -->
<div id="news-drawer" class="fixed top-0 right-0 h-full w-full max-w-lg bg-forest-950 border-l border-gold-500/20 text-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-out flex flex-col">
    <!-- Header -->
    <div class="px-6 py-5 border-b border-white/10 flex items-center justify-between">
        <div>
            <span id="news-drawer-badge" class="text-gold-500 text-xs font-semibold tracking-wider uppercase block mb-1">Berita Pilihan</span>
            <h3 id="news-drawer-title" class="font-serif text-2xl font-bold tracking-wide">Detail Berita</h3>
        </div>
        <button id="news-drawer-close" class="p-2 text-white/70 hover:text-gold-400 hover:bg-white/5 rounded-full transition" aria-label="Tutup Detail">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Scrollable Body Content -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6">
        <div id="news-drawer-body" class="space-y-6">
            <!-- Image Header inside Drawer -->
            <div class="relative rounded-2xl overflow-hidden h-56 border border-white/10">
                <img id="news-drawer-image" src="" alt="News Image" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-transparent to-transparent"></div>
            </div>

            <!-- Date and Meta -->
            <div class="flex items-center justify-between text-xs text-white/60 pb-2 border-b border-white/10">
                <div class="flex items-center gap-2">
                    <span id="news-drawer-date" class="font-medium">12 Jun 2026</span>
                    <span class="text-white/30">•</span>
                    <span id="news-drawer-views" class="text-white/70"><i class="far fa-eye mr-1"></i>0 dibaca</span>
                </div>
                <span id="news-drawer-category" class="px-2.5 py-0.5 border border-gold-500/30 text-gold-400 font-semibold rounded-full uppercase tracking-wider text-[9px]">Filosofi</span>
            </div>

            <!-- Title -->
            <h4 id="news-drawer-headline" class="font-serif text-gold-400 text-2xl font-bold leading-tight">Detail Berita</h4>

            <!-- Social Share Buttons -->
            <div class="flex flex-wrap gap-2 py-3 border-y border-white/10 my-4" id="news-share-container">
                <a href="#" id="news-share-fb" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#3b5998] hover:bg-[#3b5998]/90 text-white text-[11px] font-bold transition">
                    <i class="fab fa-facebook-f"></i> Share
                </a>
                <a href="#" id="news-share-wa" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#25d366] hover:bg-[#25d366]/90 text-white text-[11px] font-bold transition">
                    <i class="fab fa-whatsapp"></i> Share
                </a>
                <a href="#" id="news-share-line" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#06c755] hover:bg-[#06c755]/90 text-white text-[11px] font-bold transition">
                    <i class="fab fa-line"></i> Share
                </a>
                <a href="#" id="news-share-tg" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#0088cc] hover:bg-[#0088cc]/90 text-white text-[11px] font-bold transition">
                    <i class="fab fa-telegram-plane"></i> Share
                </a>
                <a href="#" id="news-share-x" target="_blank" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-black hover:bg-black/90 text-white text-[11px] font-bold transition border border-white/10">
                    <i class="fa-brands fa-x-twitter"></i> Post
                </a>
                <button id="news-share-copy" class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#8cc63f] hover:bg-[#8cc63f]/90 text-white transition cursor-pointer" title="Salin Tautan">
                    <i class="fas fa-share-alt text-[11px]"></i>
                </button>
            </div>

            <!-- Rich Content Paragraphs -->
            <div id="news-drawer-content" class="text-white/80 leading-relaxed text-sm md:text-base space-y-4">
                <!-- Populated dynamically via JS -->
            </div>
        </div>
    </div>

    </div>
</div>

<!-- 4. UPLOAD PROPOSAL MODAL (Peserta Only) -->
<div id="upload-proposal-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-md opacity-100 transition-opacity duration-300 px-4">
    <div class="modal-dialog bg-[#eaf4f0] border border-[#c6e1d7] w-full max-w-2xl rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(4,28,21,0.1)] scale-95 opacity-0 transition-all duration-300 relative flex flex-col max-h-[90vh]">
        <!-- Close Button (Top Right) -->
        <button id="upload-modal-close" class="absolute top-4 right-4 z-10 p-2 text-forest-400 hover:text-forest-950 hover:bg-forest-200/50 rounded-full transition cursor-pointer" aria-label="Tutup">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Header -->
        <div class="p-6 border-b border-[#c6e1d7] bg-[#dfeee8]">
            <h3 class="font-serif text-lg font-bold text-forest-950">Unggah Berkas Sertifikasi & Data Instansi</h3>
            <p class="text-xs text-forest-600">Lengkapi formulir registrasi dan dokumen pendukung sertifikasi Tri Hita Karana Awards Anda</p>
        </div>
        
        <!-- Modal Body content -->
        <div class="p-6 md:p-8 space-y-6 overflow-y-auto flex-1">
            <!-- Alert Notice -->
            <div id="upload-alert" class="hidden p-4 rounded-2xl text-xs font-bold transition-all duration-300 transform scale-95 opacity-0 flex items-start gap-3">
                <div class="shrink-0 mt-0.5" id="upload-alert-icon"></div>
                <div class="flex-1" id="upload-alert-msg"></div>
            </div>

            <!-- Upload Form -->
            <form id="form-upload-proposal" class="space-y-6" enctype="multipart/form-data">
                @csrf
                
                <!-- Section 1: Informasi Instansi -->
                <div class="border-b border-[#c6e1d7] pb-4">
                    <h4 class="text-xs font-black uppercase text-forest-900 tracking-widest mb-3 flex items-center gap-1.5">
                        <i class="fas fa-building text-gold-600"></i> Informasi Instansi / Perusahaan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-institution">Nama Instansi / Perusahaan</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-institution" name="institution_name" required placeholder="Contoh: Hotel Grand Bali" value="{{ isset($userProposal) ? $userProposal->institution_name : '' }}">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-category">Kategori Penghargaan</label>
                            <div class="relative">
                                <select class="w-full bg-white border border-[#b8dad0] rounded-xl pl-4 pr-10 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition appearance-none cursor-pointer" id="upload-category" name="category">
                                    <option value="Akomodasi" {{ isset($userProposal) && $userProposal->category === 'Akomodasi' ? 'selected' : '' }}>Akomodasi / Perhotelan</option>
                                    <option value="Destinasi" {{ isset($userProposal) && $userProposal->category === 'Destinasi' ? 'selected' : '' }}>Destinasi Wisata</option>
                                    <option value="Restoran" {{ isset($userProposal) && $userProposal->category === 'Restoran' ? 'selected' : '' }}>Restoran / Kuliner</option>
                                    <option value="Lembaga Pendidikan" {{ isset($userProposal) && $userProposal->category === 'Lembaga Pendidikan' ? 'selected' : '' }}>Kategori Pendidikan</option>
                                    <option value="Desa Adat" {{ isset($userProposal) && $userProposal->category === 'Desa Adat' ? 'selected' : '' }}>Desa Adat</option>
                                    <option value="Individu" {{ isset($userProposal) && $userProposal->category === 'Individu' ? 'selected' : '' }}>Kategori Individu</option>
                                </select>
                                <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-forest-500 pointer-events-none">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </span>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-address">Alamat Lengkap Perusahaan / Lembaga</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-address" name="address" required placeholder="Contoh: Jl. Danau Tamblingan No. 88, Sanur, Denpasar" value="{{ isset($userProposal) ? $userProposal->address : '' }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-gmaps">Link Google Maps <span class="text-[9px] text-forest-600/70 font-normal">(Opsional)</span></label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="url" id="upload-gmaps" name="gmaps_link" placeholder="Contoh: https://maps.app.goo.gl/xxxx" value="{{ isset($userProposal) ? $userProposal->gmaps_link : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Informasi Kontak Person -->
                <div class="border-b border-[#c6e1d7] pb-4">
                    <h4 class="text-xs font-black uppercase text-forest-900 tracking-widest mb-3 flex items-center gap-1.5">
                        <i class="fas fa-address-book text-gold-600"></i> Kontak Person (CP)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-contact-name">Nama CP</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-contact-name" name="contact_name" required placeholder="Nama Lengkap CP" value="{{ isset($userProposal) ? $userProposal->contact_name : '' }}">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-contact-wa">No. WhatsApp CP</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-contact-wa" name="contact_wa" required placeholder="Contoh: 08123456789" value="{{ isset($userProposal) ? $userProposal->contact_wa : '' }}">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-contact-email">Email CP</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="email" id="upload-contact-email" name="contact_email" required placeholder="nama.cp@email.com" value="{{ isset($userProposal) ? $userProposal->contact_email : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Unggah Dokumen & Hasil Akreditasi -->
                <div class="border-b border-[#c6e1d7] pb-4">
                    <h4 class="text-xs font-black uppercase text-forest-900 tracking-widest mb-3 flex items-center gap-1.5">
                        <i class="fas fa-file-archive text-gold-600"></i> Unggahan Berkas
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-file">Dokumen Berkas <span class="text-[9px] text-red-500 font-bold">(PDF/ZIP)</span></label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-2 py-1.5 text-forest-950 text-xs outline-none focus:border-forest-500 cursor-pointer" type="file" id="upload-file" name="proposal_file" accept=".pdf,.zip" {{ (!isset($userProposal) || $userProposal->file_path === '-') ? 'required' : '' }}>
                            @if(isset($userProposal) && $userProposal->file_path !== '-')
                                <p class="text-[9px] text-forest-750 font-semibold mt-1">
                                    <a href="{{ $userProposal->file_path }}" target="_blank" class="hover:underline text-gold-600"><i class="fas fa-file-pdf"></i> Lihat Berkas Terunggah</a>
                                </p>
                            @else
                                <p class="text-[9px] text-forest-600/70 mt-1">Proposal (Maks. 10MB)</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-payment">Bukti Pembayaran <span class="text-[9px] text-forest-600/70 font-normal">(Opsional)</span></label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-2 py-1.5 text-forest-950 text-xs outline-none focus:border-forest-500 cursor-pointer" type="file" id="upload-payment" name="payment_proof" accept="image/*,.pdf">
                            @if(isset($userProposal) && $userProposal->payment_proof)
                                <p class="text-[9px] text-forest-750 font-semibold mt-1">
                                    <a href="{{ $userProposal->payment_proof }}" target="_blank" class="hover:underline text-gold-600"><i class="fas fa-file-invoice-dollar"></i> Lihat Bukti Terunggah</a>
                                </p>
                            @else
                                <p class="text-[9px] text-forest-600/70 mt-1">Format: JPG, PNG, PDF (Maks. 5MB)</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-prev-acc">Akreditasi Sebelumnya <span class="text-[9px] text-forest-600/70 font-normal">(Opsional)</span></label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-2 py-1.5 text-forest-950 text-xs outline-none focus:border-forest-500 cursor-pointer" type="file" id="upload-prev-acc" name="prev_accreditation" accept="image/*,.pdf">
                            @if(isset($userProposal) && $userProposal->prev_accreditation)
                                <p class="text-[9px] text-forest-750 font-semibold mt-1">
                                    <a href="{{ $userProposal->prev_accreditation }}" target="_blank" class="hover:underline text-gold-600"><i class="fas fa-medal"></i> Lihat Hasil Terunggah</a>
                                </p>
                            @else
                                <p class="text-[9px] text-forest-600/70 mt-1">Format: JPG, PNG, PDF (Maks. 5MB)</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Section 4: Link Dokumen Pilar Tri Hita Karana -->
                <div>
                    <h4 class="text-xs font-black uppercase text-forest-900 tracking-widest mb-3 flex items-center gap-1.5">
                        <i class="fas fa-link text-gold-600"></i> Tautan Dokumen Pilar Filosofis (Cloud Drive/Bitly)
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-link-parahyangan">Link Dokumen Bidang Parahyangan</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-link-parahyangan" name="link_parahyangan" required placeholder="Contoh: bit.ly/parahyangan-nama-instansi" value="{{ isset($userProposal) && $userProposal->link_parahyangan !== '-' ? $userProposal->link_parahyangan : '' }}">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-link-pawongan">Link Dokumen Bidang Pawongan</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-link-pawongan" name="link_pawongan" required placeholder="Contoh: bit.ly/pawongan-nama-instansi" value="{{ isset($userProposal) && $userProposal->link_pawongan !== '-' ? $userProposal->link_pawongan : '' }}">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-forest-800 uppercase mb-1" for="upload-link-palemahan">Link Dokumen Bidang Palemahan</label>
                            <input class="w-full bg-white border border-[#b8dad0] rounded-xl px-4 py-2.5 text-forest-950 text-sm outline-none focus:border-forest-500 transition placeholder-forest-300" type="text" id="upload-link-palemahan" name="link_palemahan" required placeholder="Contoh: bit.ly/palemahan-nama-instansi" value="{{ isset($userProposal) && $userProposal->link_palemahan !== '-' ? $userProposal->link_palemahan : '' }}">
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div id="upload-progress-container" class="hidden space-y-1.5 pt-2">
                    <div class="flex items-center justify-between text-[10px] font-bold text-forest-700">
                        <span>Mengunggah berkas...</span>
                        <span id="upload-progress-percent">0%</span>
                    </div>
                    <div class="w-full bg-forest-200 rounded-full h-2 overflow-hidden">
                        <div id="upload-progress-bar" class="bg-forest-500 h-full w-0 transition-all duration-100"></div>
                    </div>
                </div>

                <button type="submit" id="btn-submit-proposal" class="w-full py-3.5 bg-forest-500 text-white hover:bg-forest-600 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 text-sm shadow-md font-bold cursor-pointer mt-4 flex items-center justify-center gap-2">
                    <span id="btn-submit-text">Unggah Sekarang</span>
                    <svg id="upload-spinner" class="hidden animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleRegisterFields() {
        const role = document.getElementById('reg-role').value;
        const pesertaFields = document.getElementById('register-fields-peserta');
        const umumFields = document.getElementById('register-fields-umum');
        
        const instName = document.getElementById('reg-inst-name');
        const address = document.getElementById('reg-inst-address');
        const cpName = document.getElementById('reg-cp-name');
        const cpWa = document.getElementById('reg-cp-wa');
        const cpEmail = document.getElementById('reg-cp-email');
        
        const name = document.getElementById('reg-name');
        const email = document.getElementById('reg-email');
        const pass = document.getElementById('reg-pass');

        if (role === 'peserta') {
            pesertaFields.classList.remove('hidden');
            umumFields.classList.add('hidden');
            
            instName.required = true;
            address.required = true;
            cpName.required = true;
            cpWa.required = true;
            cpEmail.required = true;
            
            name.required = false;
            email.required = false;
            pass.required = false;
        } else {
            pesertaFields.classList.add('hidden');
            umumFields.classList.remove('hidden');
            
            instName.required = false;
            address.required = false;
            cpName.required = false;
            cpWa.required = false;
            cpEmail.required = false;
            
            name.required = true;
            email.required = true;
            pass.required = true;
        }
    }
    // Initialize required state on load
    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('reg-role')) {
            toggleRegisterFields();
        }
    });
</script>

