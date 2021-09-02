<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;

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
    });
    Route::post('/logins',[LoginController::class, 'authenticate'])->name('logins');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin/dashboard');
    Route::post('/adduser',[UserController::class, 'addUser'])->name('add-user');
    Route::get('/userlist',[UserController::class, 'userlist'])->name('user-list');
    Route::get('/logout',[LoginController::class, 'logOut']);
    Route::get('/userform', function () {
        return view('admin/userform',['tabname'=>'userform']);
    })->middleware('auth');
    Route::get('/hotellist',[HotelController::class, 'hotelList'])->name('hotels');
    Route::post('/addhotel',[HotelController::class, 'addHotel'])->name('add-hotel');
    Route::get('/viewhotel', [HotelController::class, 'viewHotel'])->name('view-hotel');
    Route::get('/rooms', [HotelController::class, 'rooms'])->name('rooms');
    Route::post('/addroom',[HotelController::class, 'addRoom'])->name('add-room');
    Route::get('/viewroom', [HotelController::class, 'viewRoom'])->name('view-room');

    Route::get('/amenities', function () {
        return view('admin/amenities',['tabname'=>'amenity']);
    });
    Route::get('/getamenity',[HotelController::class, 'getAmenity'])->name('get-amenity');
    Route::post('/addamenity',[HotelController::class, 'addAmenity'])->name('add-amenity');
    Route::get('/deleteamenity',[HotelController::class, 'deleteAmenity'])->name('delete-amenity');
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

Route::post('book', [HotelController::class, 'booking'])->name('booking');

Route::get('mail', function () {
    return view('emails/mail');
});

Route::get('history', [HotelController::class, 'bookingHistory'])->name('history');

Route::get('statebycountry', [HotelController::class, 'getStateByCountry'])->name('state-by-country');

Route::get('citybystate', [HotelController::class, 'getCityByState'])->name('city-by-state');
