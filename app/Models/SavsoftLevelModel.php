<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftLevelModel extends Model
{
    protected $table = 'savsoft_level';
    protected $primaryKey = 'lid';
    public $timestamps = false;

    protected $fillable = [
        'level_name'
    ];
}
