@extends('layouts.app')

@section('content')

    <h2 class="pl-lg-5 pt-lg-3 ">Edit Song</h2>

    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>


    <div class="well pl-lg-5">

        {!! Form::open(['action' => ['SongController@update',$song->id], 'files' => true, 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::text('title', $song->title, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lyrics', 'Lyrics:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::textarea('lyrics', $song->lyrics, ['class' => 'form-control', 'rows' => 15]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('library', 'Add to library:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::select('library', $libraries, $song->library_id, ['placeholder' => 'Pick a library...']) !!}
            </div>
        </div>
        {!! Form::hidden('_method','PUT') !!}
        {!! Form::submit( 'Submit', ['class' => ['btn-dark', 'ml-3']]) !!}
        {!! Form::close() !!}

    </div>


@endsection
