<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestInvoice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_id', 'charge_id'
    ];


    /**
     * Get the service request that owns the invoice.
     */
    public function request()
    {
        return $this->belongsTo('App\Models\ServiceRequest', 'request_id', 'id');
    }

    /**
     * Get the details for the invoice.
     */
    public function details()
    {
        return $this->hasMany('App\Models\ServiceRequestInvoiceDetail', 'invoice_id', 'id');
    }
}
