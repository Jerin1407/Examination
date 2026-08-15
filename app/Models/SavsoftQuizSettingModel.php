<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftQuizSettingModel extends Model
{
    protected $table = 'savsoftquiz_setting';
    protected $primaryKey = 'setting_id';
    public $timestamps = false;

    protected $fillable = [
        'setting_name',
        'setting_value',
        'setting_group_name',
        'order_by',
        'setting_description'
    ];
}
