@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="supplier-option">From:</label>
                    <select class="form-control" id="supplier_id" name="supplier_id">
                    <option value="" disabled>Select supplier</option>
                      @foreach ($suppliers as $supplier)
                          <option value="{{ $supplier->id }}" @if($supplier->id == $invoice->supplier_id) selected  @endif>{{ $supplier->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="customer-option">For:</label>
                    <select class="form-control" id="customer_id" name="customer_id">
                    <option value="" disabled>Select customer</option>
                      @foreach ($customers as $customer)
                          <option value="{{ $customer->id }}" @if($customer->id == $invoice->customer_id) selected  @endif>{{ $customer->name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Subject:</strong>
                    <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ $invoice->subject }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Due Date:</strong>
                    <input type="date" name="due_date" class="form-control" placeholder="Due Date" value="{{ $invoice->due_date }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Issue Date:</strong>
                    <input type="date" name="issue_date" class="form-control" placeholder="Issue Date" value="{{ $invoice->issue_date }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Payment:</strong>
                    <input type="number" name="payment" class="form-control" placeholder="Payment" value="{{ $invoice->payment }}">
                </div>
            </div>
            <table class="table" id="items_table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                </thead>                
                <tbody>
                @foreach ($invoice->details as $detail)
                    <tr id="item0">
                        <td>
                            <select name="items[]" class="form-control" id=items>
                                <option value="" disabled>-- choose item --</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $detail->item_id) selected  @endif>
                                        {{ $item->description }} (${{ number_format($item->unit_price, 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control" value="{{ $detail->quantity }}" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="add_row" class="btn btn-default">+ Add Row</button>
                    <button type="button" id='delete_row' class="btn btn-danger">- Delete Row</button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    let row_number = {{ count(old('items', [''])) }};
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#item' + row_number).html($('#item' + new_row_number).html()).find('td:first-child');
      $('#items_table').append('<tr id="item' + (row_number + 1) + '"></tr>');
      row_number++;
    });
    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#item" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });
</script>
@endsection