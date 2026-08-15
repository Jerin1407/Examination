<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LongAnswerFileModel extends Model
{
    protected $table = 'long_answer_file';
    protected $primaryKey = 'long_answer_id ';
    public $timestamps = false;

    protected $fillable = [
        'rid',
        'uid',
        'qid',
        'answer',
        'updated_time'
    ];
}
