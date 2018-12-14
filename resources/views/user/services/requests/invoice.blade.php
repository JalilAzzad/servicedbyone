@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Service Request for <b>{{$request->service->name}}</b></h4>
                    <hr>
                    <h6 class="card-title">Invoice</h6>

                    @include('errors.list')

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($request->invoice->details as $detail)
                            <tr>
                                <th scope="row">{{$loop->index + 1}}</th>
                                <td>{{$detail->detail}} <b>{{ ($detail->quantity ? 'X ' . $detail->quantity : '') }}</b></td>
                                <td>${{number_format($detail->cost * ($detail->quantity ? $detail->quantity : 1), 2)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th scope="row"></th>
                                <td class="text-right"><b>Total</b></td>
                                <td><b>${{$request->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total}}</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    @if(is_null($request->invoice->charge_id))
                        <div>
                            <div class="alert alert-success" id="success" style="display:none;">Payment Successfull!</div>
                            <div class="alert alert-danger" id="fail" style="display:none;">Payment Declined!</div>
                        </div>

                        <div class="">
                            <div id="payment-request-button" class="mb-3">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <form action="{{ route('user.service-requests.charge', $request->id) }}" method="POST" class="pull-right" id="stripe-payment-element">
                                @csrf
                                <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                        data-key="pk_test_kv0g7LnJZvNeblzW2hLrOTjm"
                                        data-amount="{{(int) ($request->invoice->details()->select(\DB::raw('sum(cost * quantity) as total'))->first()->total * 100)}}"
                                        data-name="ServicedByOne.com"
                                        data-description="ServicedByONE LLC"
                                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                        data-locale="auto"
                                        data-zip-code="true"
                                        data-billing-address="true">
                                </script>
                            </form>
                        </div>

                        <div class="clearfix"></div>
                    @else
                        <div class="alert alert-success">This invoice is already paid!</div>
                    @endif

                </div>
            </div>
        </div>

    </div>
@endsection


@section('styles')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            // Create a Stripe client.
            var stripe = Stripe('pk_test_kv0g7LnJZvNeblzW2hLrOTjm');

            var paymentRequest = stripe.paymentRequest({
                country: 'US',
                currency: 'usd',
                total: {
                    label: "Payment for Service {{$request->service->name}}",
                    amount: {{(int) ($request->invoice->details()->select(\DB::raw('sum(cost * quantity) as total'))->first()->total * 100)}},
                },
                requestPayerName: true,
                requestPayerEmail: true,
            });

            var elements = stripe.elements();
            var prButton = elements.create('paymentRequestButton', {
                paymentRequest: paymentRequest,
            });

            // Check the availability of the Payment Request API first.
            paymentRequest.canMakePayment().then(function(result) {
                if (result) {
                    prButton.mount('#payment-request-button');
                } else {
                    document.getElementById('payment-request-button').style.display = 'none';
                }
            });

            paymentRequest.on('token', function(ev) {
                // Send the token to your server to charge it!
                fetch("{{ route('user.service-requests.chargeJson', $request->id) }}", {
                    method: 'POST',
                    body: JSON.stringify({stripeToken: ev.token.id, _token: $('meta[name="csrf-token"]').attr('content')}),
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                })
                    .then(function(response) {
                        if (response.ok) {
                            // Report to the browser that the payment was successful, prompting
                            // it to close the browser payment interface.
                            ev.complete('success');
                            console.log('success');
                            $('#payment-request-button').slideUp();
                            $('#stripe-payment-element').slideUp();
                            $('#success').slideDown();
                        } else {
                            // Report to the browser that the payment failed, prompting it to
                            // re-show the payment interface, or show an error message and close
                            // the payment interface.
                            ev.complete('fail');
                            console.log('fail');
                            $('#error').slideDown();
                        }
                    });
            });
        });
    </script>
@endsection