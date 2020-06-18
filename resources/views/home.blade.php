@extends('layouts.app')

@section('content')
    <div class="w-25 ml-lg-5 mt-2">
        @include('inc.messages')
    </div>
    <h1 class="font-weight-light d-flex justify-content-left ml-5">{{ __('text.myss') }}</h1>
    <div class="d-flex">
        @if(count($libraries)>0)
            <a class="text-dark ml-5" href="{{ url('/song/create') }}">
                {{ __('text.adds') }}
            </a>
        @endif
        <a class="text-dark ml-5" href="{{ url('/library/create') }}">
            {{ __('text.createlib') }}
        </a>
    </div>
    <div class="list-group ml-lg-5 mt-lg-3">
        <h3 class="font-weight-light">{{ __('text.mylib') }}</h3>
        @if(count($libraries)>0)
            @foreach($libraries as $library)
                <div class="well">
                    <a href="/library/{{$library->id}}">{{$library->title}}</a>
                </div>
            @endforeach
        @else
            <p>{{ __('text.nolib') }}</p>
        @endif
    </div>
@endsection
