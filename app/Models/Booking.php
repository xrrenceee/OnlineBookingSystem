<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'booking_date',
        'notes',
    ];

    /**
     * Relationship: a booking belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
