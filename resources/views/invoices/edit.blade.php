@extends('admins.master')

@section('content')

<form action="{{ route('invoices.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="">Choose Customer</label>
    <select name="customer_id" class="form-control form-select">
        <option value="">select customer</option>
        @foreach ($customers as $customer)
        <option value="{{ $customer->id }}" {{ $data->customer_id == $customer->id ? "selected" : "" }}>{{ $customer->name }}</option>
        @endforeach
    </select><br>

    <label for="">Invoice amount</label>
    <input class="form-control" type="number" name="invoice_amount" value="{{ $data->invoice_amount }}"> <br>

    <label for="">Invoice date</label>
    <input class="form-control" type="date" name="invoice_date" value="{{ $data->invoice_date }}"> <br>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection