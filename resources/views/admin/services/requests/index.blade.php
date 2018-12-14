@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div>
            <h2>Service Requests</h2>
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
                <th scope="col">User</th>
                <th scope="col">Invoice</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
            <tr>
                <th scope="row">{{$request->id}}</th>
                <td>
                    @if($request->user)
                        <a href="{{route('users.show', $request->user->id)}}">{{ $request->user->id . ' | ' . $request->user->email }}</a>
                    @endif
                </td>
                <td>
                    @if($request->invoice)
                        @if(is_null($request->invoice->charge_id))
                            <p class="text-danger">Not Paid</p>
                        @else
                            Charge ID: {{$request->invoice->charge_id}}
                        @endif
                    @else
                        <p class="text-danger">No Invoice Found</p>
                    @endif
                </td>
                <td>{{$request->created_at->toRfc850String()}}</td>
                <td>
                    <a class="btn btn-primary" href="{{route('service-requests.show', $request->id)}}">Show</a>
                    <a class="btn btn-secondary" href="{{url('admin/service-requests/showInvoice/' . $request->id )}}">Invoice</a>
                
                    @include('admin.layouts.deleteform', ['action' => route('service-requests.destroy', $request->id), 'id' => $request->id])
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{ $requests->links() }}
    </div>
@endsection
