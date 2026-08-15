<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptiveQuesFilesModel extends Model
{
    protected $table = 'descriptive_ques_files';
    protected $primaryKey = 'desc_file_id';
    public $timestamps = false;

    protected $fillable = [
        'file_id',
        'uid',
        'q_id',
        'updated_time'
    ];
}
