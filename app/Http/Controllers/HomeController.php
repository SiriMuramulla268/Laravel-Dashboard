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
        $getUserCount = User::count();
        return view('admin/index')->with(['usercount'=>$getUserCount,'tabname'=>'dashboard']);
    }
}
