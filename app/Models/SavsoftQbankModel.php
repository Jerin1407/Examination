<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftQbankModel extends Model
{
    protected $table = 'savsoft_qbank';
    protected $primaryKey = 'qid';
    public $timestamps = false;

    protected $fillable = [
        'question_type',
        'question',
        'description',
        'question1',
        'description1',
        'cid',
        'lid',
        'no_time_served',
        'no_time_corrected',
        'no_time_incorrected',
        'no_time_unattempted',
        'inserted_by',
        'inserted_by_name',
        'paragraph',
        'paragraph1',
        'parent_id',
        'is_upload'
    ];
}
