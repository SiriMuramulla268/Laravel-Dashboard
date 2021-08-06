<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'hotels';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'email',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'category',
        'description',
        'website_url',
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
