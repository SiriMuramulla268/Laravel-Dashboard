<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin-dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin-dashboard');


Route::get('/admin', function () {
    return view('adminlogin');
});

Route::get('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logOut']);

Route::get('/userform', function () {
    return view('userform');
});
Route::get('/logoutpage', function () {
    return view('logoutpage');
});

Route::post('/adduser',[App\Http\Controllers\UserController::class, 'addUser'])->name('add-user');

Route::get('/userlist',[App\Http\Controllers\UserController::class, 'userlist'])->name('user-list');


