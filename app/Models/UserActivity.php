<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserActivity extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'ip_address',
        'location',
        'browser',
        'user_agent',
        'last_page',
        'referrer'
    ];

    protected $casts = [
        'location' => 'array',
        'browser' => 'array',
        'last_activity' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
