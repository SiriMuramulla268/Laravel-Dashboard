<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    use HasFactory;

    // Table Name
    protected $table = 'room_amenity';
    // Primary Key
    public $primary_key = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'room_id',
        'aminity_id',
        'status'
    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
