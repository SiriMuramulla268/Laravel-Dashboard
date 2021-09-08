<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Room;
use App\Models\Amenity;
use App\Models\RoomAmenity;
use App\Models\Members;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Config;
use DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getUserCount = User::count();
        return view('admin/index')->with(['usercount'=>$getUserCount, 'tabname'=>'dashboard']);
    }
    
    public function addUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|max:100',
            'email' => 'required|string|unique:users|email',
            'type' => 'required|string',
            'mobile' => 'required|max:10'
            ],
            [
                'name.max' => 'Name must be less than 50 characters',
                'mobile.max' => 'Mobile number must be 10 digits',
            ]
        );
        if (!$validator->passes()) {
            return back()->withError($validator->errors());
        }

        if ($validator) {
            $data = $request->all();
            $insertUser = new User();
            $insertUser['name'] = $data['name'];
            $insertUser['email'] = $data['email'];
            $insertUser['type'] = $data['type'];
            $insertUser['mobile'] = (int)$data['mobile'];
            $insertUser['password'] = Hash::make($data['password']);
            $insertUser->save();

            if ($insertUser) {
                return redirect('admin/userform')->with('status', 'User Added Successfully');
            }else {
                return redirect('admin/userform')->with('status', 'Failed');
            }
        }
    }

    public function userList()
    {
        $getMembers = User::paginate(10);
        if ($getMembers) {
            // return Datatables::of($getMembers)
            // ->addIndexColumn()
            // ->make(true);
            return view('admin/userlist', ['memberdata'=>$getMembers, 'tabname'=>'userlist']);
        }
    }

    public function hotelList()
    {
        $countries = Country::get();
        $states = State::get();
        $cities = City::get();
        return view('admin/hotellist', ['tabname'=>'hotel', 'countries'=>$countries,
        'states'=>$states, 'cities'=>$cities]);
    }

    public function getHotel()
    {
        $hotels = Hotel::with('country', 'state', 'city')->get();
        if ($hotels) {
            return Datatables::of($hotels)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $name = $row->type;
                    $btn = "<a href='' type='button' class='btn btn-info' data-toggle='modal'
                    onclick='viewHotel($id);'><i class='fas fa-eye'></i></a>
                    <a href='' type='button' class='btn btn-success' data-toggle='modal'
                    onclick='editHotel($id);'><i class='fas fa-edit'></i></a>";
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function getStateByCountry(Request $request)
    {
       $data = $request->all();
       $getStateData = State::where('country_id', $data['id'])->where('status', 1)->get();
       if ($getStateData) {
           return response()->json($getStateData);
       }
    }

    public function getCityByState(Request $request)
    {
        $data = $request->all();
        $getCityData = City::where('state_id', $data['id'])->where('status', 1)->get();
        if ($getCityData) {
            return response()->json($getCityData);
        }
    }

    public function addHotel(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'country' => 'required|numeric',
            'state' => 'required|numeric',
            'city' => 'required|numeric',
            'address' => 'required',
            'description' => 'required',
            ]
        );
        if (!$validator->passes()) {
            return response()->json($validator->errors()->all());
        }

        $data = $request->all();
        $insertHotel['name'] = $data['name'];
        $insertHotel['slug'] = preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($data['name']));
        $insertHotel['address'] = $data['address'];
        $insertHotel['country_id'] = (int)$data['country'];
        $insertHotel['state_id'] = (int)$data['state'];
        $insertHotel['city_ids'] = (int)$data['city'];
        $insertHotel['description'] = $data['description'];
        $insertHotel['website_url'] = $data['website_url'];
        $insertHotel['featured'] = isset($data['featured'])? 1 : 0;
        $insertHotel['status'] = isset($data['status'])? 1 : 0;
        
        try {
            $user = Hotel::updateOrCreate(['email' => $data['email']], $insertHotel);
            if ($user) {

                return response()->json(['status'=>1, 'message'=> 'Hotels Details Added Successfully']);
            }
    
            return response()->json(['status'=>0, 'message'=> 'Fail']);
        }catch (\Exception $exception) {

            return response()->json(['status'=>0, 'message'=>$exception->getMessage()]);
        }
    }

    public function viewHotel(Request $request)
    {
        $data = $request->all();
        $getHotel = Hotel::where('id', $data['id'])->get();
        if ($getHotel) {
            return response()->json($getHotel);
        }
    }

    public function rooms()
    {
        $hotels = Hotel::where('status', 1)->get();
        $amenities = Amenity::get();
        return view('admin/roomdetails', ['tabname'=>'room', 'hotels'=>$hotels, 'amenities'=>$amenities]);
    }

    public function getRoom()
    {
        $amenity_name = '';
        $rooms = Room::with('hotels', 'amenities')->get();
        
        if ($rooms) {
            return Datatables::of($rooms)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $name = $row->type;
                    $btn = "<a href='' type='button' class='btn btn-success' data-toggle='modal'
                    onclick='editRoom($id);'><i class='fas fa-edit'></i></a>";
                    return $btn;
            })
            ->addColumn('amenities', function ($row) {
                $amenity_name='';
                foreach ($row->amenities as $key => $amenity) {
                    if ($key > 0)
                        $amenity_name = $amenity_name.',';
                    $amenity_name = $amenity_name.$amenity->name;
                }
                return $amenity_name;
            })
            ->editColumn('price', function ($row) {
                $hotels = Hotel::with('country')->where('id', $row->hotel_id)->first();
                return number_format($row->price);
            })
            ->editColumn('per_adult_price', function ($row) {
                return number_format($row->per_adult_price);
            })
            ->editColumn('per_child_price', function ($row) {
                return number_format($row->per_adult_price);
            })
            ->rawColumns(['action', 'amenities', 'price'])
            ->make(true);
        }
    }

    public function addRoom(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'hotel' => 'nullable',
            'room_type' => 'required|max:50',
            'room_price' => 'required|numeric',
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            ],
            [
                'hotel.required' => 'Select Hotel',
                'room_type.max' => 'Room type must be less than 50 characters',
            ]
        );
        if (!$validator->passes()) {
            return response()->json($validator->errors()->all());
        }

        $data = $request->all();
        $room = new Room();

        try {
            if (!isset($data['id'])) {
                $room['hotel_id'] = (int)$data['hotel'];
                $room['type'] = $data['room_type'];
                $room['price'] = $data['room_price'];
                $room['per_adult_price'] = $data['adult_price'];
                $room['per_child_price'] = $data['child_price'];
                $room['status'] = isset($data['status'])? 1 : 0;

                $upsert = Room::create($room);
                $room_id = $upsert->id;
                $message = 'Room Data Created Successfully';
            }else {
                $room = [
                    'type' => $data['room_type'],
                    'price' => $data['room_price'],
                    'per_adult_price' => $data['adult_price'],
                    'per_child_price' => $data['child_price'],
                    'status' => isset($data['status'])? 1 : 0,
                ];

                $upsert = Room::where('id', $data['id'])->update($room);
                $room_id = $data['id'];
                $roomAmenity = RoomAmenity::where('room_id', $room_id)->delete();
                $message = 'Room Data Updated Successfully';
            }
            if ($upsert) {
                if (isset($data['amenities'])) {
                    for ($i=0; $i<sizeof($data['amenities']); $i++) {
                        $roomAmenity = new RoomAmenity();
                        $roomAmenity['room_id'] = $room_id;
                        $roomAmenity['amenity_id'] = $data['amenities'][$i];
                        $roomAmenity->save();
                    }
                }
                $response = ['status'=>1, 'message'=>$message];
            }else {
                $response = ['status'=>0, 'message'=>'Fail'];
            }
        }catch (\Exception $exception) {
            $response = ['status'=>0,'message'=>$exception->getMessage()];
        }
        
        return response()->json($response);
    }

    public function viewRoom(Request $request)
    {
        $data = $request->all();
        $getRoom = Room::find($data['id']);
        if ($getRoom) {
            $response = array('data'=>$getRoom, 'hotel'=>$getRoom->hotels->id, 'amenities'=>$getRoom->amenities);
            return response()->json($response);
        }
    }

    public function addAmenity(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'amenity' => 'required|max:50',
            ],
            [
                'amenity.required' => 'Amenity field is required',
                'amenity.max' => 'Amenity name should be less than 50 characters',
            ]
        );
        if (!$validator->passes()) {
            return response()->json($validator->errors()->all());
        }

        $data = $request->all();
        $response = [];

        try {
            $check = Amenity::where('name', $data['amenity'])->first();
            if ($check) {
                $response = ['status'=>0, 'message'=>'Amenity Already Exist'];
            }

            $insert_amenity = new Amenity();
            $insert_amenity['name'] = $data['amenity'];
            if ($insert_amenity->save()) {
                $response = ['status'=>1, 'message'=>'Amenity Added Successfully'];
            }
        }catch (\Exception $exception) {
            $response = ['status'=>2, 'message'=>$exception->getMessage()];
        }

        return response()->json($response);
    }

    public function deleteAmenity(Request $request)
    {
        $data = $request->all();
        $delete_amenity = Amenity::where('id', $data['id'])->delete();
        if ($delete_amenity) {
            return array('status'=>'1', 'message'=>'Amenity Deleted Successfully');
        }else {
            return array('status'=>'2', 'message'=>'Failed');
        }
    }

    public function getAmenity(Request $request)
    {
        $response = [];
        $amenities = Amenity::get();
        if ($amenities) {
            return Datatables::of($amenities)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $name = $row->name;
                    $btn = "<input type='hidden' name='hidden$id' value='$name'>
                    <a href='' type='button' class='btn btn-danger' data-toggle='modal'
                    onclick='deleteAmenity($id)'><i class='fas fa-trash-alt'></i>
                    </a>";
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function getbookings(Request $request)
    {
        $getBookings = Booking::with(['hotel', 'user', 'bookingDetail'])->orderBy('id', 'DESC')->get();
        if ($getBookings) {
          return Datatables::of($getBookings)
            ->addIndexColumn()
            ->addColumn('check_in', function ($row) {
                $check_in='';
                for ($i=0; $i<sizeof($row->bookingDetail); $i++) {
                    $check_in = $row->bookingDetail[$i]->check_in;
                }
                return $check_in;
            })
            ->addColumn('check_out', function ($row) {
                $check_out='';
                for ($i=0; $i<sizeof($row->bookingDetail); $i++) {
                    $check_out = $row->bookingDetail[$i]->check_out;
                }
                return $check_out;
            })
            ->addColumn('action', function ($row) {
                $id = $row->id;
                    $btn = "<a href='' type='button' class='btn btn-info' data-toggle='modal'
                    onclick='bookingDetails($id);'><i class='fas fa-eye'></i></a>";
                    return $btn;
            })
            ->rawColumns(['check_in', 'check_out', 'action'])
            ->make(true);
        }
    }

    public function bookingDetail(Request $request)
    {
        $data = $request->all();
        $getDetails = BookingDetail::join('bookings', 'booking_details.booking_id', 'bookings.id')
        ->join('users', 'bookings.user_id', 'users.id')
        ->join('rooms', 'rooms.id', 'booking_details.room_id')
        ->select(
            'response',
            'name',
            'check_in',
            'check_out',
            DB::raw('GROUP_CONCAT(rooms.type) as rooms'),
            'adult',
            'total'
        )
        ->where('bookings.id', $data['id'])
        ->groupBy('bookings.id', 'response', 'name', 'check_in', 'check_out', 'adult', 'total')
        ->get();
        if ($getDetails) {
            return response()->json(['status'=>1, 'data'=>$getDetails]);
        }
    }
}



