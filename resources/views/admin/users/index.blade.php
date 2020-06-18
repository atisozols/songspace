@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold bg-light">{{ __('text.users') }}</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('text.username') }}</th>
                        <th scope="col">{{ __('text.email') }}</th>
                        <th scope="col">{{ __('text.roles') }}</th>
                        <th scope="col">{{ __('text.act') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{implode(', ',$user->roles()->get()->pluck('name')->toArray())}}</td>
                            <td>
                                <a href="{{route('admin.users.edit',$user->id)}}"><button type="button" class="btn btn-secondary float-left">{{ __('text.edit') }}</button></a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger float-left">{{ __('text.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
