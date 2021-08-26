<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\City;
use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailer;
use DB;
use DateTime;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Config;

class HotelController extends Controller
{
    public function getHotelIndex(){
        $hotel_details = Hotel::where('status', 1)->where('featured', 1)->get();
        $city_details = City::where('status', 1)->get();
        if($hotel_details){
            return view('hotel/index', ['hotel_details'=>$hotel_details, 'city_details'=>$city_details]);
        }else{
            return view('hotel/index', ['hotel_details'=>[], 'city_details'=>[]]);
        }
    }

    public function getHotels(Request $request){
        $request_data = $request->all();
        $data = isset($request_data)?$request_data:[];
        $page = isset($data['page'])?$data['page']: '';
        $city = isset($data['city'])?$data['city']: [];
        $dates = isset($data['dates'])?$data['dates']:'';
        $adult = isset($data['qtyInput'][0])?$data['qtyInput'][0]:1;
        $cities = [];
        $get_hotels = [];
        
        $cities = City::select(['id','name'])->withCount('hotels as no_of_hotels')
        ->having('no_of_hotels', '>', 0)->where('cities.status', 1)->get();

        $get_hotels = Hotel::where('hotels.status',1)->paginate(4);

        $retun_array = array('hotels'=>$get_hotels, 'cities'=>$cities, 'city_id' => $city,
         'dates'=>$dates, 'adult'=>$adult, 'data'=>$data);

        if(!$data){ 
            if($get_hotels){
                return view('hotel/list', $retun_array);
            }else{
                return view('hotel/list', $retun_array);
            }
        }
        else{
            if($page!='' && !$city){
                if($get_hotels){
                    return view('hotel/list', $retun_array);
                }else{
                    return view('hotel/list', $retun_array);
                }
            }else{
                $get_hotels = Hotel::whereIn('hotels.city_id',$city)->where('hotels.status',1)->paginate(4);
                if($get_hotels){
                    $retun_array['hotels'] = $get_hotels;
                    return view('hotel/list', $retun_array);
                }else{
                    return view('hotel/list', $retun_array);
                }
            }
        }
    }

    public function getHotelDetails(string $hotel_slug, $dates, Request $request)
    {
        $hotel_data = array();
        $room_data = array();
        if($dates == 0){
            $dates = '';
        }
        
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

    public function addToCart(Request $request){
        $data = $request->all();
        $request->session()->put($data);
        $price = 0;
        $cart_url = $data['url'];
        $date_arr = explode('>', str_replace(" ",'',$data['dates']));
        $check_in = date('Y-m-d', strtotime(strtr($date_arr[0], '-', '/')));
        $check_out = date('Y-m-d', strtotime(strtr($date_arr[1], '-', '/')));
        $datetime1 = new DateTime($check_in);
        $datetime2 =  new DateTime($check_out);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%d'); 
        $adult = (int) $data['qtyInput'];
        $room_qty = explode(',',$data['room_qty']);
        $room = explode(',',$data['roomid']);
        for($i=0;$i<sizeof($room);$i++){
            $roomid[] = (int)$room[$i];
        }
        $room_details = Room::with('hotels')->whereIn('id',$roomid)->where('rooms.status',1)->get();
        if($room_details){
            foreach($room_details as $key=>$details){
                $price += $days * (int)$details['price'] * $room_qty[$key];
                $hotel_id = $details['hotel_id'];
            }
            $hotel = Hotel::where('id',$hotel_id)->first();
            //array data push to blade page
            $return_array = array('room_details'=>$room_details, 'total'=>number_format($price,2,".",""), 'adult'=> $adult, 'check_in'=>$date_arr[0], 'check_out'=>$date_arr[1], 'currency'=>$hotel->country->currency_symbol,'currency_code'=>$hotel->country->currency, 'cart_url'=>$cart_url,'room_qty'=>$room_qty);
            $request->session()->put($return_array);

            return 1;
        }else{
            return 0;
        }
    }

    public function getCart(){
        return view('hotel/cart');
    }

    public function getCheckout($token, Request $request){
        return view('hotel/checkout',['token'=>$token]);
    }

    public function getExistUser(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $get_user = User::where('email',$request->email)->first();
            session()->put('user',$get_user);
            return 1;
        }
    }

    public function booking(Request $request){
        $data = $request->all();
        $session = session()->all();
        if(!isset($session['room_details'])){
           return redirect('/hotels');
        }
        $hotel_id = $session['room_details'][0]['hotels']->id;
        $hotel_name = $session['room_details'][0]['hotels']->name;
        $rooms = $session['room_details'];
        $check_in = date('Y-m-d', strtotime(strtr($session['check_in'], '-', '/')));
        $check_out = date('Y-m-d', strtotime(strtr($session['check_out'], '-', '/')));
        
        //Insert or Update User details
        $user = User::updateOrCreate(
            ['email' => $data['email_booking']],
            ['type' => 'user', 'name' => $data['name_booking'], 'mobile' => $data['telephone_booking'], 'address' => $data['address_booking']]
        );
        if($user->id){
            session()->put('user',$user);
            //Booking initiated
            $insert_booking = new Booking;
            $insert_booking['hotel_id'] = $hotel_id;
            $insert_booking['user_id'] = $user->id;
            $insert_booking['request'] = $request;
            $insert_booking['booking_status'] = 'pending';
            $insert_booking['total'] = $session['total'];
            if($insert_booking->save()){
                foreach($rooms as $room){
                    $booking_details = new BookingDetail;
                    $booking_details['booking_id'] = $insert_booking->id;
                    $booking_details['check_in'] = $check_in;
                    $booking_details['check_out'] = $check_out;
                    $booking_details['guest_details'] = $data['address_booking'];
                    $booking_details['room_id'] = $room['id'];
                    $booking_details['amount'] = $room['price'];
                    $booking_details['adult'] = $session['adult'];
                    $booking_details->save();
                }

                //Stripe Payment Gateway
                $stripe_secret = Stripe::setApiKey(env('STRIPE_SECRET'));
                $customer = Customer::create(array(
                    'name' => $data['name_booking'],
                    'email' => $data['email_booking'],
                    'source' => $data['stripeToken'],
                    "address" => ["city" => $data['city_booking'], "country" => $data['country'], "line1" => $data['street_1'], "line2" => $data['street_2'], "postal_code" => $data['postal_code'], "state" => $data['state_booking']]
                ));
                
                $payment_response = Charge::create ([
                    'customer' => $customer->id, 
                    "amount" => (int)$session['total'],
                    "currency" => strtolower($session['currency_code']),
                    "description" => "Test payment"
                ]);
                if($payment_response){
                    if($payment_response->status == 'succeeded'){
                        $insert_booking['booking_status'] = 'success';
                        $insert_booking['response'] = $payment_response;
                        $insert_booking->save();

                        $details = ['transaction_no' => $payment_response->balance_transaction, 'booking_no' => $insert_booking->id,'user' => $user->name, 'hotel' => $hotel_name, 'rooms' => $session['rooms'], 
                        'check_in' => $check_in, 'check_out' => $check_out, 'adult' => $session['adult']];
                      
                        // Mail::send('emails.mail',$details, function ($m) use ($user) {
                        //     $m->from('hotelbooking@gmail.com','Hotel Booking');
                        //     $m->to($user->email, $user->name)->subject('Confirm Booking!');
                        // });

                        Mail::to($user->email, $user->name)->send(new Mailer($details));

                        session()->forget(['room_details']);
                        return view('hotel/book',['response'=>$payment_response,'email' => $user->email]);
                    }else{
                        $insert_booking['booking_status'] = 'fail';
                        $insert_booking['response'] = $payment_response;
                        $insert_booking->save();
                        return view('hotel/book',['response'=>$payment_response]);
                    }
                }
            }
        }
    }

}

?>



