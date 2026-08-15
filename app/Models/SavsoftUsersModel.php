<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavsoftUsersModel extends Model
{
    protected $table = 'savsoft_users';
    protected $primaryKey = 'uid';
    public $timestamps = false;

    protected $fillable = [
        'password',
        'email',
        'first_name',
        'last_name',
        'contact_no',
        'connection_key',
        'gid',
        'su',
        'inserted_by',
        'subscription_expired',
        'verify_code',
        'wp_user',
        'registered_date',
        'photo',
        'user_status',
        'web_token',
        'android_token',
        'skype_id',
        'time_zone',
    ];
}
