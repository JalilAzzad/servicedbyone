@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Service Referrals</h3>
                    <h5 class="float-right referral">Total Commission: ${{$total}}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col"> Referee </th>
                                <th scope="col"> Commission </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($referees as $referee)
                                <tr>
                                    <td> {{$referee->email}} </td>
                                    <td> ${{$referee->commission}} </td>
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
