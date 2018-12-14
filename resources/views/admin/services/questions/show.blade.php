@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">{{__('Service Question') }}#{{$question->id}}</h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$question->id}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Name') }}</th>
                <td>{{$question->name}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Question') }}</th>
                <td>{{$question->question}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Type') }}</th>
                <td>{{$question->type}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Actions') }}</th>
                <td>
                    @unless($question->is_locked)
                    <a class="btn btn-secondary" href="{{route('service-questions.edit', $question->id)}}">Edit</a>
                    @include('admin.layouts.deleteform', ['action' => route('service-questions.destroy', $question->id), 'id' => $question->id])
                    @endunless
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="{{url()->previous() == url()->current() ? '/admin/service-questions' :url()->previous()}}">Back</a>
        <br>
        @if(count($question->choices))
            <div class="mt-4">
                <h2>{{__('Choices')}}</h2>
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
                    <th scope="col">Choice</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($question->choices as $choice)
                    <tr>
                        <th scope="row">{{$choice->id}}</th>
                        <td>{{$choice->choice}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{ route('service-questions.choices.destroy', [$question->id, $choice->id]) }}"
                               onclick="event.preventDefault();
                                       document.getElementById('delete-form-{{$choice->id}}').submit();">
                                {{ __('Delete') }}
                            </a>
                            <form id="delete-form-{{$choice->id}}" action="{{ route('service-questions.choices.destroy', [$question->id, $choice->id]) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        <div class="mt-4">
            <h2>{{__('Validation Rules')}}</h2>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Rule</th>
                <th scope="col">Value</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($question->rules as $rule)
                <tr>
                    <th scope="row">{{$rule->id}}</th>
                    <td>{{$rule->rule}}</td>
                    <td>{{$rule->pivot->value}}</td>
                    <td>
                        {{--<a class="btn btn-primary" href="{{route('service-questions.show', $question->id)}}">Show</a>--}}
                        {{--<a class="btn btn-secondary" href="{{route('service-questions.edit', $question->id)}}">Edit</a>--}}
                        {{--@include('admin.layouts.deleteform', ['action' => route('service-questions.destroy', $question->id), 'id' => $question->id])--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
