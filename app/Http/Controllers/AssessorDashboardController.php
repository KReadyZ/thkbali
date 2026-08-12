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
        $user = Auth::user();
        $proposals = Proposal::with(['user', 'assessorParahyangan', 'assessorPawongan', 'assessorPalemahan'])
            ->orderBy('id', 'desc')
            ->get();

        return view('assessor.dashboard', compact('proposals', 'user'));
    }

    public function submitPillarScore(Request $request, $id)
    {
        $request->validate([
            'pillar' => 'required|in:parahyangan,pawongan,palemahan',
            'score'  => 'required|numeric|min:0|max:100',
            'notes'  => 'nullable|string|max:2000',
        ]);

        $proposal = Proposal::findOrFail($id);
        $pillar = $request->pillar;

        // Update score and notes for the specific pillar
        if ($pillar === 'parahyangan') {
            $proposal->score_parahyangan = $request->score;
            $proposal->notes_parahyangan = $request->notes;
            $pillarName = 'Parahyangan';
        } elseif ($pillar === 'pawongan') {
            $proposal->score_pawongan = $request->score;
            $proposal->notes_pawongan = $request->notes;
            $pillarName = 'Pawongan';
        } else {
            $proposal->score_palemahan = $request->score;
            $proposal->notes_palemahan = $request->notes;
            $pillarName = 'Palemahan';
        }

        // Calculate average final score across all 3 pillars if available
        $scores = array_filter([
            $proposal->score_parahyangan,
            $proposal->score_pawongan,
            $proposal->score_palemahan
        ], fn($v) => !is_null($v) && $v !== '');

        if (count($scores) > 0) {
            $proposal->final_score = round(array_sum($scores) / count($scores), 2);
        }

        // If all 3 pillars have been assessed, update status to 'Hasil Penilaian'
        if (!is_null($proposal->score_parahyangan) && !is_null($proposal->score_pawongan) && !is_null($proposal->score_palemahan)) {
            $proposal->status = 'Hasil Penilaian';
        }

        $proposal->save();

        return back()->with('success', "Penilaian pilar {$pillarName} untuk instansi {$proposal->institution_name} berhasil disimpan dan diserahkan ke Admin / Pak Laba.");
    }
}
