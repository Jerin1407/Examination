<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialGroupModel extends Model
{
    protected $table = 'social_group';
    protected $primaryKey = 'sg_id';
    public $timestamps = false;

    protected $fillable = [
        'sg_name',
        'about',
        'sg_status',
        'no_member',
        'created_date',
        'created_by'
    ];
}
