<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'check_in',
        'check_out',
        'guest_details',
        'no_of_rooms',
        'room_type',
        'amount',
        'adult',
        'child'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function rooms(){
        return $this->belongsTo(Room::class, 'room_id');
    }
}
