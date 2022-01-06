<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoice::latest()->paginate(5);
        return view('invoices.index', compact('invoices'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $suppliers = supplier::all();
        $customers = customer::all();
        $items = item::all();
        return view('invoices.create', compact('suppliers', 'customers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        $request->validate([
            'supplier_id' => 'required',
            'customer_id' => 'required',
            'issue_date' => 'required',
            'due_date' => 'required',
            'subject' => 'required',
            'payment' => 'required'
        ]);

        $input = $request->all();
        $items = [];
        $input['subtotal'] = 0;
        foreach ($request->items as $key => $itemId) {
            $getItem = item::find($itemId);
            $price = $getItem->unit_price;
            $amount = $price * $request->quantities[$key];
            $items [] = array(
                'invoice_id' => '',
                'item_id' => $itemId,
                'quantity' => $request->quantities[$key],
                'unit_price' => $price,
                'amount' => $amount
            );
            $input['subtotal'] += $amount;
        }
        $input['tax'] = $input['subtotal'] * 0.1;
        unset($input['items']);
        unset($input['quantities']);
        $invoice = invoice::create($input);
        foreach ($items as $key => $item) {
            $item['invoice_id'] = $invoice->id;
            invoiceDetail::create($item);
        }

        return redirect()->route('invoices.index')
            ->with('success', 'invoice created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $suppliers = supplier::all();
        $customers = customer::all();
        $items = item::all();
        return view('invoices.edit', compact('invoice', 'suppliers', 'customers', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'supplier_id' => 'required',
            'customer_id' => 'required',
            'issue_date' => 'required',
            'due_date' => 'required',
            'subject' => 'required',
            'payment' => 'required'
        ]);

        $input = $request->all();
        $items = [];
        $input['subtotal'] = 0;
        foreach ($request->items as $key => $itemId) {
            $getItem = item::find($itemId);
            $price = $getItem->unit_price;
            $amount = $price * $request->quantities[$key];
            $items [] = array(
                'invoice_id' => '',
                'item_id' => $itemId,
                'quantity' => $request->quantities[$key],
                'unit_price' => $price,
                'amount' => $amount
            );
            $input['subtotal'] += $amount;
        }
        $input['tax'] = $input['subtotal'] * 0.1;
        unset($input['items']);
        unset($input['quantities']);
        $invoice->update($input);
        invoiceDetail::where('invoice_id', $invoice->id)->delete();
        foreach ($items as $key => $item) {
            $item['invoice_id'] = $invoice->id;
            invoiceDetail::create($item);
        }

        return redirect()->route('invoices.index')
            ->with('success', 'invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        invoiceDetail::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'invoice deleted successfully');
    }
}
