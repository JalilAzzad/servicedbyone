@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Services</h2>
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
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
            <tr>
                <th scope="row">{{$service->id}}</th>
                <td>{{$service->name}}</td>
                <td>{{$service->slug}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('services.show', $service->id)}}">Show</a>
                    <a class="btn btn-secondary" href="{{route('services.edit', $service->id)}}">Edit</a>
                    @include('admin.layouts.deleteform', ['action' => route('services.destroy', $service->id), 'id' => $service->id])
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $services->links() }}
    </div>
@endsection
