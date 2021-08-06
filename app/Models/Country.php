<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'countries';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'capital',
        'currency',
        'currency_symbol',
        'status'
    ];

    public function state(){
        return $this->hasMany(State::class);
    }

    public function hotel(){
        return $this->hasMany(Hotel::class);
    }
}
