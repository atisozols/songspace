@extends('layouts.app')

@section('content')

    <h2 class="pl-lg-5 pt-lg-3 ">{{ __('text.adds') }}</h2>

    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>


    <div class="well pl-lg-5">

        {!! Form::open(['action' => 'SongController@store', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('audio', __('text.audio'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::file('audio', ['class' => ['form-control', 'pt-3', 'pb-5'], 'accept' => '.mp3, .wav, .flac']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('title', __('text.title'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::text('title', $value = null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('lyrics', __('text.ly'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::textarea('lyrics', $value = null, ['class' => 'form-control', 'rows' => 15]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('library', __('text.addtolib'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::select('library', $libraries, null, ['placeholder' => __('text.picklib')]) !!}
            </div>
        </div>
        {!! Form::submit( __('text.submit'), ['class' => ['btn-dark', 'ml-3']]) !!}
        {!! Form::close() !!}

    </div>


@endsection
