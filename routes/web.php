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
}); 

Route::get('/', [HotelController::class, 'getHotelIndex']);
Route::post('/gethotels',[HotelController::class, 'getHotelByCity'])->name('hotel.index');

Route::get('contacts', function () {
    return view('hotel/contact');
});

Route::get('/hotels', [HotelController::class, 'getAllHotel']);

Route::get('hoteldetail/{id}', [HotelController::class, 'getHotelDetail']);

Route::get('about', function () {
    return view('hotel/about');
});

Route::get('cart1', function () {
    return view('hotel/cart1');
});

Route::get('cart2', function () {
    return view('hotel/cart2');
});

Route::get('cart3', function () {
    return view('hotel/cart3');
});