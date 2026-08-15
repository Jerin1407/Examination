<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftUsersCustomModel extends Model
{
    protected $table = 'savsoft_users_custom';
    protected $primaryKey = 'c_id';
    public $timestamps = false;

    protected $fillable = [
        'field_id',
        'uid',
        'field_values'
    ];
}
