<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceResource;

class InvoiceApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('details')->get();
        return response([ 'invoices' => InvoiceResource::collection($invoices), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $checkInvoice = Invoice::with('details')->where('id', $invoice->id)->get();
        if ($checkInvoice) {
            return response(['invoice' => $checkInvoice, 'message' => 'Retrieved successfully'], 200);
        }else {
            return response(['invoice' => null, 'message' => 'Data Not Found'], 404);
        }   
    }
}
