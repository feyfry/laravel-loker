<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'message',
        'type',
        'data',
        'link',
        'is_read'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean'
    ];

    // Generate UUID sebelum create
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk notifikasi yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope untuk tipe notifikasi tertentu
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
