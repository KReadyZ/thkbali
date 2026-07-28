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
        'link_palemahan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
