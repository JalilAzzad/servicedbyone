<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreAndUpdateServiceRequestInvoiceRequest;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestInvoice;
use App\Models\ServiceRequestInvoiceDetail;
use App\Models\Seo;
use App\Models\User;
use App\Models\Referral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceRequestInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ServiceRequestInvoice::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ServiceRequest $serviceRequest)
    {
        return view('admin.services.requests.invoices.create', ['request' => $serviceRequest]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Models\ServiceRequest $serviceRequest
     * @param  \App\Http\Requests\Admin\StoreAndUpdateServiceRequestInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAndUpdateServiceRequestInvoiceRequest $request, ServiceRequest $serviceRequest)
    {
        $validated = $request->validated();
        $invoice = ServiceRequestInvoice::firstOrCreate([
            'request_id' => $serviceRequest->id
        ]);
        // Create invoices
        for($i = 0; $i < $request['count']; $i++){
            if(isset($validated['detail'][$i])){
                 $invoiceDetail = ServiceRequestInvoiceDetail::create([
                    'invoice_id' => (int) $invoice->id,
                    'detail' => $validated['detail'][$i],
                    'cost' => $validated['cost'][$i],
                    'quantity' => ($validated['quantity'][$i]) ? $validated['quantity'][$i] : null
                ]);
            }
        }

        if(isset($validated['mail']) && $validated['mail'])
            $serviceRequest->user->notify(new \App\Notifications\ServiceRequestInvoice($serviceRequest));
        return redirect('/admin/service-requests/showInvoice/'.$serviceRequest->id)->with('status', 'Invoice is created successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceRequestInvoice  $serviceRequestInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceRequestInvoice $serviceRequestInvoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceRequestInvoice  $serviceRequestInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceRequestInvoice $serviceRequestInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreAndUpdateServiceRequestInvoiceRequest  $request
     * @param \App\Models\ServiceRequest $serviceRequest
     * @param  \App\Models\ServiceRequestInvoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAndUpdateServiceRequestInvoiceRequest $request, ServiceRequest $serviceRequest, ServiceRequestInvoice $invoice)
    {
        $validated = $request->validated();
        $invoice->details()->delete();
        // Update invoices
        for($i = 0; $i < $request['count']; $i++){
            if(isset($validated['detail'][$i])){
                $invoiceDetail = ServiceRequestInvoiceDetail::create([
                    'invoice_id' => (int) $invoice->id,
                    'detail' => $validated['detail'][$i],
                    'cost' => $validated['cost'][$i],
                    'quantity' => ($validated['quantity'][$i]) ? $validated['quantity'][$i] : null
                ]);
            }
        }

        if(isset($validated['mail']) && $validated['mail'])
            $serviceRequest->user->notify(new \App\Notifications\ServiceRequestInvoice($serviceRequest));
        return redirect('/admin/service-requests/showInvoice/'.$serviceRequest->id)->with('status', 'Invoice is updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceRequestInvoice  $serviceRequestInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceRequestInvoice $serviceRequestInvoice)
    {
        //
    }

     /**
     * Change the commission.
     *
     * @param  \App\Models\ServiceRequestInvoice  $serviceRequestInvoice
     * @return \Illuminate\Http\Response
     */
    public function changeRefferal($invoice_id,$request_id)
    {
        $invoiceItems = ServiceRequestInvoiceDetail::where('invoice_id',$invoice_id)->get();

        $totalCost = 0;
            
        foreach ($invoiceItems as $invoiceItem) {
                $totalCost += $invoiceItem->cost * $invoiceItem->quantity; 
        }

        $refereeID = ServiceRequest::where('id',$request_id)->get()->first()->user_id;
        $referral = Referral::where('referee_id',$refereeID)->first();

        if(isset($referral))
        {
            $referrerID = $referral->referrer_id;
            $referrer = User::where('id',$referrerID)->first();
            $commission = $totalCost * $referrer->commission / 100;
            User::where('id',$referrerID)->update(['balance' => $referrer->balance + $commission]);
            Referral::where('referee_id',$refereeID)->update(['commission' => $referral->commission + $commission]);
        }

        return redirect('/admin/service-requests/showInvoice/'.$request_id)->with('status', 'Paid successfully!!!');
    }  
}
