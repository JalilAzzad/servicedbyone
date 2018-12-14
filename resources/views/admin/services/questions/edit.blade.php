@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">{{ __('Edit Service Question')}}#{{$question->id}}</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('service-questions.update', $question->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{old('name', $question->name) }}">
            </div>
            <div class="form-group">
                <label for="question">Question</label>
                <input name="question" type="text" class="form-control" id="question" value="{{old('question', $question->question) }}">
            </div>

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    @php($temp = \App\Models\ServiceQuestion::TYPES)
                    @foreach($temp as $t)
                        <option value="{{$t}}" @if($question->type == $t || $t == old('type', false)) selected @endif>{{$t}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_required" id="is_required" {{ old('is_required', $question->rules->where('rule', \App\Models\ServiceQuestionValidationRule::REQUIRED)->first()) ? 'checked' : '' }}>

                <label class="form-check-label" for="is_required">
                    {{ __('IS Required?') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_only_for_guest" id="is_only_for_guest" {{ old('is_only_for_guest', $question->rules->where('rule', \App\Models\ServiceQuestionValidationRule::AUTH_GUEST)->first()) ? 'checked' : '' }}>

                <label class="form-check-label" for="is_only_for_guest">
                    {{ __('IS Only for Guest?') }}
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_only_for_authenticated" id="is_only_for_authenticated" {{ old('is_only_for_authenticated', $question->rules->where('rule', \App\Models\ServiceQuestionValidationRule::AUTH_REQUIRED)->first()) ? 'checked' : '' }}>

                <label class="form-check-label" for="is_only_for_authenticated">
                    {{ __('IS Only for Authenticated?') }}
                </label>
            </div>

            <hr>

            @if($question->type == \App\Models\ServiceQuestion::TYPE_SELECT || $question->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE)
                <div id="choices" style="">
                    <div id="choice-inputs">
                            @foreach($question->choices as $choice)
                                <div>
                                    <div class="form-group">
                                        <label>Choice # {{$loop->iteration}}</label>
                                        <input type="text" name="choices[]" class="form-control" value="{{$choice->choice}}" />
                                    </div>
                                </div>
                            @endforeach
                    </div>

                    <button class="btn btn-primary" type="button" id="addChoice">Add</button>
                    <button class="btn btn-primary" type="button" id="removeChoice">Remove</button>
                    <div class="mt-2"></div>
                    <hr>
                    <div class="mt-2"></div>
                </div>
            @else
                <div id="choices" style="display: none;">
                    <div id="choice-inputs"></div>

                    <button class="btn btn-primary" type="button" id="addChoice">Add</button>
                    <button class="btn btn-primary" type="button" id="removeChoice">Remove</button>
                    <div class="mt-2"></div>
                    <hr>
                    <div class="mt-2"></div>
                </div>
            @endif

            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/service-questions/' :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#type').on('change', function (){
                if(this.value == '{{\App\Models\ServiceQuestion::TYPE_SELECT}}' ||
                    this.value == '{{\App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE}}')
                {
                    $('#choices').show();
                } else {
                    $('#choices').hide();
                }
            });

            var total_choices = {{count($question->choices)}};
            $('#addChoice').click(function(){
                $('#choice-inputs').append("<div>" +
                    "<div class=\"form-group\">\n" +
                    "<label>Choice #"+total_choices+"</label>\n" +
                    "<input type=\"text\" name=\"choices[]\" class=\"form-control\" />\n" +
                    "</div>" +
                    "</div>");
                total_choices++;
            });

            $('#removeChoice').click(function(){
                $('#choice-inputs > div:last-child').remove();
                total_choices--;
            });
        });
    </script>
@endsection