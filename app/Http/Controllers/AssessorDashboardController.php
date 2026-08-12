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
        $currentAssessor = Auth::user();
        $proposals = Proposal::with(['user', 'assessorParahyangan', 'assessorPawongan', 'assessorPalemahan'])
            ->orderBy('id', 'desc')
            ->get();

        return view('assessor.dashboard', compact('proposals', 'currentAssessor'));
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

        return back()->with('success', 'Status pendaftaran peserta berhasil diperbarui.');
    }

    public function submitEvaluation(Request $request, $id)
    {
        $request->validate([
            'pillar' => 'required|in:parahyangan,pawongan,palemahan',
            'score'  => 'required|integer|min:0|max:100',
            'notes'  => 'nullable|string|max:2000',
        ]);

        $proposal = Proposal::findOrFail($id);
        $pillar = $request->pillar;

        $updateData = [
            "score_{$pillar}" => $request->score,
            "notes_{$pillar}" => $request->notes,
        ];

        // Also assign current assessor ID if not assigned yet
        $assessorField = "assessor_{$pillar}_id";
        if (!$proposal->$assessorField && Auth::id()) {
            $updateData[$assessorField] = Auth::id();
        }

        $proposal->update($updateData);

        // Refresh model to compute final score & recommendation
        $proposal->refresh();
        $avgScore = $proposal->calculated_average_score;
        $suggestedMedal = $proposal->suggested_medal;

        $proposal->update([
            'final_score' => $avgScore,
            'award_recommendation' => $suggestedMedal,
        ]);

        // If all 3 pillar scores are completed, set status to 'Hasil Penilaian' if still in 'Penilaian Lapangan'
        if (!is_null($proposal->score_parahyangan) && !is_null($proposal->score_pawongan) && !is_null($proposal->score_palemahan)) {
            if ($proposal->status === 'Penilaian Lapangan' || $proposal->status === 'Verifikasi Admin') {
                $proposal->update(['status' => 'Hasil Penilaian']);
            }
        }

        $pillarName = ucfirst($pillar);
        return back()->with('success', "Nilai & catatan evaluasi Pilar {$pillarName} ({$request->score}/100) berhasil disimpan dan diteruskan ke Admin.");
    }
}
