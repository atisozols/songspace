<?php

namespace App\Http\Controllers;

use App\Library;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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
            $id = Auth::user()->getId();
            $libraries=Library::where('user_id','=',$id)->get();
            return view('home')->with('libraries',$libraries);
        }
    }

    public function welcome(){
        return view('welcome');
    }
}
