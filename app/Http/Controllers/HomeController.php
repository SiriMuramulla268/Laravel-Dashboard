<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $getMembersCount = Members::get()->count();
        $getUserCount = User::get()->count();
        return view('index')->with(['memcount'=>$getMembersCount,'usercount'=>$getUserCount,'tabname'=>'dashboard']);
    }

   
}
