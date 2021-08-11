<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'user_id',
        'request',
        'response',
        'booking_status'
    ];

    public function bookingDetail(){
        return $this->hasMany(BookingDetail::class);
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
