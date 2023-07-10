<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    // User roles
    const ROLE_VENUE_MANAGER = 'Manager';
    const ROLE_VENUE_STAFF = 'Staff';

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'status',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
        'deleted_at',
    ];

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }

    public function staff()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}