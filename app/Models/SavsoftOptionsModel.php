<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftOptionsModel extends Model
{
    protected $table = 'savsoft_options';
    protected $primaryKey = 'oid';
    public $timestamps = false;

    protected $fillable = [
        'qid',
        'q_option',
        'q_option_match',
        'q_option1',
        'score',
        'q_option_match1'
    ];
}
