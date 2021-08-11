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

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function amenity(){
        return $this->belongsToMany(Amenity::class, 'room_amenity', 'room_id', 'amenity_id' );
    }

    public function roomAmenity(){
        return $this->hasMany(RoomAmenity::class);
    }


}

