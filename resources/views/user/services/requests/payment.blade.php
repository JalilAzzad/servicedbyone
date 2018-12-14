@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Service Request for {{ $request->service->name }}</h5>
                    <p class="card-text">
                    @if (isset($success))
                        <div class="alert alert-success">
                            {{ $success }}
                        </div>
                    @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
