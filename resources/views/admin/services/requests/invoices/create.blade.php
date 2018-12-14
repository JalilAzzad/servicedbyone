@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Create Invoice For Service Request#{{$request->id}}</h2>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @include('errors.list')

        <form action="{{ route('service-requests.invoice.store', $request->id) }}" method="POST">
            @csrf

            <div class="sort-container">
                <div class="sort-item" id="row-1">
                    <input type="hidden" class="sort-order-value" name="sort-order[]" value="1">
                    <label class="sr-only" for="inlineFormInputGroup">Detail</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text dragdrop-handle"><i class="fa fa-arrows"></i></div>
                        </div>
                        <input name="detail[]" type="text" class="form-control" placeholder="Detail">
                        <input name="cost[]" type="number" step="0.01" class="form-control" placeholder="$0.0">
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger delete-handle" type="button" data-row="1">Delete</button>
                        </div>
                    </div>
                </div>

            </div><!-- /.sort-container -->

        </form>

        <button id="addRow" class="btn btn-primary">Add</button>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="{{url()->previous() == url()->current() ? '/admin/service-requests/'.$request->id :url()->previous()}}">Back</a>
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
                    "                        <input type=\"text\" class=\"form-control\" placeholder=\"Detail\">\n" +
                    "                        <input type=\"number\" step=\"0.01\" class=\"form-control\" placeholder=\"$0.0\">\n" +
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