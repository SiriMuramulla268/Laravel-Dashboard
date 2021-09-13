<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin/adminlogin');
    })->name('admin-login');
    Route::post('/logins',[LoginController::class, 'authenticate'])->name('logins');
    Route::get('/logout',[LoginController::class, 'logOut']);
    Route::get('/userform', function () {
        return view('admin/userform',['tabname'=>'userform']);
    })->middleware('auth');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin/dashboard');

    //user
    Route::post('/adduser',[AdminController::class, 'addUser'])->name('add-user');
    Route::get('/userlist',[AdminController::class, 'userList'])->name('user-list');

    //hotel
    Route::get('/hotellist',[AdminController::class, 'hotelList'])->name('hotels');
    Route::get('/gethotel',[AdminController::class, 'getHotel'])->name('get-hotel');
    Route::post('/addhotel',[AdminController::class, 'addHotel'])->name('add-hotel');
    Route::get('/viewhotel', [AdminController::class, 'viewHotel'])->name('view-hotel');
    Route::get('statebycountry', [AdminController::class, 'getStateByCountry'])->name('state-by-country');
    Route::get('citybystate', [AdminController::class, 'getCityByState'])->name('city-by-state');

    //room
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('/getroom', [AdminController::class, 'getRoom'])->name('get-room');
    Route::post('/addroom', [AdminController::class, 'addRoom'])->name('add-room');
    Route::get('/viewroom', [AdminController::class, 'viewRoom'])->name('view-room');

    //amenity
    Route::get('/amenities', function () {
        return view('admin/amenities',['tabname'=>'amenity']);
    });
    Route::get('/getamenity',[AdminController::class, 'getAmenity'])->name('get-amenity');
    Route::post('/addamenity',[AdminController::class, 'addAmenity'])->name('add-amenity');
    Route::get('/deleteamenity',[AdminController::class, 'deleteAmenity'])->name('delete-amenity');

    //bookinglist
    Route::get('/bookinglist', function () {
        return view('admin/bookinglist',['tabname'=>'bookings']);
    });
    Route::get('getbookings',[AdminController::class, 'getBookings'])->name('get-bookings');
    Route::get('bookingdetails',[AdminController::class, 'bookingDetail'])->name('booking-details');
}); 

Route::get('/', [HotelController::class, 'getHotelIndex']);
Route::get('contacts', function () {
    return view('hotel/contact');
});
Route::get('/hotels', [HotelController::class, 'getHotels'])->name('hotel-list');
Route::get('hotel/{slug}/{date?}', [HotelController::class, 'getHotelDetails']);
Route::get('getprice',[HotelController::class, 'getRoomPrice'])->name('get-price');
Route::get('about', function () {
    return view('hotel/about');
});
Route::post('add-to-cart', [HotelController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [HotelController::class, 'getCart'])->name('cart');
Route::get('checkout/{session}', [HotelController::class, 'getCheckout'])->name('checkout');
Route::post('/exist_user', [HotelController::class, 'getExistUser'])->name('exist-user');
Route::get('/logout-user', [HotelController::class, 'logoutUser'])->name('logout-user');
Route::post('book', [HotelController::class, 'booking'])->name('booking');
Route::get('mail', function () {
    return view('emails/mail');
});
Route::get('history', [HotelController::class, 'bookingHistory'])->name('history');
