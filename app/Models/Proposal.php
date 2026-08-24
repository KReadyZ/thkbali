<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'institution_name',
        'category',
        'file_path',
        'status',
        'address',
        'gmaps_link',
        'contact_name',
        'contact_wa',
        'contact_email',
        'payment_proof',
        'prev_accreditation',
        'link_parahyangan',
        'link_pawongan',
        'link_palemahan',
        'thk_leader_name',
        'thk_leader_wa',
        'pic_parahyangan_name',
        'pic_parahyangan_wa',
        'pic_pawongan_name',
        'pic_pawongan_wa',
        'pic_palemahan_name',
        'pic_palemahan_wa',
        'assessor_parahyangan_id',
        'visit_day_parahyangan',
        'assessor_pawongan_id',
        'visit_day_pawongan',
        'assessor_palemahan_id',
        'visit_day_palemahan',
        'score_parahyangan',
        'notes_parahyangan',
        'score_pawongan',
        'notes_pawongan',
        'score_palemahan',
        'notes_palemahan',
        'final_score',
        'award_recommendation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assessorParahyangan()
    {
        return $this->belongsTo(User::class, 'assessor_parahyangan_id');
    }

    public function assessorPawongan()
    {
        return $this->belongsTo(User::class, 'assessor_pawongan_id');
    }

    public function assessorPalemahan()
    {
        return $this->belongsTo(User::class, 'assessor_palemahan_id');
    }
}
