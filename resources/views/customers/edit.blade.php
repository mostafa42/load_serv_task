@extends('admins.master')

@section('content')

<form action="{{ route('customers.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="">Customer Name</label>
    <input class="form-control" type="text" name="name" value="{{ $data->name }}"> <br>

    <label for="">Customer Phone</label>
    <input class="form-control" type="text" name="phone" value="{{ $data->phone }}"> <br>

    <label for="">Customer Email</label>
    <input class="form-control" type="text" name="email" value="{{ $data->email }}"> <br>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection