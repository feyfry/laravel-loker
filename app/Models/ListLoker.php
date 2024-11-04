<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ListLoker extends Model
{
    use HasFactory;

    protected $table = 'job_descs';

    protected $fillable = [
        'uuid',
        'posted_by',
        'title',
        'company_name',
        'location',
        'position',
        'type',
        'salary_range_min',
        'salary_range_max',
        'description',
        'requirements',
        'questions',
        'status',
    ];

    public static function booted()
    {

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function loker(): HasMany
    {
        return $this->hasMany(Loker::class, 'uuid', 'uuid');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
