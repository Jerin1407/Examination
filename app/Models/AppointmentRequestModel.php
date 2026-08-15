<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentRequestModel extends Model
{
    protected $table = 'appointment_request';
    protected $primaryKey = 'appointment_id';
    public $timestamps = false;

    protected $fillable = [
        'request_by',
        'to_id',
        'appointment_timing',
        'appointment_time_zone',
        'appointment_status'
    ];
}
