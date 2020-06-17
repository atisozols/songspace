<?php

namespace App\Http\Controllers;

use App\Library;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id){
        $libraries = Library::where('user_id','=',$id)->get();
        $user = User::find($id);
        return view('user_show')->with('user',$user)->with('libraries',$libraries);
    }
}
