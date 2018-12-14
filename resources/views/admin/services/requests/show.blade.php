@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Service Request#{{$request->id}}</h2>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td>{{$request->id}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Service ID') }}</th>
                <td>{{$request->service_id}} | {{$request->service->name}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Location') }}</th>
                <td>{{$request->location->zip}} | {{$request->location->city->city}} | {{$request->location->city->state_code}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Created At') }}</th>
                <td>{{$request->created_at->toRfc850String()}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Updated At') }}</th>
                <td>{{$request->updated_at->toRfc850String()}}</td>
            </tr>
            <tr>
                <th scope="row">{{ __('Actions') }}</th>
                <td>
                    @include('admin.layouts.deleteform', ['action' => route('service-requests.destroy', $request->id), 'id' => $request->id])
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                </tr>
                </thead>
                <tbody>
                @foreach($request->service->questions as $question)
                    <tr>
                        <td>{{$question->id}} | {{$question->name}} | {{$question->question}}</td>
                        <td>
                            @php($a = $request->answers->where('question_id', $question->id)->first())
                            @if(is_null($a))
                                <p class="text-danger">No Answer</p>
                            @else
                                @if($question->type == \App\Models\ServiceQuestion::TYPE_BOOLEAN)
                                    {{ $a->answer->answer ? 'Yes' : 'No' }}
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_TEXT)
                                    {{ $a->answer->answer }}
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_TEXT_MULTILINE)
                                    {{ $a->answer->answer }}
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_TIME)
                                    {{ $a->answer->answer }}
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_DATE)
                                    {{ $a->answer->answer }}
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_DATE_TIME)
                                    {{ $a->answer->answer }}
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_FILE)
                                    <img src="{{ asset(str_replace("public","storage", $a->answer->file_path)) }}" alt="" style="width: 100%">
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_FILE_MULTIPLE)
                                    @foreach($request->answers->where('question_id', $question->id) as $c)
                                        <img src="{{ asset(str_replace("public","storage", $c->answer->file_path)) }}" alt="" style="width: 100%"><br />
                                    @endforeach
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT)
                                    @foreach($request->answers->where('question_id', $question->id) as $c)
                                        {{ $c->answer->choice->id }} | {{ $c->answer->choice->choice }}<br />
                                    @endforeach
                                @elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE)
                                    @foreach($request->answers->where('question_id', $question->id) as $c)
                                        {{ $c->answer->choice->id }} | {{ $c->answer->choice->choice }}<br />
                                    @endforeach
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>
        <hr>

        <a class="btn btn-primary" href="{{url()->previous() == url()->current() ? '/admin/service-requests' :url()->previous()}}">Back</a>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var count = 1;
            $('#addRow').click(function(){
                count++;
                $('.sort-container').append("<div class=\"sort-item\" id=\"row-"+count+"\">\n" +
                    "                    <input type=\"hidden\" class=\"sort-order-value\" name=\"sort-order[]\" value=\""+count+"\">\n" +
                    "                    <label class=\"sr-only\" for=\"inlineFormInputGroup\">Detail</label>\n" +
                    "                    <div class=\"input-group mb-2\">\n" +
                    "                        <div class=\"input-group-prepend\">\n" +
                    "                            <div class=\"input-group-text dragdrop-handle\"><i class=\"fa fa-arrows\"></i></div>\n" +
                    "                        </div>\n" +
                    "                        <input name=\"detail[]\" type=\"text\" class=\"form-control\" placeholder=\"Detail\" required min='0'>\n" +
                    "                        <input name=\"cost[]\" type=\"number\" step=\"0.01\" class=\"form-control\" placeholder=\"$0.0\" required min='0'>\n" +
                    "                        <input name=\"quantity[]\" type=\"number\" step=\"1\" class=\"form-control\" placeholder=\"Quantity\" min='0' required>\n" +
                    "                        <div class=\"input-group-append\">\n" +
                    "                            <button class=\"btn btn-outline-danger delete-handle\" type=\"button\" data-row=\""+count+"\">Delete</button>" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                </div>");
            });

            $( '.sort-container' ).on( 'click', '.delete-handle', function () {
                console.log('check');
                var row = $(this).data('row');
                $('#row-'+row).remove();
            });
        });
    </script>
@endsection