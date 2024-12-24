@extends('admins.master')

@section('content')

<form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="">Employee image</label>
    <input class="form-control" type="file" name="image"> <br>

    <label for="">Employee name</label>
    <input class="form-control" type="text" name="name"> <br>

    <label for="">Employee phone</label>
    <input class="form-control" type="number" name="phone"> <br>

    <label for="">Employee email</label>
    <input class="form-control" type="email" name="email"> <br>

    <label for="">Employee password</label>
    <input class="form-control" type="password" name="password"> <br>

    <label for="">Confirm employee password</label>
    <input class="form-control" type="password" name="confirm_password"> <br>

    <label for="">Permissions</label><br>
    <hr>
    @foreach ($permissions as $permission)
        <div>
            <input type="checkbox" id="permission" name="permissions[]" value="{{ $permission->name }}">
            <label for="permission"> {{ $permission->name }} </label><br>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Save</button>
</form>

<div style="margin-top: 30px;">
    <h4> All Employees </h4>
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
                    <a class="btn btn-primary" href="{{ route('employee.edit', $item->id) }}">Edit</a>

                    <form style="display: contents;" action="{{ route('employee.destroy', $item->id) }}" method="POST"
                        onclick="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                            Delete
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