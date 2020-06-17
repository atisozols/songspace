@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Users</div>
            <div class="card-body">
                @foreach($users as $user)
                    <div class="list-group-item">
                        {{$user->username}} - {{$user->email}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
