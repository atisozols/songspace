@extends('layouts.app')

@section('content')
    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>
    <h1 class="font-weight-light d-flex justify-content-left ml-5">{{$library->title}}</h1>
    <div class="d-flex">
        @if(Illuminate\Support\Facades\Auth::check() and $library->user_id==$uid)
            <a class="text-dark ml-5" href="{{ url('/song/create') }}">
                Add New Song
            </a>
        @endif
    </div>
    <div class="list-group ml-lg-5 mt-lg-3">
        @if(count($songs)>0)
            @foreach($songs as $song)
                <div class="well">
                    <a href="/song/{{$song->id}}">{{$song->title}}</a>
                </div>
            @endforeach
        @else
            <p>No Songs Found</p>
        @endif
    </div>
    <div class="d-flex flex-row-reverse mr-lg-2">
        @if((\Illuminate\Support\Facades\Auth::check() and $uid==$library->user_id) or (Gate::allows('admin')))
            {!! Form::open(['action' => ['LibraryController@destroy',$library->id], 'method'=>'POST']) !!}
            {!! Form::hidden('_method', 'DELETE') !!}
            {!! Form::submit('Delete',["class"=>"btn text-dark font-weight-lighter m-lg-2"]) !!}
            {!! Form::close() !!}
        @endif
    </div>
@endsection
