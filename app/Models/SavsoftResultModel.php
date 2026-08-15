<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftResultModel extends Model
{
    protected $table = 'savsoft_result';
    protected $primaryKey = 'rid';
    public $timestamps = false;

    protected $fillable = [
        'quid',
        'uid',
        'result_status',
        'start_time',
        'end_time',
        'categories',
        'category_range',
        'r_qids',
        'individual_time',
        'total_time',
        'score_obtained',
        'exam_date',
        'percentage_obtained',
        'attempted_ip',
        'score_individual',
        'photo',
        'manual_valuation',
        'long_answer_valuation',
        'is_valuation'
    ];
}
