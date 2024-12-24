@extends('admins.master')

@section('content')

<div style="margin-top: 30px;">
    <h4> All Deleted Employees </h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $key => $item)
            <tr>
                <th scope="row">{{ ++$key }}</th>
                <td> <img src="{{ $item->image }}" style="height: 50px; width: 50px; border-radius: 50%;"> </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    <form style="display: contents;" action="{{ route('restore_employee', $item->id) }}" method="POST" onclick="return confirm('Are you sure?')">
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

    {{-- <div class="pagination" style="width: 50%; margin: auto">
        {{ $data->links('pagination::bootstrap-5') }}
    </div> --}}

</div>

@endsection