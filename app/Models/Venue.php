<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'status',
        'description',
        'phone',
        'email',
        'website',
        'address',
        'latitude',
        'longitude',
        'staff_id',
        'manager_id',
    ];

    protected $dates = [
        'activated',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}