@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Resize Photo</div>
            <div class="card-body">
                <form action="{{ route('resizeImage', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="photo" value="{{ $user->photo }}">
                    <div class="mb-3 row">
                        <label for="size" class="col-md-4 col-form-label text-md-end text-start">Choose image
                            size:</label>
                        <div class="col-md-6">
                            <select name="size" id="size" class="form-control">
                                <option value="square" {{ $user->sizePhoto === 'square' ? 'selected' : '' }}>Square
                                </option>
                                <option value="thumbnail" {{ $user->sizePhoto === 'thumbnail' ? 'selected' : '' }}>
                                    Thumbnail
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">

                            <button type="submit" class="btn btn-warning cute-button resize-button"
                                style="margin: 10px; color: #ffd6eb;">Resize Image</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <h4>Original Photo</h4>
        <div class="card">
            <div class="card-body">
                @if ($user->photo)
                <img src="{{ asset('storage/photos/original/' . $user->photo) }}" class="img-fluid">
                @else
                <p>Tidak Ada Photo</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h4>Square Photo</h4>
        <div class="card">
            <div class="card-body">
                @if ($user->photo)
                @if (File::exists(storage_path('app/public/photos/square/' . $user->photo)))
                <img src="{{ asset('storage/photos/square/' . $user->photo) }}" class="img-fluid">
                @else
                <p>Foto Belum Diubah Ukuran :)</p>
                @endif
                @else
                <p>Tidak Ada Foto</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h4>Thumbnail Photo</h4>
        <div class="card">
            <div class="card-body">
                @if ($user->photo)
                @if (File::exists(storage_path('app/public/photos/thumbnail/' . $user->photo)))
                <img src="{{ asset('storage/photos/thumbnail/' . $user->photo) }}" class="img-fluid">
                @else
                <p>Foto Belum Diubah Ukuran :)</p>
                @endif
                @else
                <p>Tidak Ada Foto</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection