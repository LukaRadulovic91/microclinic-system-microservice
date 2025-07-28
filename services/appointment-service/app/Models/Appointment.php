<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'scheduled_for',
        'notes',
    ];

    protected $dates = [
        'scheduled_for',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
