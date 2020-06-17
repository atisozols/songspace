<?php

namespace App\Http\Controllers;

use App\Library;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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

    public function destroy($id){
        $library = Library::find($id);

        if (Auth::check())
        {
            $userId = Auth::user()->getId();
        }
        if(($userId != $library->user_id) and (Gate::denies('admin')))
            return redirect('/');

        $songs = Song::where('library_id','=',$id)->get();

        foreach ($songs as $song){
            Storage::delete('public/audio_files/'.$song->audio);
            $song->delete();
        }

        $library->delete();
        return redirect('/home')->with('success', 'Library Deleted');
    }

}
