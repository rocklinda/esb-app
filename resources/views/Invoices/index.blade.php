@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>ESB Apps</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('invoices.create') }}" title="Create a invoice"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Invoice ID</th>
            <th>From</th>
            <th>For</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Subject</th>
            <th>Subtotal</th>
            <th>Tax</th>
            <th>Payments</th>
            <th>Date Creation</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $invoice->supplier->name }}</td>
                <td>{{ $invoice->customer->name }}</td>
                <td>{{ $invoice->issue_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ $invoice->subject }}</td>
                <td>{{ $invoice->subtotal }}</td>
                <td>{{ $invoice->tax }}</td>
                <td>{{ $invoice->payment }}</td>
                <td>{{ $invoice->created_at }}</td>
                <td>
                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST">

                        <a href="{{ route('invoices.show', $invoice->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('invoices.edit', $invoice->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $invoices->links() !!}

@endsection