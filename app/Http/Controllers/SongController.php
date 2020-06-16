<?php

namespace App\Http\Controllers;

use App\Library;
use App\Song;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function show($id){
        $song = DB::table('users')
            ->join('libraries','libraries.user_id','=','users.id')
            ->join('songs','songs.library_id','=','libraries.id')
            ->select('users.username','users.id as uid','songs.title as title',
                'songs.id as sid','songs.star_count','audio','lyrics','songs.created_at as date')
            ->where('songs.id','=',$id)
            ->first();
        //dd($song);
        if (Auth::check())
        {
            $id = Auth::user()->getId();
        }
        return view('song_show')->with('data',$song)->with('userid',$id);
    }

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

    public function edit($id)
    {
        $data = DB::table('users')
            ->join('libraries','libraries.user_id','=','users.id')
            ->join('songs','songs.library_id','=','libraries.id')
            ->select('users.username','users.id as uid','songs.title as title',
                'songs.id as sid','songs.star_count','audio','lyrics','songs.created_at as date')
            ->where('songs.id','=',$id)
            ->first();
        $song = Song::find($id);
        if (Auth::check())
        {
            $userId = Auth::user()->getId();
        }
        if($userId != $data->uid)
            return redirect('/');
        //dd($song);
        $libraries=Library::where('user_id','=',$userId)->get();
        $libraryOptions = array() + $libraries->pluck('title', 'id')->toArray();

        return view('song_edit')->with('song', $song)->with('libraries',$libraryOptions);
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        $this->validate($request, [
            'title' => 'required',
            'lyrics' => 'required',
            'library'=> 'required',
        ]);


        $library_id=$request->input('library');

        $song = Song::find($id);
        $song->title = $request->input('title');
        $song->library_id = $library_id;
        $song->lyrics = $request -> input('lyrics');
        $song->save();

        return redirect('/library/'.$library_id)->with('success','Song Updated');
    }

    public function destroy($id){
        $song = Song::find($id);
        $data = DB::table('users')
            ->join('libraries','libraries.user_id','=','users.id')
            ->join('songs','songs.library_id','=','libraries.id')
            ->select('users.username','users.id as uid','songs.title as title',
                'songs.id as sid','songs.star_count','audio','lyrics','songs.created_at as date')
            ->where('songs.id','=',$id)
            ->first();

        if (Auth::check())
        {
            $userId = Auth::user()->getId();
        }
        if($userId != $data->uid)
            return redirect('/');

        Storage::delete('public/audio_files/'.$song->audio);
        $song->delete();
        return redirect('/home')->with('success', 'Song Deleted');
    }
}
