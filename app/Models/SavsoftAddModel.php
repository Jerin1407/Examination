<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftAddModel extends Model
{
    protected $table = 'savsoft_add';
    protected $primaryKey = 'add_id';
    public $timestamps = false;

    protected $fillable = [
        'advertisement_code',
        'banner',
        'banner_link',
        'position',
        'add_status'
    ];
}
