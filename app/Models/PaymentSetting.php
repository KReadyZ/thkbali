<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $table = 'payment_settings';

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'amount',
        'description',
        'qr_image',
    ];
}
