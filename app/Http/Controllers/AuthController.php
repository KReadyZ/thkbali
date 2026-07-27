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
            'role' => 'required|string|in:peserta,asesor,umum',
            'password' => 'required|string|min:8',
        ], [
            'email.unique' => 'Alamat email ini sudah terdaftar.',
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

    public function uploadProposal(Request $request)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'peserta') {
            return response()->json([
                'success' => false,
                'message' => 'Hanya pengguna dengan peran Peserta yang dapat mengunggah berkas.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'institution_name' => 'required|string|max:255',
            'category' => 'required|string',
            'proposal_file' => 'required|file|mimes:pdf,zip|max:10240', // max 10MB
        ], [
            'proposal_file.mimes' => 'Berkas harus berupa dokumen format PDF atau ZIP.',
            'proposal_file.max' => 'Ukuran berkas maksimal adalah 10 MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        if ($request->hasFile('proposal_file')) {
            $file = $request->file('proposal_file');
            $filename = 'proposal_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/proposals');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $filename);
            $filePath = '/uploads/proposals/' . $filename;

            // Save or Update Proposal in DB
            $proposal = Proposal::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'institution_name' => $request->institution_name,
                    'category' => $request->category,
                    'file_path' => $filePath,
                    'status' => 'Pengajuan',
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Berkas pendaftaran berhasil diunggah! Status Anda saat ini adalah: Pengajuan.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengunggah berkas. Silakan coba lagi.'
        ], 500);
    }
}
