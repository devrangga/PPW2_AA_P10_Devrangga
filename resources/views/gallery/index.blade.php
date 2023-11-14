@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Gallery Portofolio</div>
            <div class="card-body">
                <!-- Form for adding a new image -->
                <div class="mb-3">
                    <a href="{{ route('gallery.create')}}" class="btn btn-success">Tambah Data</a>
                </div>

                <!-- Gallery images -->
                <div class="row">
                    @if(count($galleries) > 0)
                        @foreach ($galleries as $gallery)
                            <div class="col-sm-4 mb-4">
                                <div class="card">
                                    <a class="example-image-link" href="{{asset('storage/posts_image/asli/'.$gallery->picture)}}" data-lightbox="roadtrip" data-title="{{$gallery->description}}">
                                        <img class="card-img-top example-image img-fluid" src="{{asset('storage/posts_image/resize/'.$gallery->picture)}}" alt="image-1" />
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button style="background-color: red; color:white;padding: 7px;border-radius:5px;" type="submit" class="btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h3 class="text-center">Tidak ada data.</h3>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection