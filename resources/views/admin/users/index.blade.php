@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold bg-light">Users</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Actions</th>
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
                                <a href="{{route('admin.users.edit',$user->id)}}"><button type="button" class="btn btn-secondary float-left">Edit</button></a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger float-left">Delete</button>
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
