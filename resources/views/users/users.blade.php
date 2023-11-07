@extends('auth.layouts')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">DATA USER</h1>
    <table class="table table-bordered table-striped"
        style="box-shadow: 0 0 10px rgba(0,0,0,0.1); background-color: #ffe0f4;">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Photo</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_user as $user)
            <tr style="background-color: #ffd6eb;">
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center">{{ $user->email }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('storage/photos/original/' . $user->photo) }}" width="150px"
                            alt="User Photo">
                    </div>
                </td>
                <td class="text-center">
                    <div class="btn-group" role="group">

                        <form action="{{ route('resizeForm', $user) }}">
                            @csrf
                            <button class="btn btn-warning cute-button resize-button"
                                style="margin: 10px; color: #ffd6eb;">Resize
                                Photo</button>
                        </form>

                        <form action="{{ route('users.edit', $user) }}">
                            @csrf
                            <button class="btn btn-primary cute-button edit-button" style="margin: 10px;"
                                onclick="return confirm('Yakin mau melakukan edit')">Edit</button>
                        </form>

                        <form action="{{ route('users.destroy', $user) }}" method="post" class="me-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger cute-button hapus-button" style="margin: 10px;"
                                onclick="return confirm('Yakin mau dihapus')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection