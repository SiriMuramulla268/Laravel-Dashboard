<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

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


