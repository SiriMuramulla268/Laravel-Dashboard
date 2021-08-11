<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'description',
        'website_url',
        'featured',
        'status'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function state(){
        return $this->belongsTo(State::class);
    }
    public function room(){
        return $this->hasMany(Room::class);
    }
    public function booking(){
        return $this->hasMany(Booking::class);
    }
}
