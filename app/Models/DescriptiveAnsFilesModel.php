<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptiveAnsFilesModel extends Model
{
    protected $table = 'descriptive_ans_files';
    protected $primaryKey = 'desc_ans_file_id';
    public $timestamps = false;

    protected $fillable = [
        'file_id',
        'uid',
        'q_id',
        'updated_time'
    ];
}
