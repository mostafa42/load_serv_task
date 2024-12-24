@extends('admins.master')

@section('content')

<div style="margin-top: 30px;">
    <h4> All Deleted Customers </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
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
                <td>{{ $item->added_by->name }}</td>
                <td>

                    <form style="display: contents;" action="{{ route('restore_customers', $item->id) }}" method="POST" onclick="return confirm('Are you sure?')">
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