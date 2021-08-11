<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\City;
use DB;

class HotelController extends Controller
{
    public function getHotelDetails(){
        $hotel_details = Hotel::where('status',1)->where('featured',1)->get();
        $city_details = City::where('status',1)->get();
        if($hotel_details){
            return view('hotel/hotel_index',['hotel_details'=>$hotel_details,'city_details'=>$city_details]);
        }
    }

    public function getHotels(){
        $hotels = Hotel::join('cities','cities.id','=','hotels.city_id')->select('*','cities.name as city_name')->where('hotels.status',1)->get();
        $cities = Hotel::join('cities','cities.id','=','hotels.city_id')->select('city_id','cities.name',DB::raw('COUNT(hotels.id) as no_of_hotels'))->where('hotels.status',1)->groupBy('city_id')->get();
        if($hotels){
            return view('hotel/hotel_list',['hotels'=>$hotels,'cities'=>$cities]);
        }
    }

    public function getHotelDetailsByCity(Request $request){
        $data = $request->all();
        $city = $data['city'];
        $hotels = Hotel::where('city_id',$city)->where('status',1)->get();
        return response()->json($hotels);
    }

}
?>