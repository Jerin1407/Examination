<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptiveExamResultsModel extends Model
{
    protected $table = 'descriptive_exam_results';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'uid',
        'mark',
        'created_by',
        'created_date',
        'answer_file_id'
    ];
}
