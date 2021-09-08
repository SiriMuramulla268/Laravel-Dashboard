<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $appends = ['min_price'];


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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getMinPriceAttribute()
    {
        return  $this->rooms()->where('status', 1)->exists() ? $this->rooms->min('price')  : 0 ;
    }
}
