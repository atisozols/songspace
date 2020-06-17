@extends('layouts.app')

@section('content')
    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>
    <h1 class="font-weight-light d-flex justify-content-left ml-5">{{ $user->username }}</h1>

    <div class="list-group ml-lg-5 mt-lg-3">
        <h3 class="font-weight-light">Libraries</h3>
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
@endsection
