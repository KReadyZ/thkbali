<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Statistic;
use App\Models\News;
use App\Models\Assessor;
use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\AwardCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@thkbali.com'],
            [
                'name' => 'Admin THK Bali',
                'password' => Hash::make('thkbalisukses369'),
                'role' => 'admin',
            ]
        );

        // 1b. Seed Default Assessor User
        User::updateOrCreate(
            ['email' => 'asesor@thkbali.com'],
            [
                'name' => 'Asesor THK Bali',
                'password' => Hash::make('asesorthkbali369'),
                'role' => 'asesor',
            ]
        );

        // 2. Seed default statistics counters
        Statistic::updateOrCreate(
            ['id' => 1],
            [
                'pilar_filosofi' => 3,
                'peserta_awards' => 120,
                'asesor_aktif' => 45,
                'kategori_awards' => 12,
                'desa_adat_penerima' => 8,
            ]
        );

        // 3. Seed initial news
        $newsItems = [
            [
                'title_id' => 'Subak: Demokrasi Air dalam Peradaban Bali',
                'title_en' => 'Subak: Water Democracy in Balinese Civilization',
                'category_id' => 'Filosofi',
                'category_en' => 'Philosophy',
                'date' => '12 Jun 2026',
                'image' => '/images/Subak News.jpg',
                'content_id' => [
                    'Sistem irigasi Subak bukan sekadar teknik pertanian — ia adalah wujud nyata Tri Hita Karana dalam tata kelola desa.',
                    'Melalui pembagian air yang adil dan upacara ritual di Pura Ulun Danu, Subak merekatkan hubungan harmonis sesama petani, alam semesta, dan Sang Pencipta.',
                    'Hingga kini, warisan budaya dunia ini terus bertahan sebagai benteng ketahanan pangan dan demokrasi air lokal Bali.'
                ],
                'content_en' => [
                    'The Subak irrigation system is not merely an agricultural technique — it is a tangible manifestation of Tri Hita Karana in village management.',
                    'Through fair water distribution and ritual ceremonies at Ulun Danu Temple, Subak strengthens the harmonious relationship among farmers, the universe, and the Creator.',
                    'Until today, this world cultural heritage continues to survive as a fortress of food security and local Balinese water democracy.'
                ],
                'views' => 312,
            ],
            [
                'title_id' => 'Desa Adat Penerima THK Awards 2026 Diumumkan',
                'title_en' => 'Recipients of Customary Village THK Awards 2026 Announced',
                'category_id' => 'Komunitas',
                'category_en' => 'Community',
                'date' => '5 Jun 2026',
                'image' => '/images/Desa News.jpg',
                'content_id' => [
                    'Delapan desa adat menerima penghargaan atas praktik nyata keseimbangan Parahyangan, Pawongan, dan Palemahan.',
                    'Desa-desa tersebut berhasil mengintegrasikan program penanggulangan sampah berbasis sumber, perlindungan mata air suci, serta pelestarian seni tari banjar.',
                    'Penilaian dilakukan secara objektif oleh tim asesor independen selama tiga bulan penuh.'
                ],
                'content_en' => [
                    'Eight customary villages received awards for their practical application of balance in Parahyangan, Pawongan, and Palemahan.',
                    'These villages successfully integrated source-based waste management programs, protection of sacred springs, and preservation of local banjar dance arts.',
                    'The assessment was objectively conducted by an independent team of assessors over three full months.'
                ],
                'views' => 198,
            ],
            [
                'title_id' => 'Pendaftaran THK Awards 2027 Resmi Dibuka',
                'title_en' => 'THK Awards 2027 Registration Officially Open',
                'category_id' => 'THK Awards',
                'category_en' => 'THK Awards',
                'date' => '28 Mei 2026',
                'image' => '/images/Awrds News.jpg',
                'content_id' => [
                    'Bagi desa adat, organisasi kemasyarakatan, instansi pemerintahan, maupun pelaku usaha swasta di Bali, pendaftaran untuk siklus penilaian Tri Hita Karana Awards 2027 kini telah resmi dibuka.',
                    'Peserta dapat mulai melakukan pengisian data profil, mengunduh panduan evaluasi per pilar, serta mengunggah dokumen pendukung di portal web resmi THK Bali.',
                    'Proses pendaftaran awal ini akan ditutup pada akhir bulan depan, sebelum dilanjutkan ke tahap verifikasi dokumen administratif dan kunjungan tim asesor ke lapangan. Pastikan instansi Anda ikut berpartisipasi dalam melestarikan harmoni Bali.'
                ],
                'content_en' => [
                    'For customary villages, community organizations, government agencies, as well as private business actors in Bali, registration for the Tri Hita Karana Awards 2027 evaluation cycle is now officially open.',
                    'Participants can begin filling in their profile data, downloading evaluation guides for each pillar, and uploading supporting documents on the official web portal of THK Bali.',
                    'This initial registration phase will close at the end of next month, before continuing to the administrative document verification phase and assessors’ field visits. Ensure your institution participates in preserving Bali’s harmony.'
                ],
                'views' => 420,
            ]
        ];

        foreach ($newsItems as $news) {
            News::updateOrCreate(['title_id' => $news['title_id']], $news);
        }

        // 4. Seed Assessors matching image copy.png
        $assessors = [
            [
                'name' => 'Charli Sitinjak',
                'title' => 'Asesor Bidang Lingkungan & Sosial',
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Assoc. Prof. Dr. Suhardi, S.E., M.M.',
                'title' => 'Dosen & Asesor Bidang Ekonomi Pawongan',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'instagram' => 'https://instagram.com',
                'facebook' => 'https://facebook.com',
                'youtube' => 'https://youtube.com',
                'linkedin' => 'https://linkedin.com',
            ],
            [
                'name' => 'Dr. I Made Suparta, M.Hum',
                'title' => 'Asesor Kebudayaan & Adat Bali',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Muhammad Syathiri, S.Sos.I., M.Si, PhD',
                'title' => 'Pakar Sosiologi Keagamaan & Parahyangan',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Dr. Feti Fatimatuzzahroh, S.S., M.I.L.',
                'title' => 'Asesor Manajemen Lingkungan Palemahan',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Dr. Kadek Dwi Cahaya Putra, S.Pd., M.Sc.',
                'title' => 'Asesor Bidang Pendidikan & Pengembangan SDM',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Dr. I Nengah Laba',
                'title' => 'Pakar Komunikasi Budaya & Hubungan Antar Lembaga',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80',
                'instagram' => 'https://instagram.com',
                'facebook' => 'https://facebook.com',
                'youtube' => 'https://youtube.com',
                'linkedin' => 'https://linkedin.com',
                'website' => 'https://google.com',
            ],
            [
                'name' => 'Revolson Alexius Mege',
                'title' => 'Asesor Standardisasi Layanan & Hospitality',
                'image' => 'https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Zhuher Mubarokh',
                'title' => 'Asesor Teknologi Informasi & Audit Sistem',
                'image' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Wiyanti Fransisca Simanullang, S.Si., M.Eng., PhD',
                'title' => 'Asesor Sains Terapan & Konservasi Sumber Daya',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Dr. Dian Rahmani Putri',
                'title' => 'Asesor Keseimbangan Sosial-Ekologis Wisata',
                'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',
            ],
            [
                'name' => 'Dr. Ardi Dwi Susandi, M.Pd.',
                'title' => 'Asesor Metodologi Penilaian & Evaluasi Kinerja',
                'image' => 'https://images.unsplash.com/photo-1489980508314-941910ded1f4?auto=format&fit=crop&w=400&q=80',
            ]
        ];

        foreach ($assessors as $ass) {
            Assessor::updateOrCreate(['name' => $ass['name']], $ass);
        }

        // 5. Seed initial agenda matching image.png
        Agenda::updateOrCreate(
            ['title' => 'Call For Book Chapter "PARIWISATA NUSANTARA: PERSPEKTIF BUDAYA, EKONOMI, DAN EKOWISATA"'],
            [
                'contributor' => 'Ni Putu Veny Narlanti, S.S., M.Hum.',
                'date_range' => 'Selasa, 04 Februari 2025 s/d Jumat, 28 Februari 2025',
                'time' => '00.00',
                'place' => 'Denpasar Institute',
                'image' => '/images/agenda_book_chapter.png',
                'description' => "Penerbit Yaguwipa bekerja sama dengan Divisi Riset dan Inovasi, Denpasar Institute menyelenggarakan Call For Book Chapter bertajuk \"Pariwisata Nusantara: Perspektif Budaya, Ekonomi, dan Ekowisata\".

Tema yang Dapat Dikembangkan:
1. Pariwisata Nusantara dan Budaya Lokal
2. Dampak Ekonomi Pariwisata Domestik di Nusantara
3. Desa Wisata sebagai Destinasi Utama Tamu Domestik
4. Eco-Tourism dan Keberlanjutan dalam Pariwisata Domestik
5. Peran Teknologi dalam Meningkatkan Pariwisata Domestik
6. Kebijakan Pemerintah dalam Mendukung Pariwisata Domestik
7. Sinergi Pariwisata dan Pendidikan Budaya
8. Tantangan dan Masa Depan Pariwisata Domestik di Nusantara
9. Mewujudkan Pariwisata Nusantara yang Berkelanjutan dan Berdaya Saing
10. Digitalisasi dan Teknologi VR untuk Menarik Wisatawan
11. Strategi Pengembangan Desa Wisata Berbasis Budaya Lokal
12. Strategi Nasional untuk Pengembangan Pariwisata Nusantara

Ketentuan Pendaftaran:
- Pendaftaran dilakukan mulai 15 Januari - 19 Februari 2025.
- Pengumpulan naskah maks. 28 Februari 2025.
- Naskah menggunakan Bahasa Indonesia.
- Kontribusi book chapter sebesar Rp250.000,-.
- Pembayaran melalui transfer ke No. Rek 2706783687 (Bank BNI) a.n. Denpasar Institute.
- Narahubung: 0811-3996-698.

Manfaat Book Chapter:
- Ajuan kenaikan jabatan akademik Guru dan Dosen.
- Laporan kinerja jabatan fungsional.
- Laporan luaran hibah penelitian.
- Jejaring ilmiah.
- Gratis Daftar Konsultasi di Denpasar Institute dengan isi data di link www.denpasarinstitute.com/membership.",
                'views' => 245,
            ]
        );

        // 6. Seed initial gallery photos
        $galleries = [
            [
                'image' => '/images/Ulun Danu Beratan.jpg',
                'title_id' => 'Pura Ulun Danu Bratan — Refleksi Parahyangan',
                'title_en' => 'Ulun Danu Bratan Temple — Parahyangan Reflection',
                'category_id' => 'Parahyangan',
                'category_en' => 'Parahyangan',
            ],
            [
                'image' => '/images/Tanahlot.jpg',
                'title_id' => 'Tanah Lot di Waktu Senja — Keindahan Suasana Suci',
                'title_en' => 'Tanah Lot at Dusk — The Beauty of Sacred Atmosphere',
                'category_id' => 'Palemahan',
                'category_en' => 'Palemahan',
            ],
            [
                'image' => '/images/Tradisi Bali.jpg',
                'title_id' => 'Upacara Adat Lembu Ngaben — Tradisi Agung Gotong Royong',
                'title_en' => 'Lembu Ngaben Customary Ceremony — Grand Tradition of Mutual Cooperation',
                'category_id' => 'Pawongan',
                'category_en' => 'Pawongan',
            ],
            [
                'image' => '/images/Tari.jpg',
                'title_id' => 'Tari Tradisional membawa Sesajen Gebogan — Keanggunan Seni Bali',
                'title_en' => 'Traditional Dance carrying Gebogan Offerings — Elegance of Balinese Art',
                'category_id' => 'Pawongan / Budaya',
                'category_en' => 'Pawongan / Culture',
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80',
                'title_id' => 'Meditasi & Yoga di Tepi Pantai — Harmoni Menyatukan Jiwa dan Alam',
                'title_en' => 'Meditation & Yoga on Beachfront — Harmony Uniting Soul and Nature',
                'category_id' => 'Palemahan / Relaksasi',
                'category_en' => 'Palemahan / Relaxation',
            ]
        ];

        foreach ($galleries as $gal) {
            Gallery::updateOrCreate(['title_id' => $gal['title_id']], $gal);
        }

        // 7. Seed 6 Award Categories
        $categories = [
            [
                'key' => 'desa-adat',
                'name_id' => 'Kategori Desa Adat',
                'name_en' => 'Customary Village Category',
                'description_id' => 'Diberikan kepada desa adat yang menerapkan Tri Hita Karana secara nyata — dari pengelolaan Subak hingga pelestarian upacara adat dan ruang hijau desa.',
                'description_en' => 'Given to customary villages that practically apply Tri Hita Karana — from Subak management to customary ceremonies and village green space preservation.',
                'image' => '/images/Kategori desa adat.jpg',
                'badges_id' => ['Penghargaan', 'Komunitas', 'Keberlanjutan'],
                'badges_en' => ['Award', 'Community', 'Sustainability'],
                'asesor_init' => 'D',
                'asesor_name' => 'Tim Kurator THK Awards',
                'asesor_role' => 'Kategori Adat - 2026',
            ],
            [
                'key' => 'individu',
                'name_id' => 'Kategori Individu',
                'name_en' => 'Individual Category',
                'description_id' => 'Apresiasi tertinggi untuk tokoh masyarakat, budayawan, atau aktivis lingkungan yang mendedikasikan hidupnya demi menjaga nilai kearifan lokal Bali dan kerukunan.',
                'description_en' => 'The highest appreciation for community figures, cultural leaders, or environmental activists who dedicate their lives to maintaining Bali\'s local wisdom values and harmony.',
                'image' => '/images/Kategori Individu.jpg',
                'badges_id' => ['Kepeloporan', 'Inspiratif', 'Sosial-Budaya'],
                'badges_en' => ['Pioneering', 'Inspirational', 'Social-Cultural'],
                'asesor_init' => 'I',
                'asesor_name' => 'Dewan Juri THK',
                'asesor_role' => 'Panel Penilai Utama',
            ],
            [
                'key' => 'lembaga-pendidikan',
                'name_id' => 'Kategori Lembaga Pendidikan',
                'name_en' => 'Education Institute Category',
                'description_id' => 'Ditujukan kepada sekolah, universitas, atau lembaga pendidikan yang mengintegrasikan nilai Tri Hita Karana dalam kurikulum, etika kampus, dan aksi lingkungan hidup.',
                'description_en' => 'Intended for schools, universities, or educational institutions that integrate Tri Hita Karana values into the curriculum, campus ethics, and environmental actions.',
                'image' => '/images/kategori pendidikan.png',
                'badges_id' => ['Edukasi', 'Pendidikan Karakter', 'Sains Hijau'],
                'badges_en' => ['Education', 'Character Building', 'Green Science'],
                'asesor_init' => 'P',
                'asesor_name' => 'Pakar Akademis Udayana',
                'asesor_role' => 'Kurator Pendidikan - 2026',
            ],
            [
                'key' => 'akomodasi',
                'name_id' => 'Kategori Akomodasi',
                'name_en' => 'Accommodation Category',
                'description_id' => 'Ditujukan bagi hotel, resort, vila, atau homestay yang mengutamakan konsep ramah lingkungan (eco-friendly), arsitektur tradisional, dan kesejahteraan karyawan lokal.',
                'description_en' => 'Intended for hotels, resorts, villas, or homestays that prioritize eco-friendly concepts, traditional architecture, and the welfare of local employees.',
                'image' => '/images/akomodasi.png',
                'badges_id' => ['Hospitality', 'Eco-Resort', 'Budaya Bali'],
                'badges_en' => ['Hospitality', 'Eco-Resort', 'Balinese Culture'],
                'asesor_init' => 'A',
                'asesor_name' => 'Asosiasi PHRI Bali',
                'asesor_role' => 'Sertifikasi Akomodasi',
            ],
            [
                'key' => 'destinasi',
                'name_id' => 'Kategori Destinasi',
                'name_en' => 'Destination Category',
                'description_id' => 'Diberikan kepada destinasi wisata atau taman rekreasi yang sukses menjaga keaslian budaya, keindahan bentang alam, serta ketertiban kunjungan wisatawan.',
                'description_en' => 'Given to tourist destinations or recreation parks that successfully maintain cultural authenticity, landscape beauty, and tourism management order.',
                'image' => '/images/destinasi.png',
                'badges_id' => ['Destinasi Wisata', 'Ekowisata', 'Warisan'],
                'badges_en' => ['Tourist Destination', 'Eco-Tourism', 'Heritage'],
                'asesor_init' => 'D',
                'asesor_name' => 'Dinas Pariwisata Bali',
                'asesor_role' => 'Verifikator Destinasi',
            ],
            [
                'key' => 'restoran',
                'name_id' => 'Kategori Restoran',
                'name_en' => 'Category Restoran',
                'description_id' => 'Apresiasi bagi restoran, rumah makan, atau kafe yang mengusung menu bahan lokal organik (farm-to-table), pengelolaan limbah organik mandiri, dan nuansa etnik.',
                'description_en' => 'Appreciation for restaurants, eateries, or cafes carrying local organic ingredients (farm-to-table), independent organic waste management, and ethnic vibes.',
                'image' => '/images/restoran.png',
                'badges_id' => ['Kuliner', 'Farm-to-Table', 'Bahan Organik'],
                'badges_en' => ['Culinary', 'Farm-to-Table', 'Organic Ingredients'],
                'asesor_init' => 'R',
                'asesor_name' => 'Asosiasi Kuliner Bali',
                'asesor_role' => 'Penilai Higienis & Budaya',
            ]
        ];

        foreach ($categories as $cat) {
            AwardCategory::updateOrCreate(['key' => $cat['key']], $cat);
        }

        // 7. Seed Awardees (Desa Adat Penerima THK Awards)
        $awardees = [
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Penglipuran',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Desa Adat Penglipuran dinilai sangat unggul dalam melestarikan keaslian arsitektur tradisional, hutan bambu adat seluas 45 hektar (Palemahan), tata kelola warga berbasis sangkep (Pawongan), dan pemeliharaan Pura Penataran (Parahyangan).',
                'image' => '/images/Desa News.jpg',
                'parahyangan_achievement' => 'Restorasi berkala Pura Penataran Agung secara gotong royong dan mempertahankan upacara ritual piodalan secara luhur.',
                'pawongan_achievement' => 'Penerapan awig-awig pelarangan poligami (karang memadu) dan sistem pembagian tugas sosial ngayah secara tertib.',
                'palemahan_achievement' => 'Hutan bambu adat sebagai daerah tangkapan air, tata ruang rumah tinggal pekarangan tradisional, dan larangan kendaraan bermotor masuk area desa.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Ubud',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Terkenal sebagai pusat seni dan spiritual Bali, Desa Adat Ubud berhasil mengintegrasikan pariwisata internasional dengan keluhuran upacara Pura (Parahyangan), gotong royong seniman banjar (Pawongan), dan pelestarian hutan suci Sacred Monkey Forest (Palemahan).',
                'image' => '/images/Tradisi Bali.jpg',
                'parahyangan_achievement' => 'Pelestarian Pura Dalem Agung Padangtegal dan ritual persembahan berkala bagi satwa hutan suci.',
                'pawongan_achievement' => 'Pemberdayaan sanggar seni lukis dan seni tari anak-anak di setiap banjar secara sukarela.',
                'palemahan_achievement' => 'Konservasi kawasan Sacred Monkey Forest Sanctuary dan zonasi tata ruang bebas sampah plastik.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Jatiluwih',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Desa Adat Jatiluwih merupakan benteng utama warisan budaya dunia UNESCO. Sangat berprestasi dalam pelestarian pertanian tradisional Subak dengan terasering sawah menakjubkan serta upacara memuliakan Dewi Sri (Dewi Padi).',
                'image' => '/images/Subak News.jpg',
                'parahyangan_achievement' => 'Pelaksanaan ritual pertanian Subak di Pura Bedugul untuk memohon kesuburan tanah.',
                'pawongan_achievement' => 'Musyawarah pembagian debit air irigasi yang adil dan gotong royong perbaikan saluran air.',
                'palemahan_achievement' => 'Konservasi terasering sawah tradisional seluas ratusan hektar tanpa alih fungsi lahan.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Tenganan Pegringsingan',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Salah satu desa Bali Aga tertua. Meraih penghargaan emas atas konsistensi mempertahankan awig-awig kuno, kerajinan kain tenun Gringsing (Pawongan), ritual perang pandan (Parahyangan), dan pelestarian hutan lindung adat (Palemahan).',
                'image' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Ritual perang pandan (Mekare-kare) untuk menghormati Dewa Indra sebagai dewa perang.',
                'pawongan_achievement' => 'Sistem adat Bali Aga yang demokratis dan pelestarian kerajinan tenun ikat gringsing double-ikat.',
                'palemahan_achievement' => 'Aturan ketat larangan menebang pohon secara sembarangan di hutan adat desa.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Kintamani',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Meraih perak atas keberhasilan mengelola kawasan pertanian hortikultura di kaldera Gunung Batur dan hubungan harmonis dengan danau suci.',
                'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Pemujaan berkala di Pura Ulun Danu Batur sebagai sumber kemakmuran air.',
                'pawongan_achievement' => 'Kemitraan petani lokal dengan pelaku pariwisata Kintamani.',
                'palemahan_achievement' => 'Penanaman pohon pencegah erosi di bibir kaldera Gunung Batur.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Pinge',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Desa wisata Pinge di Tabanan menunjukkan konsistensi dalam pelestarian pemukiman tradisional bergaya arsitektur Bali kuno.',
                'image' => '/images/Tari.jpg',
                'parahyangan_achievement' => 'Pemeliharaan Pura Natar Jemeng secara gotong royong.',
                'pawongan_achievement' => 'Pengembangan homestay berbasis keluarga lokal.',
                'palemahan_achievement' => 'Pertanian organik ramah lingkungan tanpa pestisida kimia.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Kemoning',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Desa Adat Kemoning di Klungkung unggul dalam penataan sanitasi pemukiman warga dan pengelolaan air minum mandiri desa.',
                'image' => 'https://images.unsplash.com/photo-1546484475-7f7bd55792da?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Upacara persembahyangan Nyepi dengan keheningan khusyuk.',
                'pawongan_achievement' => 'Lembaga Perkreditan Desa (LPD) yang sehat membantu beasiswa warga miskin.',
                'palemahan_achievement' => 'Pengelolaan bank sampah banjar berbasis digital.',
            ],
            [
                'category_key' => 'desa-adat',
                'name' => 'Desa Adat Panglipuran Barat',
                'medal' => 'Bronze Award',
                'year' => '2026',
                'description' => 'Meraih perunggu atas inisiasi awal integrasi pengolahan limbah peternakan sapi warga untuk biogas ramah lingkungan.',
                'image' => '/images/Subak News.jpg',
                'parahyangan_achievement' => 'Pelaksanaan ritual Tumpek Uye untuk memuliakan hewan ternak.',
                'pawongan_achievement' => 'Kelompok tani ternak gotong royong.',
                'palemahan_achievement' => 'Konversi kotoran ternak menjadi biogas ramah lingkungan.',
            ],
            [
                'category_key' => 'individu',
                'name' => 'I Ketut Mangku, S.Sen.',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Meraih penghargaan emas atas dedikasi tanpa henti selama 40 tahun mendidik generasi muda Bali melestarikan seni gamelan dan tari sakral kuno di banjar-banjar terpencil.',
                'image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Pengabdian mengiringi upacara Dewa Yadnya secara sukarela.',
                'pawongan_achievement' => 'Melatih gamelan anak-anak panti asuhan tanpa memungut biaya.',
                'palemahan_achievement' => 'Mengkampanyekan pembersihan pura dari limbah plastik bekas sesaji.',
            ],
            [
                'category_key' => 'lembaga-pendidikan',
                'name' => 'Kampus Hijau Udayana',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Penerapan kurikulum berorientasi lingkungan hidup terpadu yang memadukan kajian sains ekologi modern dengan konsep tradisional Tri Hita Karana.',
                'image' => 'https://images.unsplash.com/photo-1604999333679-b86d54738315?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Menyelenggarakan kajian berkala mengenai kearifan lokal di pura kampus.',
                'pawongan_achievement' => 'Mengembangkan KKN tematik pengelolaan sampah di desa adat binaan.',
                'palemahan_achievement' => 'Penerapan zona bebas emisi karbon dan pemilahan sampah mandiri.',
            ],
            [
                'category_key' => 'akomodasi',
                'name' => 'Maya Resort Ubud',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Pelopor konsep eco-resort terkemuka yang konsisten melindungi aliran sungai Petanu dan mempekerjakan 95% warga lokal banjar sekitar.',
                'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Dukungan penuh pembangunan pura banjar dan ritual penunggun karang resort.',
                'pawongan_achievement' => 'Ubah limbah makanan menjadi kompos gratis untuk petani lokal.',
                'palemahan_achievement' => 'Penggunaan sistem daur ulang air limbah toilet dan pengurangan plastik sekali pakai.',
            ],
            [
                'category_key' => 'destinasi',
                'name' => 'Kawasan Wisata Uluwatu',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Kawasan Wisata Pura Luhur Uluwatu dinilai sangat baik dalam melestarikan area suci Pura dan tebing karang alami (Parahyangan & Palemahan) serta tata kelola pawongan pementasan Tari Kecak secara teratur.',
                'image' => 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Pelestarian kesucian Pura Luhur Uluwatu dan penyelenggaraan piodalan agung berkala.',
                'pawongan_achievement' => 'Pemberdayaan kelompok penari Kecak lokal dari desa adat Pecatu.',
                'palemahan_achievement' => 'Perlindungan habitat kera liar tebing Uluwatu dan kebersihan area tebing.',
            ],
            [
                'category_key' => 'destinasi',
                'name' => 'Taman Wisata Tirta Gangga',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Taman air bersejarah peninggalan kerajaan Karangasem yang memadukan keindahan kolam air suci dengan arsitektur tradisional Bali yang asri.',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Penjagaan mata air suci yang digunakan untuk upacara keagamaan masyarakat sekitar.',
                'pawongan_achievement' => 'Pelibatan warga lokal dalam pengelolaan pariwisata taman air.',
                'palemahan_achievement' => 'Sistem sirkulasi air alami tanpa bahan kimia dan kebun hijau yang terawat.',
            ],
            [
                'category_key' => 'restoran',
                'name' => 'Locavore Restaurant Ubud',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Pelopor kuliner lokal organik (farm-to-table) terbaik di Bali yang menyajikan bahan makanan dari petani banjar lokal dan mengelola limbah sisa makanan mandiri.',
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Upacara persembahan tumpeng saji berkala di area dapur restoran.',
                'pawongan_achievement' => 'Kerja sama erat dengan petani sayur dan peternak organik lokal Bali.',
                'palemahan_achievement' => 'Kompos mandiri sisa makanan organik dan larangan penggunaan plastik sekali pakai.',
            ],
            [
                'category_key' => 'restoran',
                'name' => 'Bebek Tepi Sawah Resto',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Menyajikan nuansa makan di tengah sawah asri dengan mempertahankan tatanan subak lokal dan mempromosikan tarian adat anak banjar.',
                'image' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Pembangunan Pura Penunggun Karang di area restoran secara asri.',
                'pawongan_achievement' => 'Penyediaan panggung seni berkala untuk seniman musik dan tari banjar lokal.',
                'palemahan_achievement' => 'Perlindungan ekosistem sawah dan burung liar di sekitar area makan restoran.',
            ]
        ];

        foreach ($awardees as $aw) {
            \App\Models\Awardee::updateOrCreate(['name' => $aw['name']], $aw);
        }
    }
}
