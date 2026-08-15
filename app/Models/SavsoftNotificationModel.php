<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftNotificationModel extends Model
{
    protected $table = 'savsoft_notification';
    protected $primaryKey = 'nid';
    public $timestamps = false;

    protected $fillable = [
        'notification_date',
        'title',
        'message',
        'click_action',
        'notification_to',
        'response',
        'uid',
        'viewed'
    ];
}
