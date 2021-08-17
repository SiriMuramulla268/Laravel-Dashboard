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

    public function getAllHotels(){
        $hotels = array();
        $room_data = array();

        // Hotels with city name for Hotels balde page
        $hotels = Hotel::with(['city' => function($query) {
            $query->select(['id', 'name'])->where('cities.status',1);
        }])->where('hotels.status', 1)->get();
        
        // Cities with no.of.hotels 
        $cities = City::select(['id','name'])->withCount('hotels as no_of_hotels')
        ->where('cities.status', 1)->get();
        if($hotels && $cities){
            return view('hotel/list', ['hotels'=>$hotels, 'cities'=>$cities]);
        }else{
            return view('hotel/list', ['hotels'=>[], 'cities'=>[]]);
        }
    }

    public function getHotelDetails(string $hotel_slug, Request $request)
    {
        $hotel_data = array();
        $room_data = array();
        
        // Get hotel data with currency symbol
        $hotel_data = Hotel::with(['country' => function($query) {
            $query->select(['id','currency_symbol']);
        }])->where('hotels.slug', $hotel_slug)->where('hotels.status', 1)->first();

        // Get Room data of hotel with amenities
        $room_data = Room::with('amenities')->where('rooms.status',1)->where('rooms.hotel_id',$hotel_data->id)->get();

        if($hotel_data && $room_data){
            return view('hotel/detail', ['hotel_detail'=>$hotel_data, 'room_detail'=>$room_data]);
        }else{
            return view('hotel/detail', ['hotel_detail'=>[], 'room_detail'=>[]]);
        }
    }

    public function getHotelByCity(Request $request){
        $data = $request->all();
        $get_hotels = Hotel::whereIn('hotels.city_id',$data['city'])->where('hotels.status',1)->get();
    
        $cities = City::select(['id','name'])->withCount('hotels as no_of_hotels')
        ->where('cities.status', 1)->get();

        if($get_hotels){
            return view('hotel/list', ['hotels'=>$get_hotels, 'cities'=>$cities, 'city_id' => $data['city']]);
        }else{
            return view('hotel/list', ['hotels'=>[], 'cities'=>[] ]);
        }
    }
}


// $hotels = Hotel::with('city:id,name')->where('hotels.status', 1)->get();
// $hotels = Hotel::select(['id', 'name'])->with('city')->where('hotels.status',1)->get();
// $hotels = City::withCount(['hotels as no_of_hotels' => function($query){
//     $query->where('hotels.status', 1);
// }])->where('cities.status', 1)->get();

?>



