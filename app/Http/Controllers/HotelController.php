<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\City;
use App\Models\Room;
use DB;
use DateTime;

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
        $hotels = Hotel::where('hotels.status', 1)->simplepaginate(4); 

        // Cities with no.of.hotels 
        $cities = City::select(['id','name'])->withCount('hotels as no_of_hotels')->having('no_of_hotels', '>', 0)
        ->where('cities.status', 1)->get();

        if($hotels && $cities){
            return view('hotel/list', ['hotels'=>$hotels, 'cities'=>$cities, 'data'=>'']);
        }else{
            return view('hotel/list', ['hotels'=>[], 'cities'=>[], 'data'=>'']);
        }
    }

    public function getHotelByCity(Request $request){

        $data = $request->all();
        $page = isset($data['page'])?$data['page']: '';
        $city = isset($data['city'])?$data['city']: '';
        $dates = isset($data['dates'])?$data['dates']:'';

        $cities = City::select(['id','name'])->withCount('hotels as no_of_hotels')->having('no_of_hotels', '>', 0)
        ->where('cities.status', 1)->get();

        if(!$data || $page != '' && $city == ''){
            $get_hotels = Hotel::where('hotels.status',1)->simplepaginate(4);
            if($get_hotels){
                return view('hotel/list', ['hotels'=>$get_hotels, 'cities'=>$cities , 'data'=>'']);
            }
            else{
                return view('hotel/list', ['hotels'=>[], 'cities'=>[] , 'data'=>'']);
            }
        }
        // if($page != '' && $city == ''){
        //     $get_hotels = Hotel::where('hotels.status',1)->simplepaginate(4);
        //     return view('hotel/list', ['hotels'=>$get_hotels, 'cities'=>$cities , 'data'=>'']);
        // }
        elseif($data){
            $get_hotels = Hotel::whereIn('hotels.city_id',$data['city'])->where('hotels.status',1)->simplepaginate(4);
            if($get_hotels){
                return view('hotel/list', ['hotels'=>$get_hotels, 'cities'=>$cities, 'city_id' => $city, 'dates'=>$dates, 'adult'=>$data['qtyInput'][0], 'data'=>$data]);
            }
            else{
                return view('hotel/list', ['hotels'=>[], 'cities'=>[] , 'data'=>'']);
            }
        }
    }

    public function getHotelDetails(string $hotel_slug, $dates, Request $request)
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
            return view('hotel/detail', ['hotel_detail'=>$hotel_data, 'room_detail'=>$room_data, 'dates'=>$dates]);
        }else{
            return view('hotel/detail', ['hotel_detail'=>[], 'room_detail'=>[]]);
        }
    }

    public function getRoomPrice(Request $request){
        $data = $request->all();

        $room_data = Room::where('id', $data['room'])->where('status', 1)->first();
        if($room_data){
            return $room_data->price;
        }
    }

    public function getCart1(Request $request){
        $data = $request->all();
        $date_arr = explode('>', str_replace(" ",'',$data['dates']));
        $check_in = $date_arr[0];
        $check_out = $date_arr[1];
        $datetime1 = new DateTime($check_in);
        $datetime2 = new DateTime($check_out);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%d'); 
        $adult = (int) $data['qtyInput'][0];
        $child = (int) $data['qtyInput'][1];
        $room_price = $days * (int)$data['room_price'];
       
        $room_details = Room::with('hotels')->where('id',(int)$data['room'])->where('rooms.status',1)->get();
        if($room_details){
           
            return view('hotel/cart1',['room_details'=>$room_details, 'total'=>$room_price, 'adult'=> $adult, 'child'=>$child, 'check_in'=>$check_in, 'check_out'=>$check_out]);
        }
    }
}


// $hotels = Hotel::with('city:id,name')->where('hotels.status', 1)->get();
// $hotels = Hotel::select(['id', 'name'])->with('city')->where('hotels.status',1)->get();
// $hotels = City::withCount(['hotels as no_of_hotels' => function($query){
//     $query->where('hotels.status', 1);
// }])->where('cities.status', 1)->get();
// $hotels = Hotel::with(['city' => function($query) {
//     $query->select(['id', 'name'])->where('cities.status',1);
// }])->where('hotels.status', 1)->simplepaginate(4); 

?>



