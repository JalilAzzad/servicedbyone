@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Users</h2>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Roles</th>
                <th scope="col">Balance</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{implode(', ', $user->roles->pluck('name')->toArray())}}</td>
                <td>${{$user->balance}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('users.show', $user->id)}}">Show</a>
                    <a class="btn btn-secondary" href="{{route('users.edit', $user->id)}}">Edit</a>
                    @if(!$user->hasRole(\App\Models\User::ADMIN))
                        @include('admin.layouts.deleteform', ['action' => route('users.destroy', $user->id), 'id' => $user->id])
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
