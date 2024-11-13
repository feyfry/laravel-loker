<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InterviewSchedule extends Model
{
    protected $table = 'interview_schedules';

    use HasFactory;

    protected $fillable = [
        'uuid',
        'application_id',
        'interview_date',
        'interview_method',
        'interview_location',
        'interviewer_name',
        'notes',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Lamaran::class, 'application_id');
    }
}
