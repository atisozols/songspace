@extends('layouts.app')

@section('content')
    <div class="text-center p-lg-3 d-flex justify-content-center">
        <div class="list-group text-center">
            <audio class="mb-5" controls src="/storage/audio_files/{{$data->audio}}"></audio>
            <h1 class="font-weight-light mb-3">{{$data->title}}</h1>
            <h5 class=" font-weight-light">By {{$data->username}} </h5>
            <h6 class="mb-3 font-weight-light">on {{$data->date}}</h6>

            <pre class="text-monospace font-weight-lighter">{{$data->lyrics}}</pre>
        </div>
    </div>

    <div class="d-flex flex-row-reverse mr-lg-2">
        @if((\Illuminate\Support\Facades\Auth::check() and $userid==$data->uid) or (Gate::allows('admin')))
        {!! Form::open(['action' => ['SongController@destroy',$data->sid], 'method'=>'POST']) !!}
        {!! Form::hidden('_method', 'DELETE') !!}
        {!! Form::submit('Delete',["class"=>"btn text-dark font-weight-lighter m-lg-2"]) !!}
        {!! Form::close() !!}
        @endif
        @if(\Illuminate\Support\Facades\Auth::check() and $userid==$data->uid)
                <a href="/song/{{$data->sid}}/edit" class="btn text-dark font-weight-lighter m-lg-2">Edit</a>
            @endif
    </div>



@endsection
