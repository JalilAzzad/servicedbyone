@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>SEO</h2>
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
                <th scope="col">URL</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($seos as $seo)
            <tr>
                <th scope="row">{{$seo->id}}</th>
                <td>{{$seo->url}}</td>
                <td>{{$seo->slug}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('seos.show', $seo->id)}}">Show</a>
                    <a class="btn btn-secondary" href="{{route('seos.edit', $seo->id)}}">Edit</a>
                   @include('admin.layouts.deleteform', ['action' => route('seos.destroy', $seo->id), 'id' => $seo->id])
                    
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $seos->links() }}
    </div>
@endsection
