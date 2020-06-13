@extends('layouts.app')

@section('content')
    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>
    <h1 class="font-weight-light d-flex justify-content-left ml-5">{{$library->title}}</h1>
    <div class="d-flex">
        <a class="text-dark ml-5" href="{{ url('/song/create') }}">
            Add New Song
        </a>
    </div>
    <div class="list-group ml-lg-5 mt-lg-3">
        @if(count($songs)>0)
            @foreach($songs as $song)
                <div class="well">
                    <a href="/song/{{$song->id}}">{{$song->title}}</a>
                </div>
            @endforeach
        @else
            <p>No Libraries Found</p>
        @endif
    </div>
@endsection
