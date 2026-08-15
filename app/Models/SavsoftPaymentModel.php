<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftPaymentModel extends Model
{
    protected $table = 'savsoft_payment';
    protected $primaryKey = 'pid';
    public $timestamps = false;

    protected $fillable = [
        'uid',
        'gid',
        'quid',
        'amount',
        'paid_date',
        'payment_gateway',
        'payment_status',
        'transaction_id',
        'other_data'
    ];
}
