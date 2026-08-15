<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialGroupJoinedModel extends Model
{
    protected $table = 'social_group_joined';
    protected $primaryKey = 'join_id';
    public $timestamps = false;

    protected $fillable = [
        'sg_id',
        'uid',
        'joined_date'
    ];
}
