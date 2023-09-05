<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        if (Auth::check()) {
            $userName = Auth::user()->name;
            $userRole = Auth::user()->role_as;
            $userImg = Auth::user()->img;

            Session::put('USERNAME', $userName);
            Session::put('USERROLE', $userRole);
            Session::put('USERIMG', $userImg);
        }
        return view('front.dashboard');
    }
}
