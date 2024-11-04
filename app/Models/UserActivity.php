<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    protected $fillable = [
        'ip_address',
        'location',
        'browser',
        'user_agent',
        'last_activity',
        'last_page',
        'referrer',
        'session_id',
    ];

    protected $casts = [
        'location' => 'array',
        'browser' => 'array',
        'last_activity' => 'datetime',
    ];
}
