-- MySQL dump 10.13  Distrib 9.4.0, for Win64 (x86_64)
--
-- Host: localhost    Database: thkbali
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agendas`
--

DROP TABLE IF EXISTS `agendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agendas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contributor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_range` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agendas`
--

LOCK TABLES `agendas` WRITE;
/*!40000 ALTER TABLE `agendas` DISABLE KEYS */;
INSERT INTO `agendas` VALUES (2,'Call For Book Chapter \"PARIWISATA NUSANTARA: PERSPEKTIF BUDAYA, EKONOMI, DAN EKOWISATA\"','Ni Putu Veny Narlanti, S.S., M.Hum.','Selasa, 04 Februari 2025 s/d Jumat, 28 Februari 2025','00.00','Denpasar Institute','/images/agenda_book_chapter.png','Penerbit Yaguwipa bekerja sama dengan Divisi Riset dan Inovasi, Denpasar Institute menyelenggarakan Call For Book Chapter bertajuk \"Pariwisata Nusantara: Perspektif Budaya, Ekonomi, dan Ekowisata\".\n\nTema yang Dapat Dikembangkan:\n1. Pariwisata Nusantara dan Budaya Lokal\n2. Dampak Ekonomi Pariwisata Domestik di Nusantara\n3. Desa Wisata sebagai Destinasi Utama Tamu Domestik\n4. Eco-Tourism dan Keberlanjutan dalam Pariwisata Domestik\n5. Peran Teknologi dalam Meningkatkan Pariwisata Domestik\n6. Kebijakan Pemerintah dalam Mendukung Pariwisata Domestik\n7. Sinergi Pariwisata dan Pendidikan Budaya\n8. Tantangan dan Masa Depan Pariwisata Domestik di Nusantara\n9. Mewujudkan Pariwisata Nusantara yang Berkelanjutan dan Berdaya Saing\n10. Digitalisasi dan Teknologi VR untuk Menarik Wisatawan\n11. Strategi Pengembangan Desa Wisata Berbasis Budaya Lokal\n12. Strategi Nasional untuk Pengembangan Pariwisata Nusantara\n\nKetentuan Pendaftaran:\n- Pendaftaran dilakukan mulai 15 Januari - 19 Februari 2025.\n- Pengumpulan naskah maks. 28 Februari 2025.\n- Naskah menggunakan Bahasa Indonesia.\n- Kontribusi book chapter sebesar Rp250.000,-.\n- Pembayaran melalui transfer ke No. Rek 2706783687 (Bank BNI) a.n. Denpasar Institute.\n- Narahubung: 0811-3996-698.\n\nManfaat Book Chapter:\n- Ajuan kenaikan jabatan akademik Guru dan Dosen.\n- Laporan kinerja jabatan fungsional.\n- Laporan luaran hibah penelitian.\n- Jejaring ilmiah.\n- Gratis Daftar Konsultasi di Denpasar Institute dengan isi data di link www.denpasarinstitute.com/membership.',249,'2026-08-07 21:10:46','2026-08-13 21:10:56');
/*!40000 ALTER TABLE `agendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessors`
--

DROP TABLE IF EXISTS `assessors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assessors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessors`
--

LOCK TABLES `assessors` WRITE;
/*!40000 ALTER TABLE `assessors` DISABLE KEYS */;
INSERT INTO `assessors` VALUES (1,'Charli Sitinjak','Asesor Bidang Lingkungan & Sosial','https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(2,'Assoc. Prof. Dr. Suhardi, S.E., M.M.','Dosen & Asesor Bidang Ekonomi Pawongan','https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80','https://instagram.com','https://facebook.com','https://youtube.com','https://linkedin.com',NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(3,'Dr. I Made Suparta, M.Hum','Asesor Kebudayaan & Adat Bali','https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(4,'Muhammad Syathiri, S.Sos.I., M.Si, PhD','Pakar Sosiologi Keagamaan & Parahyangan','https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(5,'Dr. Feti Fatimatuzzahroh, S.S., M.I.L.','Asesor Manajemen Lingkungan Palemahan','https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(6,'Dr. Kadek Dwi Cahaya Putra, S.Pd., M.Sc.','Asesor Bidang Pendidikan & Pengembangan SDM','https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(7,'Dr. I Nengah Laba','Pakar Komunikasi Budaya & Hubungan Antar Lembaga','https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80','https://instagram.com','https://facebook.com','https://youtube.com','https://linkedin.com','https://google.com','2026-08-07 03:47:29','2026-08-07 03:47:29'),(8,'Revolson Alexius Mege','Asesor Standardisasi Layanan & Hospitality','https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(9,'Zhuher Mubarokh','Asesor Teknologi Informasi & Audit Sistem','https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(10,'Wiyanti Fransisca Simanullang, S.Si., M.Eng., PhD','Asesor Sains Terapan & Konservasi Sumber Daya','https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(11,'Dr. Dian Rahmani Putri','Asesor Keseimbangan Sosial-Ekologis Wisata','https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29'),(12,'Dr. Ardi Dwi Susandi, M.Pd.','Asesor Metodologi Penilaian & Evaluasi Kinerja','https://images.unsplash.com/photo-1489980508314-941910ded1f4?auto=format&fit=crop&w=400&q=80',NULL,NULL,NULL,NULL,NULL,'2026-08-07 03:47:29','2026-08-07 03:47:29');
/*!40000 ALTER TABLE `assessors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `award_categories`
--

DROP TABLE IF EXISTS `award_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `award_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `badges_id` json NOT NULL,
  `badges_en` json NOT NULL,
  `asesor_init` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asesor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asesor_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `award_categories_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `award_categories`
--

LOCK TABLES `award_categories` WRITE;
/*!40000 ALTER TABLE `award_categories` DISABLE KEYS */;
INSERT INTO `award_categories` VALUES (1,'desa-adat','Kategori Desa Adat','Customary Village Category','Diberikan kepada desa adat yang menerapkan Tri Hita Karana secara nyata — dari pengelolaan Subak hingga pelestarian upacara adat dan ruang hijau desa.','Given to customary villages that practically apply Tri Hita Karana — from Subak management to customary ceremonies and village green space preservation.','/images/Kategori desa adat.jpg','[\"Penghargaan\", \"Komunitas\", \"Keberlanjutan\"]','[\"Award\", \"Community\", \"Sustainability\"]','D','Tim Kurator THK Awards','Kategori Adat - 2026','2026-08-07 03:47:29','2026-08-07 03:47:29'),(2,'individu','Kategori Individu','Individual Category','Apresiasi tertinggi untuk tokoh masyarakat, budayawan, atau aktivis lingkungan yang mendedikasikan hidupnya demi menjaga nilai kearifan lokal Bali dan kerukunan.','The highest appreciation for community figures, cultural leaders, or environmental activists who dedicate their lives to maintaining Bali\'s local wisdom values and harmony.','/images/Kategori Individu.jpg','[\"Kepeloporan\", \"Inspiratif\", \"Sosial-Budaya\"]','[\"Pioneering\", \"Inspirational\", \"Social-Cultural\"]','I','Dewan Juri THK','Panel Penilai Utama','2026-08-07 03:47:29','2026-08-07 03:47:29'),(3,'lembaga-pendidikan','Kategori Lembaga Pendidikan','Education Institute Category','Ditujukan kepada sekolah, universitas, atau lembaga pendidikan yang mengintegrasikan nilai Tri Hita Karana dalam kurikulum, etika kampus, dan aksi lingkungan hidup.','Intended for schools, universities, or educational institutions that integrate Tri Hita Karana values into the curriculum, campus ethics, and environmental actions.','/images/kategori pendidikan.png','[\"Edukasi\", \"Pendidikan Karakter\", \"Sains Hijau\"]','[\"Education\", \"Character Building\", \"Green Science\"]','P','Pakar Akademis Udayana','Kurator Pendidikan - 2026','2026-08-07 03:47:29','2026-08-07 03:47:29'),(4,'akomodasi','Kategori Akomodasi','Accommodation Category','Ditujukan bagi hotel, resort, vila, atau homestay yang mengutamakan konsep ramah lingkungan (eco-friendly), arsitektur tradisional, dan kesejahteraan karyawan lokal.','Intended for hotels, resorts, villas, or homestays that prioritize eco-friendly concepts, traditional architecture, and the welfare of local employees.','/images/akomodasi.png','[\"Hospitality\", \"Eco-Resort\", \"Budaya Bali\"]','[\"Hospitality\", \"Eco-Resort\", \"Balinese Culture\"]','A','Asosiasi PHRI Bali','Sertifikasi Akomodasi','2026-08-07 03:47:29','2026-08-07 03:47:29'),(5,'destinasi','Kategori Destinasi','Destination Category','Diberikan kepada destinasi wisata atau taman rekreasi yang sukses menjaga keaslian budaya, keindahan bentang alam, serta ketertiban kunjungan wisatawan.','Given to tourist destinations or recreation parks that successfully maintain cultural authenticity, landscape beauty, and tourism management order.','/images/destinasi.png','[\"Destinasi Wisata\", \"Ekowisata\", \"Warisan\"]','[\"Tourist Destination\", \"Eco-Tourism\", \"Heritage\"]','D','Dinas Pariwisata Bali','Verifikator Destinasi','2026-08-07 03:47:29','2026-08-07 03:47:29'),(6,'restoran','Kategori Restoran','Category Restoran','Apresiasi bagi restoran, rumah makan, atau kafe yang mengusung menu bahan lokal organik (farm-to-table), pengelolaan limbah organik mandiri, dan nuansa etnik.','Appreciation for restaurants, eateries, or cafes carrying local organic ingredients (farm-to-table), independent organic waste management, and ethnic vibes.','/images/restoran.png','[\"Kuliner\", \"Farm-to-Table\", \"Bahan Organik\"]','[\"Culinary\", \"Farm-to-Table\", \"Organic Ingredients\"]','R','Asosiasi Kuliner Bali','Penilai Higienis & Budaya','2026-08-07 03:47:29','2026-08-07 03:47:29'),(7,'pemerintah','Kategori Pemerintah','Government Category','Diberikan kepada dinas, kantor badan publik, dan instansi pemerintahan yang mengimplementasikan nilai Tri Hita Karana dalam pelayanan publik, tata ruang hijau kantor, dan pelestarian adat.','Awarded to regional agencies, public sector offices, and government institutions that implement Tri Hita Karana values in public services, green office environments, and cultural preservation.','/images/Kategori Organisasi.jpg','[\"Pelayanan Publik\", \"Green Office\", \"Tata Kelola\"]','[\"Public Service\", \"Green Office\", \"Good Governance\"]','G','Tim Evaluator Publik','Penilai Tata Kelola & Layanan','2026-08-12 20:42:35','2026-08-12 20:42:35');
/*!40000 ALTER TABLE `award_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `awardees`
--

DROP TABLE IF EXISTS `awardees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `awardees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'desa-adat',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parahyangan_achievement` text COLLATE utf8mb4_unicode_ci,
  `pawongan_achievement` text COLLATE utf8mb4_unicode_ci,
  `palemahan_achievement` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `awardees`
--

LOCK TABLES `awardees` WRITE;
/*!40000 ALTER TABLE `awardees` DISABLE KEYS */;
INSERT INTO `awardees` VALUES (1,'destinasi','Kawasan Wisata Uluwatu','Gold Award','2026','Kawasan Wisata Pura Luhur Uluwatu dinilai sangat baik dalam melestarikan area suci Pura dan tebing karang alami (Parahyangan & Palemahan) serta tata kelola pawongan pementasan Tari Kecak secara teratur.','/images/destinasi.png','Pelestarian kesucian Pura Luhur Uluwatu dan penyelenggaraan piodalan agung berkala.','Pemberdayaan kelompok penari Kecak lokal dari desa adat Pecatu.','Perlindungan habitat kera liar tebing Uluwatu dan kebersihan area tebing.','2026-08-07 03:38:02','2026-08-10 17:01:30'),(2,'destinasi','Taman Wisata Tirta Gangga','Silver Award','2026','Taman air bersejarah peninggalan kerajaan Karangasem yang memadukan keindahan kolam air suci dengan arsitektur tradisional Bali yang asri.','/images/Ulun Danu Beratan.jpg','Penjagaan mata air suci yang digunakan untuk upacara keagamaan masyarakat sekitar.','Pelibatan warga lokal dalam pengelolaan pariwisata taman air.','Sistem sirkulasi air alami tanpa bahan kimia dan kebun hijau yang terawat.','2026-08-07 03:38:02','2026-08-10 17:01:30'),(3,'restoran','Locavore Restaurant Ubud','Gold Award','2026','Pelopor kuliner lokal organik (farm-to-table) terbaik di Bali yang menyajikan bahan makanan dari petani banjar lokal dan mengelola limbah sisa makanan mandiri.','/images/restoran.png','Upacara persembahan tumpeng saji berkala di area dapur restoran.','Kerja sama erat dengan petani sayur dan peternak organik lokal Bali.','Kompos mandiri sisa makanan organik dan larangan penggunaan plastik sekali pakai.','2026-08-07 03:38:02','2026-08-10 17:01:30'),(4,'restoran','Bebek Tepi Sawah Resto','Silver Award','2026','Menyajikan nuansa makan di tengah sawah asri dengan mempertahankan tatanan subak lokal dan mempromosikan tarian adat anak banjar.','/images/Subak News.jpg','Pembangunan Pura Penunggun Karang di area restoran secara asri.','Penyediaan panggung seni berkala untuk seniman musik dan tari banjar lokal.','Perlindungan ekosistem sawah and burung liar di sekitar area makan restoran.','2026-08-07 03:38:02','2026-08-12 20:42:35'),(5,'desa-adat','Desa Adat Penglipuran','Gold Award','2026','Desa Adat Penglipuran dinilai sangat unggul dalam melestarikan keaslian arsitektur tradisional, hutan bambu adat seluas 45 hektar (Palemahan), tata kelola warga berbasis sangkep (Pawongan), dan pemeliharaan Pura Penataran (Parahyangan).','/images/Desa News.jpg','Restorasi berkala Pura Penataran Agung secara gotong royong dan mempertahankan upacara ritual piodalan secara luhur.','Penerapan awig-awig pelarangan poligami (karang memadu) dan sistem pembagian tugas sosial ngayah secara tertib.','Hutan bambu adat sebagai daerah tangkapan air, tata ruang rumah tinggal pekarangan tradisional, dan larangan kendaraan bermotor masuk area desa.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(6,'desa-adat','Desa Adat Ubud','Gold Award','2026','Terkenal sebagai pusat seni dan spiritual Bali, Desa Adat Ubud berhasil mengintegrasikan pariwisata internasional dengan keluhuran upacara Pura (Parahyangan), gotong royong seniman banjar (Pawongan), dan pelestarian hutan suci Sacred Monkey Forest (Palemahan).','/images/Tradisi Bali.jpg','Pelestarian Pura Dalem Agung Padangtegal dan ritual persembahan berkala bagi satwa hutan suci.','Pemberdayaan sanggar seni lukis dan seni tari anak-anak di setiap banjar secara sukarela.','Konservasi kawasan Sacred Monkey Forest Sanctuary dan zonasi tata ruang bebas sampah plastik.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(7,'desa-adat','Desa Adat Jatiluwih','Gold Award','2026','Desa Adat Jatiluwih merupakan benteng utama warisan budaya dunia UNESCO. Sangat berprestasi dalam pelestarian pertanian tradisional Subak dengan terasering sawah menakjubkan serta upacara memuliakan Dewi Sri (Dewi Padi).','/images/Subak News.jpg','Pelaksanaan ritual pertanian Subak di Pura Bedugul untuk memohon kesuburan tanah.','Musyawarah pembagian debit air irigasi yang adil dan gotong royong perbaikan saluran air.','Konservasi terasering sawah tradisional seluas ratusan hektar tanpa alih fungsi lahan.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(8,'desa-adat','Desa Adat Tenganan Pegringsingan','Gold Award','2026','Salah satu desa Bali Aga tertua. Meraih penghargaan emas atas konsistensi mempertahankan awig-awig kuno, kerajinan kain tenun Gringsing (Pawongan), ritual perang pandan (Parahyangan), dan pelestarian hutan lindung adat (Palemahan).','https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=800&q=80','Ritual perang pandan (Mekare-kare) untuk menghormati Dewa Indra sebagai dewa perang.','Sistem adat Bali Aga yang demokratis dan pelestarian kerajinan tenun ikat gringsing double-ikat.','Aturan ketat larangan menebang pohon secara sembarangan di hutan adat desa.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(9,'desa-adat','Desa Adat Kintamani','Silver Award','2026','Meraih perak atas keberhasilan mengelola kawasan pertanian hortikultura di kaldera Gunung Batur dan hubungan harmonis dengan danau suci.','https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80','Pemujaan berkala di Pura Ulun Danu Batur sebagai sumber kemakmuran air.','Kemitraan petani lokal dengan pelaku pariwisata Kintamani.','Penanaman pohon pencegah erosi di bibir kaldera Gunung Batur.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(10,'desa-adat','Desa Adat Pinge','Silver Award','2026','Desa wisata Pinge di Tabanan menunjukkan konsistensi dalam pelestarian pemukiman tradisional bergaya arsitektur Bali kuno.','/images/Tari.jpg','Pemeliharaan Pura Natar Jemeng secara gotong royong.','Pengembangan homestay berbasis keluarga lokal.','Pertanian organik ramah lingkungan tanpa pestisida kimia.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(11,'desa-adat','Desa Adat Kemoning','Silver Award','2026','Desa Adat Kemoning di Klungkung unggul dalam penataan sanitasi pemukiman warga dan pengelolaan air minum mandiri desa.','https://images.unsplash.com/photo-1546484475-7f7bd55792da?auto=format&fit=crop&w=800&q=80','Upacara persembahyangan Nyepi dengan keheningan khusyuk.','Lembaga Perkreditan Desa (LPD) yang sehat membantu beasiswa warga miskin.','Pengelolaan bank sampah banjar berbasis digital.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(12,'desa-adat','Desa Adat Panglipuran Barat','Bronze Award','2026','Meraih perunggu atas inisiasi awal integrasi pengolahan limbah peternakan sapi warga untuk biogas ramah lingkungan.','/images/Subak News.jpg','Pelaksanaan ritual Tumpek Uye untuk memuliakan hewan ternak.','Kelompok tani ternak gotong royong.','Konversi kotoran ternak menjadi biogas ramah lingkungan.','2026-08-07 03:47:29','2026-08-07 03:47:29'),(13,'individu','I Ketut Mangku, S.Sen.','Gold Award','2026','Meraih penghargaan emas atas dedikasi tanpa henti selama 40 tahun mendidik generasi muda Bali melestarikan seni gamelan dan tari sakral kuno di banjar-banjar terpencil.','/images/Kategori Individu.jpg','Pengabdian mengiringi upacara Dewa Yadnya secara sukarela.','Melatih gamelan anak-anak panti asuhan tanpa memungut biaya.','Mengkampanyekan pembersihan pura dari limbah plastik bekas sesaji.','2026-08-07 03:47:29','2026-08-10 17:01:30'),(14,'lembaga-pendidikan','Kampus Hijau Udayana','Gold Award','2026','Penerapan kurikulum berorientasi lingkungan hidup terpadu yang memadukan kajian sains ekologi modern dengan konsep tradisional Tri Hita Karana.','/images/kategori pendidikan.png','Menyelenggarakan kajian berkala mengenai kearifan lokal di pura kampus.','Mengembangkan KKN tematik pengelolaan sampah di desa adat binaan.','Penerapan zona bebas emisi karbon dan pemilahan sampah mandiri.','2026-08-07 03:47:29','2026-08-10 17:01:30'),(15,'akomodasi','Maya Resort Ubud','Gold Award','2026','Pelopor konsep eco-resort terkemuka yang konsisten melindungi aliran sungai Petanu dan mempekerjakan 95% warga lokal banjar sekitar.','/images/akomodasi.png','Dukungan penuh pembangunan pura banjar dan ritual penunggun karang resort.','Ubah limbah makanan menjadi kompos gratis untuk petani lokal.','Penggunaan sistem daur ulang air limbah toilet dan pengurangan plastik sekali pakai.','2026-08-07 03:47:29','2026-08-10 17:01:30'),(16,'pemerintah','Dinas Lingkungan Hidup dan Kehutanan Provinsi Bali','Gold Award','2026','Dinas Lingkungan Hidup & Kehutanan Provinsi Bali meraih Gold Award atas kebijakan perluasan areal konservasi mangrove, larangan penggunaan plastik sekali pakai di perkantoran, dan pelestarian tempat suci di dinas.','/images/Kategori Organisasi.jpg','Pemeliharaan Pura Padmasana kantor dan upacara keagamaan Pujawali secara rutin.','Kerja sama strategis dengan LSM peduli sampah dan pembinaan komunitas adat peduli kebersihan.','Penerapan konsep Eco-Office, pemilahan sampah kertas & plastik terpadu, dan pembibitan pohon lindung.','2026-08-12 20:42:35','2026-08-12 20:42:35'),(17,'pemerintah','Kantor Bupati Karangasem','Silver Award','2026','Kantor Pemerintahan Kabupaten Karangasem berhasil mengintegrasikan taman hijau kantor asri dengan pelayanan administrasi yang ramah lingkungan dan transparan.','/images/Ulun Danu Beratan.jpg','Penyediaan Padmasana agung perkantoran yang tertata bersih dan asri.','Apresiasi kinerja pegawai berprestasi secara transparan dan kegiatan bakti sosial karyawan.','Pengurangan penggunaan botol kemasan plastik dalam rapat kedinasan dan penanaman pohon kamboja tradisional.','2026-08-12 20:42:35','2026-08-12 20:42:35');
/*!40000 ALTER TABLE `awardees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'/images/Ulun Danu Beratan.jpg','Pura Ulun Danu Bratan — Refleksi Parahyangan','Ulun Danu Bratan Temple — Parahyangan Reflection','Parahyangan','Parahyangan','2026-08-07 03:47:29','2026-08-07 03:47:29'),(2,'/images/Tanahlot.jpg','Tanah Lot di Waktu Senja — Keindahan Suasana Suci','Tanah Lot at Dusk — The Beauty of Sacred Atmosphere','Palemahan','Palemahan','2026-08-07 03:47:29','2026-08-07 03:47:29'),(3,'/images/Tradisi Bali.jpg','Upacara Adat Lembu Ngaben — Tradisi Agung Gotong Royong','Lembu Ngaben Customary Ceremony — Grand Tradition of Mutual Cooperation','Pawongan','Pawongan','2026-08-07 03:47:29','2026-08-07 03:47:29'),(4,'/images/Tari.jpg','Tari Tradisional membawa Sesajen Gebogan — Keanggunan Seni Bali','Traditional Dance carrying Gebogan Offerings — Elegance of Balinese Art','Pawongan / Budaya','Pawongan / Culture','2026-08-07 03:47:29','2026-08-07 03:47:29'),(5,'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80','Meditasi & Yoga di Tepi Pantai — Harmoni Menyatukan Jiwa dan Alam','Meditation & Yoga on Beachfront — Harmony Uniting Soul and Nature','Palemahan / Relaksasi','Palemahan / Relaxation','2026-08-07 03:47:29','2026-08-07 03:47:29');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_08_07_110916_create_web_settings_table',1),(2,'0001_01_01_000000_create_users_table',2),(3,'0001_01_01_000001_create_cache_table',2),(4,'0001_01_01_000002_create_jobs_table',2),(5,'2026_07_20_000001_create_statistics_table',2),(6,'2026_07_20_000002_create_news_table',2),(7,'2026_07_20_000003_create_assessors_table',2),(8,'2026_07_20_000004_create_agendas_table',2),(9,'2026_07_20_000005_create_galleries_table',2),(10,'2026_07_20_000006_create_award_categories_table',2),(11,'2026_07_22_000007_create_awardees_table',2),(12,'2026_07_22_063810_create_proposals_table',2),(13,'2026_07_28_000000_add_views_to_news_table',2),(14,'2026_07_28_000001_add_extra_fields_to_proposals_table',2),(15,'2026_07_28_000002_create_payment_settings_table',2),(16,'2026_07_30_045936_add_thk_team_fields_to_proposals_table',2),(17,'2026_08_07_080727_add_logo_path_to_payment_settings_table',2),(19,'2026_08_12_053237_add_assessor_assignment_and_scores_to_tables',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_id` json NOT NULL,
  `content_en` json NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '1',
  `views` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Subak: Demokrasi Air dalam Peradaban Bali','Subak: Water Democracy in Balinese Civilization','Filosofi','Philosophy','12 Jun 2026','/images/Subak News.jpg','[\"Sistem irigasi Subak bukan sekadar teknik pertanian — ia adalah wujud nyata Tri Hita Karana dalam tata kelola desa.\", \"Melalui pembagian air yang adil dan upacara ritual di Pura Ulun Danu, Subak merekatkan hubungan harmonis sesama petani, alam semesta, dan Sang Pencipta.\", \"Hingga kini, warisan budaya dunia ini terus bertahan sebagai benteng ketahanan pangan dan demokrasi air lokal Bali.\"]','[\"The Subak irrigation system is not merely an agricultural technique — it is a tangible manifestation of Tri Hita Karana in village management.\", \"Through fair water distribution and ritual ceremonies at Ulun Danu Temple, Subak strengthens the harmonious relationship among farmers, the universe, and the Creator.\", \"Until today, this world cultural heritage continues to survive as a fortress of food security and local Balinese water democracy.\"]',1,312,'2026-08-07 03:47:29','2026-08-11 21:33:36'),(2,'Desa Adat Penerima THK Awards 2026 Diumumkan','Recipients of Customary Village THK Awards 2026 Announced','Komunitas','Community','5 Jun 2026','/images/Desa News.jpg','[\"Delapan desa adat menerima penghargaan atas praktik nyata keseimbangan Parahyangan, Pawongan, dan Palemahan.\", \"Desa-desa tersebut berhasil mengintegrasikan program penanggulangan sampah berbasis sumber, perlindungan mata air suci, serta pelestarian seni tari banjar.\", \"Penilaian dilakukan secara objektif oleh tim asesor independen selama tiga bulan penuh.\"]','[\"Eight customary villages received awards for their practical application of balance in Parahyangan, Pawongan, and Palemahan.\", \"These villages successfully integrated source-based waste management programs, protection of sacred springs, and preservation of local banjar dance arts.\", \"The assessment was objectively conducted by an independent team of assessors over three full months.\"]',1,199,'2026-08-07 03:47:29','2026-08-13 17:25:25'),(3,'Pendaftaran THK Awards 2027 Resmi Dibuka','THK Awards 2027 Registration Officially Open','THK Awards','THK Awards','28 Mei 2026','/images/Awrds News.jpg','[\"Bagi desa adat, organisasi kemasyarakatan, instansi pemerintahan, maupun pelaku usaha swasta di Bali, pendaftaran untuk siklus penilaian Tri Hita Karana Awards 2027 kini telah resmi dibuka.\", \"Peserta dapat mulai melakukan pengisian data profil, mengunduh panduan evaluasi per pilar, serta mengunggah dokumen pendukung di portal web resmi THK Bali.\", \"Proses pendaftaran awal ini akan ditutup pada akhir bulan depan, sebelum dilanjutkan ke tahap verifikasi dokumen administratif dan kunjungan tim asesor ke lapangan. Pastikan instansi Anda ikut berpartisipasi dalam melestarikan harmoni Bali.\"]','[\"For customary villages, community organizations, government agencies, as well as private business actors in Bali, registration for the Tri Hita Karana Awards 2027 evaluation cycle is now officially open.\", \"Participants can begin filling in their profile data, downloading evaluation guides for each pillar, and uploading supporting documents on the official web portal of THK Bali.\", \"This initial registration phase will close at the end of next month, before continuing to the administrative document verification phase and assessors’ field visits. Ensure your institution participates in preserving Bali’s harmony.\"]',1,420,'2026-08-07 03:47:29','2026-08-07 03:47:29');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BPD Bali',
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '009.02.12.00001-1',
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yayasan THK Bali',
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Rp 500.000',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_settings`
--

LOCK TABLES `payment_settings` WRITE;
/*!40000 ALTER TABLE `payment_settings` DISABLE KEYS */;
INSERT INTO `payment_settings` VALUES (1,'BPD Bali','009.02.12.00001-1','Yayasan THK Bali','Rp 500.000','Transfer dengan mencantumkan nama instansi/perusahaan Anda sebagai berita transfer.',NULL,'2026-08-07 03:36:29','2026-08-07 03:36:29');
/*!40000 ALTER TABLE `payment_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposals`
--

DROP TABLE IF EXISTS `proposals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pengajuan',
  `assessor_parahyangan_id` bigint unsigned DEFAULT NULL,
  `assessor_pawongan_id` bigint unsigned DEFAULT NULL,
  `assessor_palemahan_id` bigint unsigned DEFAULT NULL,
  `score_parahyangan` int DEFAULT NULL,
  `notes_parahyangan` text COLLATE utf8mb4_unicode_ci,
  `score_pawongan` int DEFAULT NULL,
  `notes_pawongan` text COLLATE utf8mb4_unicode_ci,
  `score_palemahan` int DEFAULT NULL,
  `notes_palemahan` text COLLATE utf8mb4_unicode_ci,
  `final_score` decimal(5,2) DEFAULT NULL,
  `award_recommendation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `gmaps_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_accreditation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_parahyangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_pawongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_palemahan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thk_leader_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thk_leader_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_parahyangan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_parahyangan_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_pawongan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_pawongan_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_palemahan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pic_palemahan_wa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proposals_user_id_foreign` (`user_id`),
  CONSTRAINT `proposals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposals`
--

LOCK TABLES `proposals` WRITE;
/*!40000 ALTER TABLE `proposals` DISABLE KEYS */;
INSERT INTO `proposals` VALUES (4,5,'Hotel A','Akomodasi','-','Verifikasi Admin',7,8,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-08-07 06:17:11','2026-08-11 22:38:39','aaaa',NULL,'aaa','111111','komeng@gmail.com','/uploads/payments/payment_5_1786427623.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `proposals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statistics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pilar_filosofi` int NOT NULL DEFAULT '3',
  `peserta_awards` int NOT NULL DEFAULT '120',
  `asesor_aktif` int NOT NULL DEFAULT '45',
  `kategori_awards` int NOT NULL DEFAULT '12',
  `desa_adat_penerima` int NOT NULL DEFAULT '8',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` VALUES (1,3,120,45,12,8,'2026-08-07 03:47:29','2026-08-13 17:36:54');
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'umum',
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pillar_specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'umum',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin THK Bali','admin@thkbali.com',NULL,'$2y$12$YwKu6eAiq8AEm1u4m3mo0uaV2g1DlB7SxOxEsqQ2vYA5w4XTb88Ca','admin',NULL,'umum',NULL,'2026-08-07 03:47:29','2026-08-12 20:42:35'),(5,'aaa','komeng@gmail.com',NULL,'$2y$12$FXsKcyoF1XYXK0.M4Wh6zu3QOwi/3aAPt8IGL/v1DaQHuoODHPFy2','peserta',NULL,'umum',NULL,'2026-08-07 06:17:11','2026-08-07 06:17:11'),(7,'Bagas (Asesor Parahyangan)','bagas@thkbali.com',NULL,'$2y$12$jqZr25xaKs2ULJrCiGlLEOCpreKHzLSoGS3shK23vEo6Rn/VCVWfi','asesor','parahyangan','parahyangan',NULL,'2026-08-11 21:33:35','2026-08-12 20:42:35'),(8,'Mang Arya (Asesor Pawongan)','mangarya@thkbali.com',NULL,'$2y$12$hnvGCivdwjEVHlUG8NR7CeuiJL4zNGXgpx5yQ/BrvRph3GFyyWpUe','asesor','pawongan','pawongan',NULL,'2026-08-11 21:33:35','2026-08-12 20:42:35'),(9,'Deta (Asesor Palemahan)','deta@thkbali.com',NULL,'$2y$12$k7ZLjzgkGiiGzApBKTVi4eT0/OhJd0tZ5.S9dmiBynlOH8Tpu6oeK','asesor','palemahan','palemahan',NULL,'2026-08-11 21:33:35','2026-08-12 20:42:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_settings`
--

DROP TABLE IF EXISTS `web_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `web_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'THK Bali',
  `site_tagline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Tri Hita Karana',
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_settings`
--

LOCK TABLES `web_settings` WRITE;
/*!40000 ALTER TABLE `web_settings` DISABLE KEYS */;
INSERT INTO `web_settings` VALUES (1,'THK Bali','Tri Hita Karana',NULL,'2026-08-07 03:47:16','2026-08-07 03:47:16');
/*!40000 ALTER TABLE `web_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-14 13:20:04
