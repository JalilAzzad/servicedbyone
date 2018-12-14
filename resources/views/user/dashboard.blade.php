@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Service Requests</h3>
                    <p class="card-text">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    </p>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Requested At</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$request->service->name}}</td>
                                    <td>{{$request->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        @if(is_null($request->invoice))
                                            <p class="text-info">Wait for Quote</p>
                                        @else
                                            @if(is_null($request->invoice->charge_id))
                                                <p class="text-danger">Invoice need to be paid</p>
                                            @else
                                                <p class="text-success">Invoice paid</p>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('user.service-requests.show', $request->id)}}" class="btn btn-outline-primary">View Details</a>
                                        @if(!is_null($request->invoice) && is_null($request->invoice->charge_id))
                                            <a href="{{route('user.service-requests.invoice', \Hashids::encode($request->id))}}" class="btn btn-outline-primary">Pay Invoice</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
