<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'applicant_profiles';

    protected $fillable = [
        'uuid',
        'user_id',
        'full_name',
        'date_of_birth',
        'phone_number',
        'address',
        'education',
        'experience',
        'skills',
        'resume',
        'image',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->user_id = Auth::user()->id;
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
