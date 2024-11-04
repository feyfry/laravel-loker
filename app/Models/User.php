<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Loker;
use App\Models\Lamaran;
use App\Models\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function loker(): HasMany
    {
        return $this->hasMany(Loker::class);
    }

    public function lamaran(): HasMany
    {
        return $this->hasMany(Lamaran::class, 'applicant_id');

    }

    /**
     * Periksa apakah pengguna memiliki peran tertentu/spesifik role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Periksa apakah pengguna memiliki salah satu peran yang diberikan.
     *
     * @param array|string $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return in_array($this->role, (array) $roles);
    }

    /**
     * Periksa apakah pengguna adalah owner.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Periksa apakah pengguna adalah operator.
     *
     * @return bool
     */
    public function isPelamar()
    {
        return $this->hasRole('pelamar');
    }
}
