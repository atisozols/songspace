@extends('layouts.app')

@section('content')

    <h1 class="font-weight-light d-flex justify-content-center">{{__('text.all')}}</h1>
    <div class="list-group align-items-center">
        @foreach($data as $song)
            <div class="d-inline-flex">
                <h4 class="d-inline-flex"><a href="/song/{{$song->sid}}" class="font-weight-light text-dark">{{$song->title}}</a><p>&nbsp - &nbsp</p><a href="/user/{{$song -> uid}}" class="font-weight-light text-dark">{{$song->username}}</a></h4>
            </div>
        @endforeach
    </div>

@endsection
