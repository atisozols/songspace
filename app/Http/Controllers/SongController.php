<?php

namespace App\Http\Controllers;

use App\Library;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    public function create(){
        if (Auth::check())
        {
            $id = Auth::user()->getId();
        }
        $libraries=Library::where('user_id','=',$id)->get();
        $libraryOptions = array() + $libraries->pluck('title', 'id')->toArray();
        //dd($libraryOptions);
        return view('song_create')->with('libraries',$libraryOptions);
    }

    public function store(Request $request){
        //dd($request);
        $this->validate($request, [
            'audio' => 'required',
            'title' => 'required',
            'lyrics' => 'required',
            'library'=> 'required',
        ]);

        // Get filename with the extension
        $filenameWithExt = $request->file('audio')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('audio')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = $request->file('audio')->storeAs('public/audio_files', $fileNameToStore);

        $library_id=$request->input('library');

        $song = new Song;
        $song->title = $request->input('title');
        $song->library_id = $library_id;
        $song->lyrics = $request -> input('lyrics');
        $song->audio = $fileNameToStore;
        $song->star_count=0;
        $song->save();

        return redirect('/library/'.$library_id)->with('success','Song Added');
    }
}
