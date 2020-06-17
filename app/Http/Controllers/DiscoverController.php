<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DiscoverController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->join('libraries','libraries.user_id','=','users.id')
            ->join('songs','songs.library_id','=','libraries.id')
            ->select('users.username','users.id as uid','songs.title','songs.id as sid')
            ->get();
        //dd($data);
        return view('discover')->with('data',$data);
    }
}
