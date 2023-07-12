<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'perfomed_by',
        'veneus_id',
        'type',
        'description',
        'staff_id',
        'manager_id',
    ];

    protected $dates = [
        'activated',
        'deleted_at',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class,'veneus_id');
    }
}