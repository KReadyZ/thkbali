<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssessorDashboardController extends Controller
{
    private function checkAuth()
    {
        return Auth::check() && Auth::user()->role === 'asesor';
    }

    public function index()
    {
        $proposals = Proposal::with('user')->orderBy('id', 'desc')->get();
        $webSetting = \App\Models\WebSetting::first();
        return view('assessor.dashboard', compact('proposals', 'webSetting'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $proposal = Proposal::findOrFail($id);
        $proposal->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pendaftaran peserta berhasil diperbarui oleh Asesor.');
    }
}
