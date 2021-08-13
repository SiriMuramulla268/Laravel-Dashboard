<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class AddSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $get_data = Hotel::get();
        
        foreach($get_data as $data){

            $update = Hotel::where('id',$data['id'])->update(['slug'=>preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($data['name']))]);

            
        }
    }
}
