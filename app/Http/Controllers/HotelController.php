<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\City;
use App\Models\Room;
use DB;

class HotelController extends Controller
{
    public function getHotelIndex(){
        $hotel_details = Hotel::where('status', 1)->where('featured', 1)->get();
        $city_details = City::where('status', 1)->get();
        if($hotel_details){
            return view('hotel/index', ['hotel_details'=>$hotel_details, 'city_details'=>$city_details]);
        }
    }

    public function getAllHotel(){
        $hotels = Hotel::join('cities', 'cities.id', '=', 'hotels.city_id')
        ->select('*', 'cities.name as city_name')->where('hotels.status', 1)->get();

        $cities = Hotel::join('cities', 'cities.id','=','hotels.city_id')
        ->select('city_id', 'cities.name', DB::raw('COUNT(hotels.id) as no_of_hotels'))
        ->where('hotels.status', 1)->groupBy('city_id')->get();

        if($hotels){
            return view('hotel/list', ['hotels'=>$hotels, 'cities'=>$cities]);
        }
    }

    public function getHotelByCity(Request $request){
        $data = $request->all();
        $city = $data['city'];
        $hotels = Hotel::where('city_id', $city)->where('status', 1)->get();
        return response()->json($hotels);
    }

    public function getHotelDetail(int $hotel_id, Request $request){
       
        $hotel_data = Hotel::join('countries','countries.id','=','hotels.country_id')
        ->select('hotels.name','hotels.description','countries.currency_symbol')
        ->where('hotels.id', $hotel_id)->where('hotels.status', 1)->first();
        
        $room_data = Hotel::join('rooms','rooms.hotel_id','=','hotels.id')
        ->join('room_amenity', 'room_amenity.room_id','=','rooms.id')
        ->join('amenities', 'amenities.id','=','room_amenity.amenity_id')
        ->select('rooms.type',DB::raw('GROUP_CONCAT(amenities.name) as amenity'), 
                DB::raw('GROUP_CONCAT(DISTINCT per_adult_price) as per_person'))
        ->where('hotels.id', $hotel_id)->where('hotels.status', 1)->groupByRaw('rooms.type')->get();
        if($room_data){
            foreach($room_data as $key=>$detail){
                $amenity_array = explode(',', $detail['amenity']);
                for($i=0;$i<sizeof($amenity_array);$i++){
                    $room_detail[$detail['type']]['amenity'][] = $amenity_array[$i];
                    $room_detail[$detail['type']]['per_person'] = $detail['per_person'];
                }
            }
        }
        if($hotel_data){
            return view('hotel/detail', ['hotel_detail'=>$hotel_data, 'room_detail'=>$room_detail]);
        }
    }

}
?>