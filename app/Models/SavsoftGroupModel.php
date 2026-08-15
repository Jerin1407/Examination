<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftGroupModel extends Model
{
    protected $table = 'savsoft_group';
    protected $primaryKey = 'gid';
    public $timestamps = false;

    protected $fillable = [
        'group_name',
        'price',
        'valid_for_days',
        'description'
    ];
}
