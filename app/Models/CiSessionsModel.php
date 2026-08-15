<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CiSessionsModel extends Model
{
    protected $table = 'ci_sessions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'ip_address',
        'data',
        'timestamp'
    ];
}
