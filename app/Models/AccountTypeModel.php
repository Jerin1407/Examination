<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountTypeModel extends Model
{
    protected $table = 'account_type';
    protected $primaryKey = 'account_id';
    public $timestamps = false;

    protected $fillable = [
        'users',
        'quiz',
        'results',
        'questions',
        'account_name',
        'setting',
        'study_material',
        'appointment'
    ];
}
