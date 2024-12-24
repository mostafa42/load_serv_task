@php
    $user = auth()->user();
@endphp

@extends('admins.master')

@section('content')
@if ( $user->id == 1 || $user->can('create customer') )
<form action="{{ route('customers.store') }}" method="POST">
    @csrf
    <label for="">Customer Name</label>
    <input class="form-control" type="text" name="name"> <br>

    <label for="">Customer Phone</label>
    <input class="form-control" type="text" name="phone"> <br>

    <label for="">Customer Email</label>
    <input class="form-control" type="text" name="email"> <br>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endif
@if ( $user->id == 1 || $user->can('show customer') )
<div style="margin-top: 30px;">
    <h4> All Customers </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col"># invoices</th>
                <th scope="col">Created By</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key => $item)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->invoices->count() }}</td>
                <td>{{ $item->added_by->name }}</td>
                <td>
                    @if ( $user->id == 1 || $user->can('edit customer') )
                    <a class="btn btn-primary" href="{{ route('customers.edit', $item->id) }}">Edit</a>
                    @endif

                    @if ( $user->id == 1 || $user->can('delete customer') )
                    <form style="display: contents;" action="{{ route('customers.destroy', $item->id) }}" method="POST" onclick="return confirm('Are you sure?')">
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