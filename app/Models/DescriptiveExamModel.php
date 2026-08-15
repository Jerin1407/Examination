<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptiveExamModel extends Model
{
    protected $table = 'descriptive_exam';
    protected $primaryKey = 'desc_id';
    public $timestamps = false;

    protected $fillable = [
        'desc_name',
        'date',
        'created_by',
        'created_date',
        'is_active'
    ];
}
