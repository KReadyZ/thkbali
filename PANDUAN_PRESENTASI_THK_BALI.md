# 🏆 PANDUAN LENGKAP PRESENTASI & UJI COBA FITUR
## PORTAL RESMI DIGITAL YAYASAN TRI HITA KARANA BALI (THK BALI)

---

## 📋 DAFTAR ISI
1. [Latar Belakang & Tujuan Website](#1-latar-belakang--tujuan-website)
2. [Filosofi Tri Hita Karana](#2-filosofi-tri-hita-karana)
3. [Arsitektur Multi-Peran (Multi-Role System)](#3-arsitektur-multi-peran-multi-role-system)
4. [Alur Bisnis & Alur Kerja Sistem (End-to-End Workflow)](#4-alur-bisnis--alur-kerja-sistem-end-to-end-workflow)
5. [Data Akun & Kredensial untuk Demo Presentasi](#5-data-akun--kredensial-untuk-demo-presentasi)
6. [Skenario Demonstrasi Langkah-demi-Langkah (Live Demo Script)](#6-skenario-demonstrasi-langkah-demi-langkah-live-demo-script)
7. [Checklist Pengujian Semua Tombol & Fitur (Button Testing Sheet)](#7-checklist-pengujian-semua-tombol--fitur-button-testing-sheet)
8. [Struktur Teknologi & Database](#8-struktur-teknologi--database)
9. [Antisipasi Pertanyaan Tanya Jawab (Q&A)](#9-antisipasi-pertanyaan-tanya-jawab-qa)

---

## 1. 📌 LATAR BELAKANG & TUJUAN WEBSITE

* **Nama Platform:** Portal Resmi Yayasan Tri Hita Karana Bali (*THK Bali*).
* **Domain Proyek:** `http://127.0.0.1:8000` / `thkbali.test`
* **Latar Belakang:** 
  Tri Hita Karana Awards merupakan penganugerahan bergengsi di Bali untuk instansi pariwisata, lembaga pendidikan, desa adat, dan perorangan yang konsisten menerapkan keharmonisan hidup. Sebelumnya, proses sertifikasi dilakukan secara manual menggunakan formulir fisik kertas.
* **Tujuan Utama Platform:**
  1. **Edukasi Budaya Global:** Menyebarkan nilai-nilai filosofi Tri Hita Karana kepada masyarakat luas dan wisatawan mancanegara melalui fitur multi-bahasa dinamis.
  2. **Digitalisasi Pendaftaran & Sertifikasi:** Menyediakan sistem pendaftaran daring (*online registration*), pembayaran administrasi, hingga pengunggahan dokumen proposal 3 pilar yang transparan dan *paperless*.
  3. **Penilaian Independen Terstruktur:** Memberikan portal khusus bagi Tim Asesor independen untuk memeriksa berkas dan memperbarui status tahapan evaluasi peserta.
  4. **Direktori Prestasi Terbuka:** Menampilkan rekam jejak para penerima penghargaan (*Awardees*) per kategori dan medali (*Gold, Silver, Bronze*).

---

## 2. 🌿 FILOSOFI TRI HITA KARANA

Tri Hita Karana berarti **"Tiga Penyebab Terciptanya Kebahagiaan dan Kesejahteraan"**:

1. **Parahyangan (Hubungan Harmonis Manusia dengan Tuhan):**
   * Pelestarian tempat suci/pura, pelaksanaan upacara keagamaan, etika spiritual, dan ketaatan beribadah.
2. **Pawongan (Hubungan Harmonis Manusia dengan Sesama Manusia):**
   * Semangat gotong royong (*Menyama Braya*), kesejahteraan karyawan lokal, pemberdayaan masyarakat adat, serta keharmonisan sosial tanpa konflik.
3. **Palemahan (Hubungan Harmonis Manusia dengan Alam & Lingkungan):**
   * Pelestarian lingkungan hijau, pengelolaan sampah mandiri, pengolahan air limbah, perlindungan sumber mata air (*Danu Kertih*), dan pelestarian sistem irigasi *Subak*.

---

## 3. 👥 ARSITEKTUR MULTI-PERAN (MULTI-ROLE SYSTEM)

Aplikasi memiliki 4 hak akses (*role-based access control*):

| Peran (Role) | Ruang Lingkup Hak Akses | Akses Halaman |
| :--- | :--- | :--- |
| **1. Pengunjung Publik** | Membaca filosofi, berita, agenda kegiatan, galeri foto, melihat profil asesor, dan meninjau daftar penerima THK Awards. | Beranda (`/`) |
| **2. Peserta Sertifikasi** | Mendaftarkan instansi, membayar biaya administrasi, mengunggah bukti bayar, mengunggah berkas proposal & link 3 pilar THK, serta mengecek progres sertifikasi. | Portal Peserta (`/`) |
| **3. Tim Asesor (3 Pilar)** | Menilai berkas dan dokumen link spesifik untuk pilar yang ditugaskan (**Bagas** - Parahyangan, **Mang Arya** - Pawongan, **Deta** - Palemahan), menginput nilai (0-100) & catatan evaluasi lapangan, dan menyerahkan nilai ke Admin. | Panel Asesor (`/assessor`) |
| **4. Administrator (Pak Laba)** | Mengelola data CMS, memvalidasi pembayaran, menugaskan asesor per pilar, melihat rekapitulasi nilai 3 pilar, dan menetapkan hasil akhir penganugerahan (*Gold, Silver, Bronze*). | Panel Admin (`/admin`) |

---

## 4. 🔄 ALUR BISNIS & ALUR KERJA SISTEM (END-TO-END WORKFLOW)

```
[TAHAP 1: PENDAFTARAN AWAL]
 Peserta mengisi form pendaftaran di landing page ➡️ Akun tersimpan dengan status "Pengajuan".
     ⬇
[TAHAP 2: PEMBAYARAN ADMINISTRASI]
 Peserta login ➡️ Buka "Unggah Berkas" ➡️ Muncul rincian Rekening Bank & QRIS ➡️ Peserta transfer & unggah bukti transfer.
     ⬇
[TAHAP 3: VERIFIKASI PEMBAYARAN & PENUGASAN ASESOR OLEH ADMIN]
 Admin masuk ke /admin ➡️ Memeriksa bukti transfer ➡️ Ubah status menjadi "Verifikasi Admin" 
 ➡️ Admin menugaskan Asesor 3 Pilar:
    • Asesor Parahyangan : Bagas
    • Asesor Pawongan    : Mang Arya
    • Asesor Palemahan   : Deta
     ⬇
[TAHAP 4: PENGUNGGAHAN BERKAS SERTIFIKASI LENGKAP]
 Peserta login kembali ➡️ Muncul kartu hijau "Status Pembayaran: Terverifikasi (Lunas)" 
 ➡️ Peserta mengunggah Proposal PDF/ZIP & memasukkan Tautan Google Drive/Bitly untuk 3 Pilar THK.
     ⬇
[TAHAP 5: PENILAIAN 3 PILAR & EVALUASI OLEH ASESOR]
 Masing-masing asesor login ke /assessor:
    • Bagas     ➡️ Menilai Pilar Parahyangan (Skor & Catatan Lapangan) ➡️ Kirim Nilai ke Admin
    • Mang Arya ➡️ Menilai Pilar Pawongan    (Skor & Catatan Lapangan) ➡️ Kirim Nilai ke Admin
    • Deta      ➡️ Menilai Pilar Palemahan   (Skor & Catatan Lapangan) ➡️ Kirim Nilai ke Admin
     ⬇
[TAHAP 6: REKAPITULASI & PENETAPAN PENGHARGAAN OLEH ADMIN]
 Admin melihat rekapitulasi nilai lengkap ketiga pilar beserta rata-rata skor akhir 
 ➡️ Admin menetapkan Medali Penghargaan Resmi (Gold / Silver / Bronze Award) dan status "Penghargaan".
```

---

## 5. 🔑 DATA AKUN & KREDENSIAL UNTUK DEMO PRESENTASI

Berikut adalah kredensial resmi yang telah dikonfigurasi pada database:

### 👑 1. Akun Administrator (Pak Laba / Admin Yayasan)
* **Email:** `admin@thkbali.com`
* **Password:** `thkbalisukses369`
* **Role:** `admin`
* **Fungsi Demo:** Menugaskan asesor 3 pilar, melihat rekapitulasi nilai, mengelola akun asesor, dan menetapkan medali penganugerahan.

### 🎓 2. Akun Tim Asesor 3 Pilar
* **Asesor Parahyangan (Bagas):**
  * **Email:** `bagas@thkbali.com`
  * **Password:** `asesorthksukses369`
  * **Tugas:** Menilai pilar keagamaan, pura, dan spiritualitas.
* **Asesor Pawongan (Mang Arya):**
  * **Email:** `mangarya@thkbali.com`
  * **Password:** `asesorthksukses369`
  * **Tugas:** Menilai pilar sosial, hubungan karyawan, dan kemasyarakatan adat.
* **Asesor Palemahan (Deta):**
  * **Email:** `deta@thkbali.com`
  * **Password:** `asesorthksukses369`
  * **Tugas:** Menilai pilar lingkungan, alam hijau, sanitasi, dan pengolahan limbah.

### 🏢 3. Akun Peserta Uji Coba
* **Email:** `komeng@gmail.com`
* **Password:** *(Gunakan password akun yang sudah didaftarkan, atau buat instansi baru lewat formulir pendaftaran)*
* **Role:** `peserta`
* **Fungsi Demo:** Menunjukkan pengalaman peserta saat mengunggah berkas proposal dan melihat status pembayaran lunas.

---

## 6. 🎬 SKENARIO DEMONSTRASI LANGKAH-DEMI-LANGKAH (LIVE DEMO SCRIPT)

Ikuti urutan langkah ini saat melakukan demonstrasi di depan penguji/audiens:

### Langkah 1: Pengenalan Landing Page & Filosofi (Durasi: 2 Menit)
1. Tampilkan halaman utama (`http://127.0.0.1:8000`).
2. Tunjukkan **Hero Section** dan jelaskan misi pelestarian harmoni Bali.
3. Gulir ke bagian **3 Pilar Filosofis**: Klik tombol **"Pelajari Lebih Lanjut"** pada kartu Parahyangan untuk membuka *Slide-over Drawer* penjelasan filosofis.
4. Tunjukkan fitur **Multi-Bahasa** (Pojok Kiri Bawah): Ganti bahasa ke *Bali*, *Jawa (Krama)*, atau *English*. Tunjukkan bahwa layar tetap stabil di posisi yang sama (*preserved scroll*).

### Langkah 2: Showcase THK Awards & Foto Pemenang (Durasi: 2 Menit)
1. Buka bagian **Sorotan Kategori THK Awards**.
2. Klik tab kategori (*Akomodasi, Destinasi, Restoran, Lembaga Pendidikan, Desa Adat, Individu*).
3. Klik tombol **"Lihat Penerima"** untuk membuka panel geser direktori desa/instansi peraih medali.
4. Pilih instansi (misal: *Desa Adat Jatiluwih* atau *I Ketut Mangku, S.Sen.*).
5. Klik foto pemenang untuk membuka modal **Lightbox Fullscreen** (`z-[9999]`). Tunjukkan foto utuh tanpa terpotong dan tutup menggunakan tombol silang floating tanpa adanya pergeseran layar.

### Langkah 3: Alur Pendaftaran & Portal Peserta (Durasi: 2 Menit)
1. Klik tombol **"Daftar"** di Navbar &rarr; Tunjukkan form pendaftaran instansi yang lengkap dan rapi.
2. Masuk menggunakan akun peserta.
3. Klik tombol **"Unggah Berkas"** &rarr; Tunjukkan kartu status pembayaran **"Terverifikasi (Lunas)"** dan formulir upload dokumen sertifikasi (Proposal PDF/ZIP & Tautan 3 Pilar THK).

### Langkah 4: Penugasan Asesor oleh Admin di Panel Admin (Durasi: 2 Menit)
1. Masuk (*login*) sebagai Admin (`admin@thkbali.com` / `thkbalisukses369`).
2. Masuk ke menu **Kelola Pendaftaran** &rarr; Klik tombol **"Tugaskan Asesor"** pada instansi Hotel A.
3. Pilih:
   * Asesor Parahyangan: **Bagas**
   * Asesor Pawongan: **Mang Arya**
   * Asesor Palemahan: **Deta**
4. Klik **Simpan Penugasan**.

### Langkah 5: Penilaian oleh Asesor (Bagas / Mang Arya / Deta) (Durasi: 2 Menit)
1. Masuk sebagai Asesor Bagas (`bagas@thkbali.com` / `asesorthksukses369`).
2. Di Dashboard Asesor, terlihat tugas pilar **Parahyangan**.
3. Klik tombol **"Beri Nilai"** &rarr; Masukkan skor `94` dan catatan evaluasi lapangan, lalu klik **"Kirim Nilai ke Admin"**.

### Langkah 6: Rekapitulasi & Penetapan Medali oleh Admin (Durasi: 2 Menit)
1. Masuk kembali ke Panel Admin.
2. Buka **Kelola Pendaftaran** &rarr; Klik tombol **"Tetapkan Hasil"**.
3. Tunjukkan rekapitulasi skor 3 pilar yang sudah masuk (Parahyangan: 94, Pawongan: 90, Palemahan: 95) dan rata-rata skor `93.00`.
4. Tetapkan keputusan akhir: **Gold Award** & Status: **Penghargaan**.

---

## 7. 🧪 CHECKLIST PENGUJIAN SEMUA TOMBOL & FITUR (BUTTON TESTING SHEET)

| No | Lokasi / Komponen | Elemen / Tombol | Aksi & Respon Sistem yang Diharapkan | Status |
| :--- | :--- | :--- | :--- | :---: |
| 1 | Navbar | Logo THK Bali | Menggulir ke puncak halaman (*Scroll to Top*). | ✅ Lolos |
| 2 | Navbar | Link Menu (*Filosofi, Berita, Agenda, Asesor, Galeri, Kontak*) | Menggulir halus (*smooth scroll*) ke section yang sesuai. | ✅ Lolos |
| 3 | Navbar / Floating | Dropdown Bahasa | Mengubah bahasa teks secara *in-place* tanpa reload meloncat. | ✅ Lolos |
| 4 | Navbar | Tombol "Masuk" | Membuka modal login untuk peserta, asesor, dan admin. | ✅ Lolos |
| 5 | Navbar | Tombol "Daftar" | Membuka modal registrasi akun instansi baru. | ✅ Lolos |
| 6 | Navbar (Saat Login) | Tombol "Unggah Berkas" | Membuka modal formulir sertifikasi dan status lunas. | ✅ Lolos |
| 7 | Hero Section | Tombol "Daftar Sertifikasi" | Membuka modal formulir registrasi peserta. | ✅ Lolos |
| 8 | 3 Pilar Section | Tombol "Pelajari Lebih Lanjut" | Membuka Slide-over Drawer rincian Parahyangan, Pawongan, Palemahan. | ✅ Lolos |
| 9 | Awards Section | Tab Kategori Awards | Mengganti kategori penghargaan secara dinamis. | ✅ Lolos |
| 10 | Awards Section | Tombol "Lihat Penerima" | Membuka panel geser daftar penerima piala/medali. | ✅ Lolos |
| 11 | Awards Drawer | Foto Pemenang | Membuka foto resolusi penuh (*Lightbox*) tanpa terpotong. | ✅ Lolos |
| 12 | Lightbox Modal | Tombol Close (Silang) | Menutup foto tanpa menggeser scroll halaman utama. | ✅ Lolos |
| 13 | Berita Section | Kartu Artikel Berita | Membuka Slide-over Drawer isi berita lengkap. | ✅ Lolos |
| 14 | Asesor Section | Tombol Paginasi (Prev/Next/Nomor) | Berpindah halaman profil asesor tanpa hash loncatan URL. | ✅ Lolos |
| 15 | Galeri Section | Foto Galeri Dokumentasi | Membuka Lightbox dengan tombol navigasi Sebelumnya/Berikutnya. | ✅ Lolos |
| 16 | Floating Widget | Tombol WhatsApp (Kanan Bawah) | Membuka tautan chat langsung ke WhatsApp Admin THK Bali. | ✅ Lolos |
| 17 | Modal Unggah | Tombol "Kirim Berkas" | Menyimpan data registrasi & file proposal ke server dengan indikator progres. | ✅ Lolos |
| 18 | Panel Asesor | Tombol "Perbarui Status" | Mengupdate status tahapan penilaian peserta secara *real-time*. | ✅ Lolos |

---

## 8. 💻 STRUKTUR TEKNOLOGI & DATABASE

### Arsitektur Perangkat Lunak:
* **Framework Back-End:** Laravel 11 (PHP 8.2+) dengan arsitektur MVC (*Model-View-Controller*).
* **Front-End Styling & Interaktivitas:** Tailwind CSS 3.4, Vanilla JavaScript (ES6+), FontAwesome Icons, Vite 8 Asset Bundler.
* **Database Management System:** MySQL / MariaDB (InnoDB Engine dengan *Foreign Key Integrity*).
* **Multi-Language Engine:** Google Translate REST Integration dengan algoritma *DOM Mutation Observer* & *Scroll Coordinate Preservation*.

### Tabel Database Fitur Utama:
1. `users` — Autentikasi dan hak akses peran (*Admin, Asesor, Peserta, Umum*).
2. `proposals` — Rekam data pendaftaran instansi, berkas proposal, link 3 pilar, dan status penilaian.
3. `payment_settings` — Rekening bank, nama penerima, nominal biaya, dan foto QRIS dinamis.
4. `news` — Publikasi artikel, wawasan filosofi, dan berita kegiatan.
5. `agendas` — Jadwal seminar, workshop, dan malam penganugerahan THK Awards.
6. `galleries` — Dokumentasi foto kegiatan kebudayaan.
7. `award_categories` — Definisi 6 kategori penghargaan resmi.
8. `awardees` — Direktori data instansi/desa peraih penghargaan THK Awards.
9. `assessors` — Direktori biodata dan portofolio tim asesor independen.
10. `web_settings` — Kustomisasi logo, nama website, dan tagline situs.

---

## 9. 💬 ANTISIPASI PERTANYAAN TANYA JAWAB (Q&A)

Berikut jawaban cerdas jika penguji menanyakan hal-hal berikut:

* **T: Mengapa formulir registrasi dan login digabung dalam bentuk modal/drawer interaktif, bukan halaman terpisah?**
  * **J:** *Untuk menciptakan pengalaman pengguna (User Experience) yang modern, cepat, dan terpadu (Single-Page Experience). Pengunjung dapat mendaftar atau membaca detail filosofi tanpa harus kehilangan konteks halaman utama.*

* **T: Mengapa asesor tidak bisa mendaftar sendiri melalui website?**
  * **J:** *Asesor adalah auditor dan kurator independen yang ditunjuk langsung oleh Yayasan Tri Hita Karana Bali. Untuk menjaga integritas, kredibilitas, dan independensi penilaian, akun asesor dibuat secara tertutup oleh Administrator.*

* **T: Bagaimana keamanan berkas yang diunggah oleh peserta?**
  * **J:** *Seluruh berkas yang diunggah divalidasi ketat di sisi server (ekstensi file dibatasi hanya PDF/ZIP/Gambar, ukuran dibatasi maksimal 10MB) dan tersimpan secara terstruktur di direktori penyimpanan publik yang aman.*

---

*Dokumen ini dibuat resmi untuk kelengkapan bahan presentasi dan uji coba sistem THK Bali.*
