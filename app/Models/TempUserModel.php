<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempUserModel extends Model
{
    protected $table = 'temp_user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'grp_name',
        'firstname',
        'contact_no',
        'password',
        'grup_id',
        'is_active'
    ];
}
