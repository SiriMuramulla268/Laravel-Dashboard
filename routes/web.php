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

// Auth::routes();


Route::post('/logins',[LoginController::class, 'authenticate'])->name('logins');

Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin/dashboard');

Route::post('/adduser',[UserController::class, 'addUser'])->name('add-user');

Route::get('/admin/userlist',[UserController::class, 'userlist'])->name('user-list');

Route::get('admin/logout',[LoginController::class, 'logOut']);

Route::get('/admin', function () {
    return view('adminlogin');
});

Route::get('admin/userform', function () {
    return view('userform',['tabname'=>'userform']);
})->middleware('auth');

Route::get('admin/logoutpage', function () {
    return view('logoutpage',['tabname'=>'logout']);
})->middleware('auth');
