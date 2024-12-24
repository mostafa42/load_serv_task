@extends('admins.master')

@section('content')

<div style="margin-top: 30px;">
    <h4> All Customers Invoices </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Invoice Number</th>
                <th scope="col">Customer Data</th>
                <th scope="col">Invoice Amount</th>
                <th scope="col">Created By</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key => $item)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $item->invoice_number }}</td>
                <td>
                    {{ $item->customer->name }} <br>
                    {{ $item->customer->phone }} <br>
                    {{ $item->customer->email }}
                </td>
                <td>{{ number_format($item->invoice_amount, 2) }} EGP</td>
                <td>{{ $item->added_by->name }}</td>
                <td>
                    <form style="display: contents;" action="{{ route('restore_invoices', $item->id) }}" method="POST" onclick="return confirm('Are you sure?')">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Restore
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection