@extends('layouts.app')

@section('content')
    <div class="text-center p-lg-3 d-flex justify-content-center">
        <div class="list-group text-center">
            <audio class="mb-5" controls src="/storage/audio_files/{{$data->audio}}"></audio>
            <h1 class="font-weight-light mb-3">{{$data->title}}</h1>
            <h5 class=" font-weight-light">By {{$data->username}} </h5>
            <h6 class="mb-1 font-weight-light">on {{$data->date}}</h6>
            <div class="d-flex justify-content-center align-items-center mb-3">
                <button class="card mr-3" onclick="actOnSong(like);" data-chirp-id="{{ $data->sid }}">Star</button>
                <span id="likes-count-{{ $data->sid }}">{{ $data->star_count }}</span>
            </div>
            <p class="text-monospace font-weight-lighter">{{$data->lyrics}}</p>
        </div>
    </div>
    @if(auth::check() and $userid==$data->uid)
    <div class="d-flex flex-row-reverse mr-lg-2">
        {!! Form::open(['action' => ['SongController@destroy',$data->sid], 'method'=>'POST']) !!}
        {!! Form::hidden('_method', 'DELETE') !!}
        {!! Form::submit('Delete',["class"=>"btn text-dark font-weight-lighter m-lg-2"]) !!}
        {!! Form::close() !!}
        <a href="/song/{{$data->sid}}/edit" class="btn text-dark font-weight-lighter m-lg-2">Edit</a>
    </div>
    @endif


@endsection
