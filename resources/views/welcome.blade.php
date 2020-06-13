@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="w-25 ml-lg-5 mt-2">
            @include('inc.messages')
        </div>
        <h1 class="font-weight-light d-flex justify-content-left ml-5">My Songspace</h1>
        <div class="d-flex">
        @if(count($libraries)>0)
                <a class="text-dark ml-5" href="{{ url('/song/create') }}">
                    Add New Song
                </a>
            @endif
        <a class="text-dark ml-5" href="{{ url('/library/create') }}">
                    Create New Library
        </a>
        </div>
        <div class="list-group ml-lg-5 mt-lg-3">
            <h3 class="font-weight-light">My Libraries</h3>
            @if(count($libraries)>0)
                @foreach($libraries as $library)
                    <div class="well">
                        <a href="/library/{{$library->id}}">{{$library->title}}</a>
                    </div>
                @endforeach
            @else
                <p>No Libraries Found</p>
            @endif
        </div>
    @else
        <h1 class="font-weight-light d-flex justify-content-center">Welcome to Songspace</h1>
    @endif
@endsection
