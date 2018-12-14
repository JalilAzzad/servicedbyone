<?php

namespace App\Http\Controllers\User;

use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:'.User::USER)->except(['invoice', 'charge', 'chargeJson']);
        $this->middleware('verified')->except(['invoice', 'charge', 'chargeJson']);
    }

    public function index()
    {
        $requests = auth()->user()->requests;

        return view('user.services.requests.index');
    }

    public function show(Request $request, $id)
    {
        $serviceRequest = auth()->user()->requests()->with('user', 'service', 'invoice', 'invoice.details')->findOrFail((int) $id);

        return view('user.services.requests.show', ['request' => $serviceRequest]);
    }

    public function invoice(Request $request, $hash)
    {
        $serviceRequest = ServiceRequest::with('user', 'service', 'invoice', 'invoice.details')->findOrFail((int) \Hashids::decode($hash)[0]);

//        if($request->has('signature'))
//        {
//            if(! $request->hasValidSignature())
//                abort(401);
//
//            auth()->loginUsingId($serviceRequest->user->id);
//        } else {
//            if(!auth()->check())
//                abort(401);
//            if(auth()->id() != $serviceRequest->user->id)
//                abort(401);
//        }

        return view('user.services.requests.invoice', ['request' => $serviceRequest]);
    }


    public function charge(Request $request, $serviceRequestId)
    {
        $serviceRequest = ServiceRequest::with('invoice')->findOrFail((int) $serviceRequestId);

        try {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey('sk_test_ptpyNSoXKTmVriMDTP6AxySu');

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $charge = \Stripe\Charge::create([
                'amount' => (int) ($serviceRequest->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total * 100),
                'currency' => 'usd',
                'description' => 'Charge for Service Request#' .$serviceRequest->id,
                'source' => $request->input('stripeToken'),
            ]);

            $serviceRequest->invoice->update(['charge_id' => $charge->id]);

            return view('user.services.requests.payment', ['success' => 'Payment was successful', 'request' => $serviceRequest]);
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => 'Payment was declined'])->withInput($request->all());
//            return $ex->getMessage();
        }
    }


    public function chargeJson(Request $request, $serviceRequestId)
    {
        $serviceRequest = ServiceRequest::with('invoice')->findOrFail((int) $serviceRequestId);

        try {
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey('sk_test_ptpyNSoXKTmVriMDTP6AxySu');

            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $charge = \Stripe\Charge::create([
                'amount' => (int) ($serviceRequest->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total * 100),
                'currency' => 'usd',
                'description' => 'Charge for Service Request#' .$serviceRequest->id,
                'source' => $request->input('stripeToken'),
            ]);

            $serviceRequest->invoice->update(['charge_id' => $charge->id]);

            return response()->json(['success' => 'Payment was successful']);
        } catch (\Exception $ex) {
//            return $ex->getMessage();
            return response()->json(['error' => 'Payment was declined']);
        }
    }
}
