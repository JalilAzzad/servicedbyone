@component('mail::message')
# Hi {{$request->user->name}}

Thanks for ordering service [{{$request->service->name}}]. This is an invoice for your recent order.

<b>Amount Due: </b>${{$request->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total}}<br>
<b>Due By: </b>{{\Carbon\Carbon::tomorrow()->format('m-d-Y')}}

@component('mail::button', ['url' => route('user.service-requests.charge', \Hashids::encode($request->id)), 'color' => 'green'])
Pay this Invoice
@endcomponent

<b>Invoice#{{$request->invoice->id}}</b> <br>
<b>{{\Carbon\Carbon::today()->format('m-d-Y')}}</b>

@component('mail::table')
    | Description       | Amount   |
    |:----------------- | --------:|
    @foreach($request->invoice->details as $row)
    | {{$row->detail}} <b>{{($row->quantity ? ' X ' . $row->quantity : '')}}</b> | ${{$row->cost * (is_null($row->quantity) ? 1 : $row->quantity) }} |
    @endforeach
    | <b3>Total</b3> |<b>${{$request->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total}}</b>|
@endcomponent

If you have any questions about this invoice, simply reply to this email or reach out to our support team for help.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
