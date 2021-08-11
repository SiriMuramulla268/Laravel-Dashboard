<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\Amenity;
use App\Models\RoomAmenity;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $getHotelData = Hotel::get();
        $getAmenityData = Amenity::get();
        $room_type_array = ['Single Room','Luxury Room','Deluxe Room'];
        foreach($getHotelData as $data){
            for($i=0;$i<sizeof($room_type_array);$i++){   
                $insert = new Room;
                $insert->hotel_id = $data->id;
                $insert->type = $room_type_array[$i];
                $insert->per_child_price = $faker->numerify('####');
                $insert->per_adult_price = $insert->per_child_price + $faker->numerify('####');
                $insert->price = $insert->per_adult_price + $faker->numerify('####');
                $insert->status = 1;
                $insert->save();

                // Insert data to room amenity table
                foreach($getAmenityData as $amenity){
                    $room_amenity = new RoomAmenity;
                    $room_amenity->room_id = $insert->id;
                    $room_amenity->amenity_id = $amenity->id;
                    $room_amenity->save();
                }
            }
        }
    }
}
