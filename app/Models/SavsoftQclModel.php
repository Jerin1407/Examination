<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftQclModel extends Model
{
    protected $table = 'savsoft_qcl';
    protected $primaryKey = 'qcl_id';
    public $timestamps = false;

    protected $fillable = [
        'quid',
        'cid',
        'lid',
        'noq',
        'i_correct',
        'i_incorrect'
    ];
}
