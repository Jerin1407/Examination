<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftQuizModel extends Model
{
    protected $table = 'savsoft_quiz';
    protected $primaryKey = 'quid';
    public $timestamps = false;

    protected $fillable = [
        'quiz_name',
        'description',
        'start_date',
        'end_date',
        'gids',
        'qids',
        'noq',
        'correct_score',
        'incorrect_score',
        'ip_address',
        'duration',
        'maximum_attempts',
        'pass_percentage',
        'view_answer',
        'camera_req',
        'question_selection',
        'gen_certificate',
        'certificate_text',
        'with_login',
        'quiz_template',
        'uids',
        'inserted_by',
        'inserted_by_name',
        'show_chart_rank',
        'quiz_price'
    ];
}
