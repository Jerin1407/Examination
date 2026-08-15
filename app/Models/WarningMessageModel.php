<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarningMessageModel extends Model
{
    protected $table = 'warning_message';
    protected $primaryKey = 'wid';
    public $timestamps = false;

    protected $fillable = [
        'rid',
        'uid',
        'warning_time',
        'warning_message'
    ];
}
