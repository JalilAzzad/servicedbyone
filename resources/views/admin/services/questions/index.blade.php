@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Service Questions</h2>
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
                <th scope="col">Question</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($questions as $question)
            <tr>
                <th scope="row">{{$question->id}}</th>
                <td>{{$question->name}}</td>
                <td>{{$question->question}}</td>
                <td>{{$question->type}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('service-questions.show', $question->id)}}">Show</a>
                    @unless($question->is_locked)
                    <a class="btn btn-secondary" href="{{route('service-questions.edit', $question->id)}}">Edit</a>
                    @include('admin.layouts.deleteform', ['action' => route('service-questions.destroy', $question->id), 'id' => $question->id])
                    @endunless
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $questions->links() }}
    </div>
@endsection
