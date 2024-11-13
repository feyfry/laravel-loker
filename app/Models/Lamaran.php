<?php

namespace App\Models;

use App\Models\Loker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lamaran extends Model
{
    protected $table = 'applications';

    use HasFactory;

    protected $fillable = [
        'uuid',
        'jobdesc_id',
        'applicant_id',
        'status',
        'date',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function jobdesc(): BelongsTo
    {
        return $this->belongsTo(Loker::class, 'jobdesc_id');
    }

    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function interviewSchedule(): HasOne
    {
        return $this->hasOne(InterviewSchedule::class, 'application_id');
    }
}
