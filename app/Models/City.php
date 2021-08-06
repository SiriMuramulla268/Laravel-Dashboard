<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'cities';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'state_id',
        'name',
        'status'
    ];

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function hotel(){
        return $this->hasMany(Hotel::class);
    }
}
