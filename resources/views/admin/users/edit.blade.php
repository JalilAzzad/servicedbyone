@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">User#{{$user->id}}</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control disabled" disabled id="email" placeholder="name@example.com" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="+1xxxxxxxxxx" value="{{$user->phone}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name="roles[]" multiple class="form-control" id="roles">
                    @foreach($roles as $role)
                        <option @if($user->hasRole($role->name))selected @endif>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
             <div class="form-group">
                <label for="commission">Commission</label>
                <input name="commission" type="number" class="form-control" id="commission" placeholder="commission" value="{{$user->commission}}">
            </div>
            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/users/'.$user->id :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
