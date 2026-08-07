<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\News;
use App\Models\Assessor;
use App\Models\Agenda;
use App\Models\Gallery;
use App\Models\AwardCategory;
use App\Models\Awardee;
use App\Models\User;
use App\Models\Proposal;
use App\Models\PaymentSetting;
use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Simple custom check directly in controller methods
    private function checkAuth()
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    public function showLoginForm()
    {
        if ($this->checkAuth()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, Admin!');
            }
            Auth::logout();
            return back()->withErrors(['auth' => 'Anda tidak memiliki hak akses administrator.'])->withInput();
        }

        return back()->withErrors(['auth' => 'Email atau Password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Berhasil keluar.');
    }

    public function dashboard()
    {
        $statistics = Statistic::first() ?? new Statistic([
            'pilar_filosofi' => 3,
            'peserta_awards' => 120,
            'asesor_aktif'   => 45,
            'kategori_awards' => 12,
            'desa_adat_penerima' => 8,
        ]);
        $news = News::orderBy('id', 'desc')->paginate(10, ['*'], 'page_news');
        $assessors = Assessor::orderBy('id', 'asc')->paginate(10, ['*'], 'page_assessors');
        $agendas = Agenda::orderBy('id', 'desc')->paginate(10, ['*'], 'page_agendas');
        $galleries = Gallery::orderBy('id', 'desc')->paginate(12, ['*'], 'page_galleries');
        $awardCategories = AwardCategory::orderBy('id', 'asc')->get();
        $awardees = Awardee::orderBy('id', 'desc')->paginate(10, ['*'], 'page_awardees');
        $proposals = Proposal::with('user')->orderBy('id', 'desc')->paginate(10, ['*'], 'page_proposals');
        $paymentSetting = PaymentSetting::first() ?? new PaymentSetting();
        $webSetting = WebSetting::first() ?? new WebSetting(['site_name' => 'THK Bali', 'site_tagline' => 'Tri Hita Karana']);

        return view('admin.dashboard', compact(
            'statistics',
            'news',
            'assessors',
            'agendas',
            'galleries',
            'awardCategories',
            'awardees',
            'proposals',
            'paymentSetting',
            'webSetting'
        ));
    }

    // CRUD: Stats
    public function updateStats(Request $request)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'pilar_filosofi' => 'required|integer',
            'peserta_awards' => 'required|integer',
            'asesor_aktif' => 'required|integer',
            'kategori_awards' => 'required|integer',
            'desa_adat_penerima' => 'required|integer',
        ]);

        $stats = Statistic::first() ?? new Statistic();
        $stats->fill($request->all());
        $stats->save();

        return back()->with('success', 'Statistik berhasil diperbarui.');
    }

    // CRUD: News
    public function saveNews(Request $request, $id = null)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'nullable|string',
            'category_id' => 'required|string',
            'category_en' => 'nullable|string',
            'date' => 'required|string',
            'content_id' => 'required|string', // raw text, split by newline
            'content_en' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'views' => 'nullable|integer',
        ]);

        // Helper to format content into paragraphs array (handling Summernote HTML)
        $parseParagraphs = function($text) {
            if (preg_match('/<[a-z][\s\S]*>/i', $text)) {
                $cleaned = str_replace(["\r", "\n"], "", $text);
                $parts = preg_split('/<\/p>/i', $cleaned);
                $paragraphs = [];
                foreach ($parts as $part) {
                    $part = trim($part);
                    if ($part !== '') {
                        $part = preg_replace('/^<p>/i', '', $part);
                        $paragraphs[] = $part;
                    }
                }
                return $paragraphs;
            }
            return array_values(array_filter(array_map('trim', explode("\n", $text))));
        };

        $title_en = $request->title_en ?? $request->title_id;
        $category_en = $request->category_en ?? $request->category_id;
        $content_en = $request->content_en ?? $request->content_id;

        $data = [
            'title_id' => $request->title_id,
            'title_en' => $title_en,
            'category_id' => $request->category_id,
            'category_en' => $category_en,
            'date' => $request->date,
            'content_id' => $parseParagraphs($request->content_id),
            'content_en' => $parseParagraphs($content_en),
            'views' => $request->views ?? 0,
        ];

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'news_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = '/images/' . $filename;
        }

        if ($id) {
            $news = News::findOrFail($id);
            $news->update($data);
            $msg = 'Berita berhasil diperbarui.';
        } else {
            if (!isset($data['image'])) {
                $data['image'] = '/images/Subak News.jpg'; // default placeholder
            }
            News::create($data);
            $msg = 'Berita baru berhasil ditambahkan.';
        }

        return back()->with('success', $msg);
    }

    public function deleteNews($id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        News::findOrFail($id)->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // CRUD: Assessor
    public function saveAssessor(Request $request, $id = null)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'instagram' => 'nullable|string|url',
            'facebook' => 'nullable|string|url',
            'youtube' => 'nullable|string|url',
            'linkedin' => 'nullable|string|url',
            'website' => 'nullable|string|url',
        ]);

        $data = $request->only(['name', 'title', 'instagram', 'facebook', 'youtube', 'linkedin', 'website']);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'assessor_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = '/images/' . $filename;
        }

        if ($id) {
            $assessor = Assessor::findOrFail($id);
            $assessor->update($data);
            $msg = 'Asesor berhasil diperbarui.';
        } else {
            if (!isset($data['image'])) {
                $data['image'] = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80';
            }
            Assessor::create($data);
            $msg = 'Asesor baru berhasil ditambahkan.';
        }

        return back()->with('success', $msg);
    }

    public function deleteAssessor($id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        Assessor::findOrFail($id)->delete();
        return back()->with('success', 'Asesor berhasil dihapus.');
    }

    // CRUD: Agenda
    public function saveAgenda(Request $request, $id = null)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'title' => 'required|string',
            'contributor' => 'required|string',
            'date_range' => 'required|string',
            'time' => 'required|string',
            'place' => 'required|string',
            'description' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'views' => 'nullable|integer',
        ]);

        $data = $request->only(['title', 'contributor', 'date_range', 'time', 'place', 'description']);
        $data['views'] = $request->views ?? 0;

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'agenda_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = '/images/' . $filename;
        }

        if ($id) {
            $agenda = Agenda::findOrFail($id);
            $agenda->update($data);
            $msg = 'Agenda berhasil diperbarui.';
        } else {
            if (!isset($data['image'])) {
                $data['image'] = '/images/agenda_book_chapter.png';
            }
            Agenda::create($data);
            $msg = 'Agenda baru berhasil ditambahkan.';
        }

        return back()->with('success', $msg);
    }

    public function deleteAgenda($id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        Agenda::findOrFail($id)->delete();
        return back()->with('success', 'Agenda berhasil dihapus.');
    }

    // CRUD: Gallery
    public function saveGallery(Request $request, $id = null)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'title_id' => 'required|string',
            'title_en' => 'nullable|string',
            'category_id' => 'required|string',
            'category_en' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $title_en = $request->title_en ?? $request->title_id;
        $category_en = $request->category_en ?? $request->category_id;

        $data = [
            'title_id' => $request->title_id,
            'title_en' => $title_en,
            'category_id' => $request->category_id,
            'category_en' => $category_en,
        ];

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'gallery_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = '/images/' . $filename;
        }

        if ($id) {
            $gallery = Gallery::findOrFail($id);
            $gallery->update($data);
            $msg = 'Galeri berhasil diperbarui.';
        } else {
            if (!isset($data['image'])) {
                return back()->withErrors(['image_file' => 'File gambar wajib diunggah untuk item galeri baru.']);
            }
            Gallery::create($data);
            $msg = 'Foto galeri baru berhasil ditambahkan.';
        }

        return back()->with('success', $msg);
    }

    public function deleteGallery($id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        Gallery::findOrFail($id)->delete();
        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }

    // CRUD: Award Category
    public function saveCategory(Request $request, $id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'name_id' => 'required|string',
            'name_en' => 'nullable|string',
            'description_id' => 'required|string',
            'description_en' => 'nullable|string',
            'badges_id' => 'required|string', // raw tags, split by comma
            'badges_en' => 'nullable|string',
            'asesor_init' => 'required|string|max:2',
            'asesor_name' => 'required|string',
            'asesor_role' => 'required|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $parseBadges = function($text) {
            return array_values(array_filter(array_map('trim', explode(',', $text))));
        };

        $name_en = $request->name_en ?? $request->name_id;
        $description_en = $request->description_en ?? $request->description_id;
        $badges_en = $request->badges_en ?? $request->badges_id;

        $data = [
            'name_id' => $request->name_id,
            'name_en' => $name_en,
            'description_id' => $request->description_id,
            'description_en' => $description_en,
            'badges_id' => $parseBadges($request->badges_id),
            'badges_en' => $parseBadges($badges_en),
            'asesor_init' => $request->asesor_init,
            'asesor_name' => $request->asesor_name,
            'asesor_role' => $request->asesor_role,
        ];

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'cat_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = '/images/' . $filename;
        }

        $category = AwardCategory::findOrFail($id);
        $category->update($data);

        return back()->with('success', 'Kategori THK Awards "' . $category->name_id . '" berhasil diperbarui.');
    }

    // CRUD: Awardees
    public function saveAwardee(Request $request, $id = null)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'name' => 'required|string|max:255',
            'medal' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'description' => 'required|string',
            'category_key' => 'required|string|max:255',
            'parahyangan_achievement' => 'nullable|string',
            'pawongan_achievement' => 'nullable|string',
            'palemahan_achievement' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        $data = [
            'name' => $request->name,
            'medal' => $request->medal,
            'year' => $request->year,
            'description' => $request->description,
            'category_key' => $request->category_key,
            'parahyangan_achievement' => $request->parahyangan_achievement,
            'pawongan_achievement' => $request->pawongan_achievement,
            'palemahan_achievement' => $request->palemahan_achievement,
        ];

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'awardee_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = '/images/' . $filename;
        }

        if ($id) {
            $awardee = Awardee::findOrFail($id);
            $awardee->update($data);
            $msg = 'Desa Adat Penerima "' . $awardee->name . '" berhasil diperbarui.';
        } else {
            if (!isset($data['image'])) {
                $data['image'] = '/images/Desa News.jpg';
            }
            $awardee = Awardee::create($data);
            $msg = 'Desa Adat Penerima baru "' . $awardee->name . '" berhasil ditambahkan.';
        }

        return back()->with('success', $msg);
    }

    public function deleteAwardee($id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        Awardee::findOrFail($id)->delete();
        return back()->with('success', 'Desa Adat Penerima berhasil dihapus.');
    }

    // CRUD: Proposal / Pendaftaran
    public function updateProposalStatus(Request $request, $id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        $request->validate([
            'status' => 'required|string',
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pendaftaran peserta berhasil diperbarui.');
    }

    public function deleteProposal($id)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);
        $proposal = Proposal::findOrFail($id);

        // Delete uploaded file if exists on disk
        if ($proposal->file_path && file_exists(public_path($proposal->file_path))) {
            @unlink(public_path($proposal->file_path));
        }

        // Delete user account (automatically cascade deletes proposal row in database)
        $user = $proposal->user;
        if ($user) {
            $user->delete();
        } else {
            $proposal->delete();
        }

        return back()->with('success', 'Pendaftaran dan akun peserta berhasil dihapus dari sistem dan database.');
    }

    // Payment Settings
    public function updatePaymentSetting(Request $request)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir.']);

        $request->validate([
            'bank_name'      => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'account_name'   => 'required|string|max:255',
            'amount'         => 'required|string|max:255',
            'description'    => 'nullable|string|max:500',
            'qr_image'       => 'nullable|image|mimes:jpeg,jpg,png,webp|max:3072',
        ]);

        $setting = PaymentSetting::first() ?? new PaymentSetting();
        $setting->bank_name      = $request->bank_name;
        $setting->account_number = $request->account_number;
        $setting->account_name   = $request->account_name;
        $setting->amount         = $request->amount;
        $setting->description    = $request->description;

        if ($request->hasFile('qr_image')) {
            // Delete old QR if exists
            if ($setting->qr_image && file_exists(public_path($setting->qr_image))) {
                @unlink(public_path($setting->qr_image));
            }
            $file = $request->file('qr_image');
            $filename = 'qr_payment_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/payment'), $filename);
            $setting->qr_image = 'images/payment/' . $filename;
        }

        $setting->save();

        return back()->with('success', 'Informasi pembayaran pendaftaran berhasil diperbarui.');
    }

    // Public API to expose payment settings for frontend
    public function getPaymentSetting()
    {
        $setting = PaymentSetting::first();
        return response()->json($setting ?? [
            'bank_name'      => 'BPD Bali',
            'account_number' => '009.02.12.00001-1',
            'account_name'   => 'Yayasan THK Bali',
            'amount'         => 'Rp 500.000',
            'description'    => 'Transfer dengan mencantumkan nama instansi sebagai berita transfer.',
            'qr_image'       => null,
        ]);
    }

    // Web Settings: update site name, tagline, and logo
    public function updateWebSetting(Request $request)
    {
        if (!$this->checkAuth()) return redirect()->route('admin.login')->withErrors(['auth' => 'Sesi administrator Anda berakhir. Silakan masuk kembali.']);

        $request->validate([
            'site_name'    => 'required|string|max:100',
            'site_tagline' => 'nullable|string|max:150',
            'logo'         => 'nullable|image|mimes:jpeg,jpg,png,webp,svg|max:2048',
        ]);

        $setting = WebSetting::first() ?? new WebSetting();
        $setting->site_name    = $request->site_name;
        $setting->site_tagline = $request->site_tagline;

        if ($request->hasFile('logo')) {
            // Delete old logo if exists and is not a URL
            if ($setting->logo_path && !str_starts_with($setting->logo_path, 'http') && file_exists(public_path($setting->logo_path))) {
                @unlink(public_path($setting->logo_path));
            }
            $file = $request->file('logo');
            $filename = 'site_logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/site'), $filename);
            $setting->logo_path = 'images/site/' . $filename;
        }

        $setting->save();

        return back()->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
