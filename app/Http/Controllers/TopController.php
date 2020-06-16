<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TopController extends Controller
{
    public function index()
    {
        $data = DB::table('users')
            ->join('libraries','libraries.user_id','=','users.id')
            ->join('songs','songs.library_id','=','libraries.id')
            ->select('users.username','users.id as uid','songs.title','songs.id as sid','songs.star_count')
            ->orderByDesc('songs.star_count')
            ->get();
        //dd($data);
        return view('top')->with('data',$data);
    }
}
