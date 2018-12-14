@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Create User</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="+1xxxxxxxxxx" value="{{old('phone')}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name="roles[]" multiple class="form-control" id="roles">
                    @foreach($roles as $role)
                        <option>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/users/' :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
