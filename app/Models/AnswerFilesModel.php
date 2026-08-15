<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerFilesModel extends Model
{
    protected $table = 'answer_files';
    protected $primaryKey = 'answer_file_id';
    public $timestamps = false;

    protected $fillable = [
        'file_id',
        'uid',
        'q_id',
        'r_id',
        'updated_time'
    ];
}
