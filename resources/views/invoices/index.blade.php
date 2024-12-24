@php
$user = auth()->user();
@endphp

@extends('admins.master')

@section('content')
@if ( $user->id == 1 || $user->can('create invoice') )
<form action="{{ route('invoices.store') }}" method="POST">
    @csrf
    <label for="">Choose Customer</label>
    <select name="customer_id" class="form-control form-select">
        <option value="">select customer</option>
        @foreach ($customers as $customer)
        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select><br>

    <label for="">Invoice amount</label>
    <input class="form-control" type="number" name="invoice_amount"> <br>

    <label for="">Invoice date</label>
    <input class="form-control" type="date" name="invoice_date"> <br>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endif

@if ( $user->id == 1 || $user->can('show invoice') )
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
                    @if ( $user->id == 1 || $user->can('edit invoice') )
                        <a class="btn btn-primary" href="{{ route('invoices.edit', $item->id) }}">Edit</a>
                    @endif

                    @if ( $user->id == 1 || $user->can('delete invoice') )
                    <form style="display: contents;" action="{{ route('invoices.destroy', $item->id) }}" method="POST"
                        onclick="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination" style="width: 50%; margin: auto">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endif

@endsection