@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <h2 class="">Invoice For Service Request#{{$request->id}}</h2>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @include('errors.list')

        @if($request->invoice)
            @if(is_null($request->invoice->charge_id))
                <form action="{{ route('service-requests.invoice.update', [$request->id, $request->invoice->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="sort-container">
                        <?php $i = 0 ?>
                        @foreach($request->invoice->details as $row)
                            <?php $i++?>
                            <div class="sort-item" id="row-{{$loop->iteration}}">
                                <input type="hidden" class="sort-order-value" name="sort-order[{{$loop->index}}]" value="{{$loop->iteration}}">
                                <label class="sr-only" for="inlineFormInputGroup">Detail</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text dragdrop-handle"><i class="fa fa-arrows"></i></div>
                                    </div>
                                    <input name="detail[{{$loop->index}}]" type="text" class="form-control" placeholder="Detail" required min='0' value="{{$row->detail}}">
                                    <input name="cost[{{$loop->index}}]" type="number" step="0.01" class="form-control" placeholder="$0.0" required min='0' value="{{$row->cost}}">
                                    <input name="quantity[{{$loop->index}}]" type="number" step="1" class="form-control" placeholder="Quantity" min='0' required value="{{$row->quantity}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger delete-handle" type="button" data-row="{{$loop->iteration}}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- /.sort-container -->

                    <div class="form-group form-check">
                        <input name="mail" type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Send Email to User?</label>
                    </div>
                    <input name="count" type="hidden" id="totalCountUpdate" value="{{$i}}"></input>
                    <button id="addRow" class="btn btn-outline-primary" type="button">Add Row</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-danger float-right" href="{{url('admin/service-requests/changeRefferal/' . $request->invoice->id . '/' . $request->id )}}">Paid</a>
                </form>
            @else
                <div class="alert alert-info">Invoice for this request is already paid. And charge id is: {{$request->invoice->charge_id}}</div>
            @endif

        @else
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
                            <input name="detail[]" type="text" class="form-control" placeholder="Detail" required min='0'>
                            <input name="cost[]" type="number" step="0.01" class="form-control" placeholder="$0.0" required min='0'>
                            <input name="quantity[]" type="number" step="1" class="form-control" placeholder="Quantity" min='0' required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger delete-handle" type="button" data-row="1">Delete</button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.sort-container -->

                <div class="form-group form-check">
                    <input name="mail" type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Send Email to User?</label>
                </div>
                <input name="count" type="hidden" id="totalCountCreate" value="1"></input>
                <button id="addRow" class="btn btn-outline-primary" type="button">Add Row</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        @endif

        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="{{' /admin/service-requests/'}}">Back</a>
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
                $('#totalCountCreate').val(count);
                cnt = parseInt($('#totalCountUpdate').val()) + 1;
                $('#totalCountUpdate').val(cnt);
            });

            $( '.sort-container' ).on( 'click', '.delete-handle', function () {
                console.log('check');
                var row = $(this).data('row');
                $('#row-'+row).remove();
            });
        });
    </script>
@endsection