<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftAnswersModel extends Model
{
    protected $table = 'savsoft_answers';
    protected $primaryKey = 'aid';
    public $timestamps = false;

    protected $fillable = [
        'qid',
        'q_option',
        'uid',
        'score_u',
        'rid',
        'qn'
    ];
}
