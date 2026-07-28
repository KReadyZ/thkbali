<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:peserta,umum',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar.',
            'role.in' => 'Peran pendaftaran tidak valid.',
            'password.min' => 'Kata sandi minimal harus 8 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil! Silakan masuk dengan akun Anda.',
            'email' => $user->email
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Format email atau kata sandi tidak valid.'
            ], 422);
        }

        $remember = $request->has('remember');

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'message' => 'Masuk berhasil! Menghubungkan sesi Anda...',
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau kata sandi salah.'
        ], 422);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function registerProposal(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'peserta') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pengguna dengan peran Peserta yang dapat mendaftar.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'institution_name' => 'required|string|max:255',
            'category' => 'required|string',
            'address' => 'required|string',
            'gmaps_link' => 'nullable|string|max:1000',
            'contact_name' => 'required|string|max:255',
            'contact_wa' => 'required|string|max:50',
            'contact_email' => 'required|email|max:255',
            'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120', // max 5MB
            'prev_accreditation' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120', // max 5MB
        ], [
            'payment_proof.mimes' => 'Bukti pembayaran harus berupa gambar (JPG, PNG) atau PDF.',
            'payment_proof.max' => 'Ukuran bukti pembayaran maksimal adalah 5 MB.',
            'prev_accreditation.mimes' => 'Hasil akreditasi sebelumnya harus berupa gambar atau PDF.',
            'prev_accreditation.max' => 'Ukuran hasil akreditasi sebelumnya maksimal adalah 5 MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $data = [
            'institution_name' => $request->institution_name,
            'category' => $request->category,
            'address' => $request->address,
            'gmaps_link' => $request->gmaps_link,
            'contact_name' => $request->contact_name,
            'contact_wa' => $request->contact_wa,
            'contact_email' => $request->contact_email,
            'status' => 'Registrasi',
        ];

        // Handle payment proof
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'payment_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/payments');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);
            $data['payment_proof'] = '/uploads/payments/' . $filename;
        }

        // Handle previous accreditation
        if ($request->hasFile('prev_accreditation')) {
            $file = $request->file('prev_accreditation');
            $filename = 'prev_acc_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/accreditations');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);
            $data['prev_accreditation'] = '/uploads/accreditations/' . $filename;
        }

        $proposal = Proposal::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran instansi dan pembayaran berhasil disimpan! Silakan lanjutkan dengan mengunggah berkas sertifikasi.'
        ]);
    }

    public function uploadProposal(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'peserta') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pengguna dengan peran Peserta yang dapat mengunggah berkas.'
            ], 403);
        }

        // Verify that they have filled Form 1 first
        $proposal = Proposal::where('user_id', $user->id)->first();
        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan lakukan pendaftaran instansi & pembayaran terlebih dahulu.'
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'proposal_file' => 'required|file|mimes:pdf,zip|max:10240', // max 10MB
            'link_parahyangan' => 'required|string|max:1000',
            'link_pawongan' => 'required|string|max:1000',
            'link_palemahan' => 'required|string|max:1000',
        ], [
            'proposal_file.required' => 'Berkas pendaftaran sertifikasi wajib diunggah.',
            'proposal_file.mimes' => 'Berkas sertifikasi harus berupa dokumen format PDF atau ZIP.',
            'proposal_file.max' => 'Ukuran berkas sertifikasi maksimal adalah 10 MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $data = [
            'link_parahyangan' => $request->link_parahyangan,
            'link_pawongan' => $request->link_pawongan,
            'link_palemahan' => $request->link_palemahan,
            'status' => 'Pengajuan',
        ];

        // Handle proposal file
        if ($request->hasFile('proposal_file')) {
            $file = $request->file('proposal_file');
            $filename = 'proposal_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/proposals');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);
            $data['file_path'] = '/uploads/proposals/' . $filename;
        }

        $proposal->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berkas sertifikasi dan link pilar filosofis berhasil diunggah! Status Anda saat ini adalah: Pengajuan.'
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Alamat email tidak terdaftar.'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Kata sandi berhasil diatur ulang! Silakan masuk dengan kata sandi baru Anda.'
        ]);
    }
}
