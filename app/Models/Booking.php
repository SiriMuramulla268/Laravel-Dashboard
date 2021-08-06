<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'bookings';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'hotel_id',
        'booking_no',
        'date',
        'user_id',
        'request',
        'response',
        'booking_status'
    ];

    public function bookingDetail(){
        return $this->hasOne(BookingDetail::class,'booking_id','id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
