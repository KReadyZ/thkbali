<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\News;
use App\Models\Assessor;
use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\AwardCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $statistics = Statistic::first() ?? new Statistic([
            'pilar_filosofi' => 3,
            'peserta_awards' => 120,
            'asesor_aktif' => 45,
            'kategori_awards' => 12,
            'desa_adat_penerima' => 8,
        ]);
        $news = News::all();
        $assessors = Assessor::all();
        $agendas = Agenda::all();
        $galleries = Gallery::all();
        $awardCategories = AwardCategory::all();
        // Auto-seed Destinasi & Restoran awardees if missing in database
        if (\App\Models\Awardee::where('category_key', 'destinasi')->count() === 0) {
            \App\Models\Awardee::create([
                'category_key' => 'destinasi',
                'name' => 'Kawasan Wisata Uluwatu',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Kawasan Wisata Pura Luhur Uluwatu dinilai sangat baik dalam melestarikan area suci Pura dan tebing karang alami (Parahyangan & Palemahan) serta tata kelola pawongan pementasan Tari Kecak secara teratur.',
                'image' => 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Pelestarian kesucian Pura Luhur Uluwatu dan penyelenggaraan piodalan agung berkala.',
                'pawongan_achievement' => 'Pemberdayaan kelompok penari Kecak lokal dari desa adat Pecatu.',
                'palemahan_achievement' => 'Perlindungan habitat kera liar tebing Uluwatu dan kebersihan area tebing.',
            ]);
            \App\Models\Awardee::create([
                'category_key' => 'destinasi',
                'name' => 'Taman Wisata Tirta Gangga',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Taman air bersejarah peninggalan kerajaan Karangasem yang memadukan keindahan kolam air suci dengan arsitektur tradisional Bali yang asri.',
                'image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Penjagaan mata air suci yang digunakan untuk upacara keagamaan masyarakat sekitar.',
                'pawongan_achievement' => 'Pelibatan warga lokal dalam pengelolaan pariwisata taman air.',
                'palemahan_achievement' => 'Sistem sirkulasi air alami tanpa bahan kimia dan kebun hijau yang terawat.',
            ]);
        }
        if (\App\Models\Awardee::where('category_key', 'restoran')->count() === 0) {
            \App\Models\Awardee::create([
                'category_key' => 'restoran',
                'name' => 'Locavore Restaurant Ubud',
                'medal' => 'Gold Award',
                'year' => '2026',
                'description' => 'Pelopor kuliner lokal organik (farm-to-table) terbaik di Bali yang menyajikan bahan makanan dari petani banjar lokal dan mengelola limbah sisa makanan mandiri.',
                'image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Upacara persembahan tumpeng saji berkala di area dapur restoran.',
                'pawongan_achievement' => 'Kerja sama erat dengan petani sayur dan peternak organik lokal Bali.',
                'palemahan_achievement' => 'Kompos mandiri sisa makanan organik dan larangan penggunaan plastik sekali pakai.',
            ]);
            \App\Models\Awardee::create([
                'category_key' => 'restoran',
                'name' => 'Bebek Tepi Sawah Resto',
                'medal' => 'Silver Award',
                'year' => '2026',
                'description' => 'Menyajikan nuansa makan di tengah sawah asri dengan mempertahankan tatanan subak lokal dan mempromosikan tarian adat anak banjar.',
                'image' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=800&q=80',
                'parahyangan_achievement' => 'Pembangunan Pura Penunggun Karang di area restoran secara asri.',
                'pawongan_achievement' => 'Penyediaan panggung seni berkala untuk seniman musik dan tari banjar lokal.',
                'palemahan_achievement' => 'Perlindungan ekosistem sawah dan burung liar di sekitar area makan restoran.',
            ]);
        }

        // Automatic clean up of bad/generic placeholder images in existing DB entries
        \App\Models\Awardee::where('name', 'Bebek Tepi Sawah Resto')
            ->where('image', 'like', '%photo-1507003211169-0a1dd7228f2d%')
            ->update(['image' => 'https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Locavore Restaurant Ubud')
            ->where('image', 'like', '%photo-1571896349842-33c89424de2d%')
            ->update(['image' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Kawasan Wisata Uluwatu')
            ->where('image', 'like', '%photo-1537996194471-e657df975ab4%')
            ->update(['image' => 'https://images.unsplash.com/photo-1573843981267-be1999ff37cd?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Taman Wisata Tirta Gangga')
            ->where('image', 'like', '%photo-1544367567-0f2fcb009e0b%')
            ->update(['image' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'I Ketut Mangku, S.Sen.')
            ->where('image', 'like', '%photo-1507003211169-0a1dd7228f2d%')
            ->update(['image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Desa Adat Tenganan Pegringsingan')
            ->where('image', 'like', '%photo-1537996194471-e657df975ab4%')
            ->update(['image' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Desa Adat Kintamani')
            ->where('image', 'like', '%Ulun Danu Beratan%')
            ->update(['image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Desa Adat Kemoning')
            ->where('image', 'like', '%photo-1544367567-0f2fcb009e0b%')
            ->update(['image' => 'https://images.unsplash.com/photo-1546484475-7f7bd55792da?auto=format&fit=crop&w=800&q=80']);

        \App\Models\Awardee::where('name', 'Kampus Hijau Udayana')
            ->where('image', 'like', '%photo-1523050854058-8df90110c9f1%')
            ->update(['image' => 'https://images.unsplash.com/photo-1604999333679-b86d54738315?auto=format&fit=crop&w=800&q=80']);

        $awardees = \App\Models\Awardee::orderBy('name', 'asc')->get();
        $userProposal = auth()->check() ? auth()->user()->proposal : null;

        return view('welcome', compact(
            'statistics',
            'news',
            'assessors',
            'agendas',
            'galleries',
            'awardCategories',
            'awardees',
            'userProposal'
        ));
    }
}
