<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0;$i<20;$i++){
            $insert = new User;
            $insert->type = $faker->randomElement(['admin','user']);
            $insert->name = $faker->name;
            $insert->email = strtolower(str_replace(' ','',$insert->name)).'@gmail.com';
            $insert->password = Hash::make(strtolower(str_replace(' ','',$insert->name)));
            $insert->mobile =  $faker->phoneNumber;
            $insert->address = $faker->address;
            $insert->dob = $faker->dateTimeThisCentury->format('Y-m-d');
            $insert->save();
        }
    }
}
