@extends('layouts.app')

@section('content')

    <h1 class="font-weight-light d-flex justify-content-center">All Songs</h1>
    <div class="list-group align-items-center">
        @foreach($data as $song)
            <div class="d-inline-flex">
                <a href="/song/{{$song->sid}}">{{$song->title}}</a><p>&nbsp - &nbsp</p><a href="/user/{{$song -> uid}}">{{$song->username}}</a>
            </div>
        @endforeach
    </div>

@endsection
