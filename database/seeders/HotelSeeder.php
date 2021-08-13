<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Faker\Factory as Faker;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $getData = Country::join('states','states.country_id','countries.id')
        ->join('cities','cities.state_id','states.id')
        ->select('countries.id as country_id','cities.state_id','cities.id as city_id')
        ->where('countries.id',10)->get();

        $faker = Faker::create();
        for($i=0;$i<20;$i++){
            $insert = new Hotel;
            $insert->name = $faker->company;
            $insert->slug = preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($insert->name));
            $insert->email = strtolower(str_replace(' ','',$insert->name)).'@gmail.com';
            $insert->address = $faker->address;
            $insert->country_id = $getData->random()->country_id;
            $insert->state_id = $getData->random()->state_id;
            $insert->city_id = $getData->random()->city_id;
            $insert->description = $faker->text;
            $insert->website_url = $faker->url();
            $insert->featured = $faker->randomElement([1,0]);
            $insert->status = 1;
            $insert->save();
        }
    }

}
