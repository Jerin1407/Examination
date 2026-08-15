<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersResultModel extends Model
{
    protected $table = 'users_result';
    protected $primaryKey = 'user_result_id';
    public $timestamps = false;

    protected $fillable = [
        'qstn_no',
        'uid',
        'q_id',
        'res_id',
        'mark',
        'remarks',
        'updated_time'
    ];
}
