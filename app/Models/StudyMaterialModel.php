<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyMaterialModel extends Model
{
    protected $table = 'study_material';
    protected $primaryKey = 'stid';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'study_description',
        'gids',
        'cid',
        'created_date',
        'created_by',
        'attachment'
    ];
}
