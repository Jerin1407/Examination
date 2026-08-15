<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionFilesModel extends Model
{
    protected $table = 'question_files';
    protected $primaryKey = 'file_id';
    public $timestamps = false;

    protected $fillable = [
        'file_name',
        'file_extension',
        'file_size',
        'file_type',
        'file_path',
        'upload_time'
    ];
}
