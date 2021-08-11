<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\Amenity;
use App\Models\RoomAmenity;

class RoomAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<4;$i++){
            $insert = new RoomAmenity;
            $insert->room_id = Room::all()->random()->id;
            $insert->amenity_id = Amenity::all()->random()->id;
            $insert->save();
        }
    }
}
