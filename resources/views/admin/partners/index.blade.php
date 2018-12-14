@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Partners</h2>
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
                <th scope="col">Website Url</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($partners as $partner)
            <tr>
                <th scope="row">{{$partner->id}}</th>
                <td>{{$partner->name}}</td>
                <td>{{$partner->email}}</td>
                <td>{{$partner->phone}}</td>
                <td>{{$partner->url}}</td>
                <td>{{$partner->slug}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('partners.show', $partner->id)}}">Show</a>
                    <a class="btn btn-secondary" href="{{route('partners.edit', $partner->id)}}">Edit</a>
                    @include('admin.layouts.deleteform', ['action' => route('partners.destroy', $partner->id), 'id' => $partner->id])
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $partners->links() }}
    </div>
@endsection
