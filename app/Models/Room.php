<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'type',
        'price',
        'per_adult_price',
        'per_child_price',
        'status'
    ];

    public function hotels(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }

    public function amenities(){
        return $this->belongsToMany(Amenity::class, 'room_amenity', 'room_id', 'amenity_id' );
    }

    public function roomAmenities(){
        return $this->hasMany(RoomAmenity::class);
    }

    public function bookingRoom(){
        return $this->hasMany(BookingDetail::class);
    }

}

