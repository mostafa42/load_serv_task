@extends('admins.master')

@section('content')


<div style="margin-top: 30px;">
    <h4> All Customers Invoices </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Employee Data</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key => $item)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td>{{ $item->created_at }}</td>
                <td>
                    {{ $item->employee->name }} <br>
                    {{ $item->employee->phone }} <br>
                    {{ $item->employee->email }}
                </td>
                <td>{{ $item->employee->name . " " . $item->log_operation . " an " . $item->log_model  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination" style="width: 50%; margin: auto">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection