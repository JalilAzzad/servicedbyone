@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Service#{{$service->id}}</h2>
        </div>
        @include('errors.list')
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ old('name', false) ? old('name') : $service->name }}">
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', false) ? old('description') : $service->description }}</textarea>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="location_type">Location Type</label>--}}
                {{--<select name="location_type" class="form-control" id="location_type">--}}
                    {{--<option value="{{\App\Models\Service::LOCATION_TYPE_ALL}}">{{\App\Models\Service::LOCATION_TYPE_ALL}}</option>--}}
                    {{--<option value="{{\App\Models\Service::LOCATION_TYPE_IN}}">{{\App\Models\Service::LOCATION_TYPE_IN}}</option>--}}
                    {{--<option value="{{\App\Models\Service::LOCATION_TYPE_EXCEPT}}">{{\App\Models\Service::LOCATION_TYPE_EXCEPT}}</option>--}}
                    {{--<option value="{{\App\Models\Service::LOCATION_TYPE_VIRTUAL}}">{{\App\Models\Service::LOCATION_TYPE_VIRTUAL}}</option>--}}
                {{--</select>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="locations">Locations</label>
                <select name="locations[]" multiple class="form-control" id="locations"></select>
            </div>
            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" multiple class="form-control" id="categories"></select>
            </div>
            <div class="form-group">
                <label for="questions">Questions</label>
                <select name="questions[]" multiple class="form-control" id="questions"></select>
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input name="featured_image" type="file" class="form-control" id="featured_image" />
            </div>

            <a class="btn btn-danger" href="{{url()->previous() == url()->current() ? '/admin/services/' :url()->previous()}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#locations').select2({
                ajax: {
                    url: "{{url('/admin/services/states')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a location',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                templateResult: formatLocation,
                templateSelection: formatLocationSelection,
                closeOnSelect: false
            });

            function formatLocation (location) {
                if (location.loading) {
                    return location.text;
                }

                var markup = "<div class='select2-result-location clearfix'>" +
                    "<div class='select2-result-location__meta'>" +
                    "<div class='select2-result-location__title'>" + location.state + ' | ' + location.state_code + "</div>" +
                    "</div>" +
                    "</div>";

                return markup;
            }

            function formatLocationSelection (location) {
                return location.state + " | " + location.state_code;
            }


            $('#categories').select2({
                ajax: {
                    url: "{{url('/admin/services/categories')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a Category',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 2,
                templateResult: formatCategory,
                templateSelection: formatCategorySelection,
                closeOnSelect: false
            });

            function formatCategory (category) {
                return category.id + " | " + category.name;
            }

            function formatCategorySelection (category) {
                return category.name;
            }


            $('#questions').select2({
                ajax: {
                    url: "{{url('/admin/services/questions')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a Question',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 2,
                templateResult: formatQuestion,
                templateSelection: formatQuestionSelection,
                closeOnSelect: false
            });

            function formatQuestion (question) {
                return question.id + " | " + question.name + " | " + question.question;
            }

            function formatQuestionSelection (question) {
                return question.id + " | " + question.name + " | " + question.question;
            }

            @foreach($service->states as $l)
            $("#locations").select2("trigger", "select", {data: {!! json_encode($l->only(['id', 'state', 'state_code'])) !!}});
            @endforeach

            @foreach(\App\Models\State::whereIn('id', old('locations', []))->get() as $l)
            $("#locations").select2("trigger", "select", {data: {!! json_encode($l->only(['id', 'state', 'state_code'])) !!}});
            @endforeach


            @foreach($service->categories as $c)
            $("#categories").select2("trigger", "select", {data: {!! json_encode($c->only(['id', 'name'])) !!}});
            @endforeach

            @foreach(\App\Models\ServiceCategory::whereIn('id', old('categories', []))->get() as $c)
            $("#categories").select2("trigger", "select", {data: {!! json_encode($c->only(['id', 'name'])) !!}});
            @endforeach


            @foreach($service->questions as $q)
            $("#questions").select2("trigger", "select", {data: {!! json_encode($q->only(['id', 'name', 'question'])) !!}});
            @endforeach

            @foreach(\App\Models\ServiceQuestion::whereIn('id', old('questions', []))->get() as $q)
            $("#questions").select2("trigger", "select", {data: {!! json_encode($q->only(['id', 'name', 'question'])) !!}});
            @endforeach



            $('#location_type').on('change', function() {
                onChangeLocationType(this.value);
            });

            function onChangeLocationType(value) {
                if(value == '{{\App\Models\Service::LOCATION_TYPE_ALL}}') {
                    $('#locations-form-group').hide();
                } else if(value == '{{\App\Models\Service::LOCATION_TYPE_IN}}') {
                    $('#locations-form-group').show();
                } else if(value == '{{\App\Models\Service::LOCATION_TYPE_EXCEPT}}') {
                    $('#locations-form-group').show();
                } else if(value == '{{\App\Models\Service::LOCATION_TYPE_VIRTUAL}}') {
                    $('#locations-form-group').hide();
                }
            }

            onChangeLocationType($('#location_type').val());
        });
    </script>
@endsection