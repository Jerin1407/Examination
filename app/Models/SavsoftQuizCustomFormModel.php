<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftQuizCustomFormModel extends Model
{
    protected $table = 'savsoftquiz_custom_form';
    protected $primaryKey = 'field_id';
    public $timestamps = false;

    protected $fillable = [
        'field_title',
        'field_type',
        'field_validate',
        'field_value',
        'display_at'
    ];
}
