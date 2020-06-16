<?php

namespace App\Http\Controllers;

use App\Library;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function show($id){
        if (Auth::check())
        {
            $uid = Auth::user()->getId();
        }
        $library=Library::find($id);
        $songs=Song::where('library_id','=',$id)->get();
        return view('library_show')->with('library',$library)->with('songs',$songs)->with('uid',$uid);
    }

    public function create(){

        return view('library_create');
    }

    public function store(Request $request){

        $this->validate($request, ['title' => 'required']);

        if (Auth::check())
        {
            $id = Auth::user()->getId();
        }
        $library = new Library;
        $library->title = $request->input('title');
        $library->user_id = $id;
        $library->save();

        return redirect('/home')->with('success','Library Created');
    }

}
