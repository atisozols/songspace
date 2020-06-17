<?php

namespace App\Http\Controllers\Admin;

use App\Library;
use App\Role;
use App\Http\Controllers\Controller;
use App\Song;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('admin'))
            return redirect('/');
        $users = User::all();
        return view('admin.users.index')->with('users',$users);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('admin'))
            return redirect('/');
        $roles = Role::all();
        return view('admin.users.edit')->with('user',$user)->with('roles',$roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Gate::denies('admin'))
            return redirect('/');
        $user->roles()->sync($request->roles);
        $user->username=$request->username;
        $user->email=$request->email;
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('admin'))
            return redirect('/');


        $libraries = Library::where('user_id','=',$user->id)->get();
        $librariesid = Library::where('user_id','=',$user->id)->pluck('id')->toArray();

        foreach ($librariesid as $lid){
            $songs = Song::where($lid,'=','library_id');
            foreach ($songs as $song){
                $song->delete();
                Storage::delete('public/audio_files/'.$song->audio);
            }
        }
        foreach ($libraries as $library) {
            $library->delete();
        }
        $user->roles()->detach();


        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
