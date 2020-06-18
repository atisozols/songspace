@extends('layouts.app')

@section('content')

    <h2 class="pl-lg-5 pt-lg-3">{{ __('text.createlib') }}</h2>

    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>


    <div class="well pl-lg-5">

        {!! Form::open(['action' => 'LibraryController@store']) !!}
        <div class="form-group">
            {!! Form::label('title', __('text.title'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-4">
                {!! Form::text('title', $value = null, ['class' => 'form-control']) !!}
            </div>
        </div>
        {!! Form::submit( __('text.submit'), ['class' => ['btn-dark', 'ml-3']]) !!}
        {!! Form::close() !!}

    </div>


@endsection
