@extends('admins.master')

@section('content')

<form action="{{ route('employee.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="">Employee image</label><br>
    <img src="{{ $data->image }}" style="width: 50px; height: 50px;">
    <input class="form-control" type="file" name="image"> <br>

    <label for="">Employee name</label>
    <input class="form-control" type="text" name="name" value="{{ $data->name }}"> <br>

    <label for="">Employee phone</label>
    <input class="form-control" type="number" name="phone" value="{{ $data->phone }}"> <br>

    <label for="">Employee email</label>
    <input class="form-control" type="email" name="email" value="{{ $data->email }}"> <br>

    <label for="">Employee password</label>
    <input class="form-control" type="password" name="password"> <br>

    <label for="">Confirm employee password</label>
    <input class="form-control" type="password" name="confirm_password"> <br>

    <label for="">Permissions</label><br>
    <hr>
    @foreach ($permissions as $permission)
        <div>
            <input type="checkbox" id="permission" name="permissions[]" value="{{ $permission->name }}" {{ in_array( $permission->id ,  $current_permissions ) ? "checked" : "" }}>
            <label for="permission"> {{ $permission->name }} </label><br>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Save</button>
</form>

@endsection