@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="row mt-3 mb-3">
            @include('layouts.user.sidebar')
            <div class="col-md-9 mb-3">
                @error('house_pic')
                <div class="text-danger text-center mb-3 small">
                    {{ $message }}
                </div>
                @enderror
                @if(session('photo_success'))
                    <div class="alert alert-success text-center mb-3 small">
                        {{ session('photo_success') }}
                    </div>
                @endif
                @if(session('category_success'))
                    <div class="alert alert-success text-center mb-3 small">
                        {{ session('category_success') }}
                    </div>
                @endif
                @if(session('delete_success'))
                    <div class="alert alert-success text-center mb-3 small">
                        {{ session('delete_success') }}
                    </div>
                @endif
                <div class="row">
                    @foreach($lodge->lodgePicture as $lodgePic)
                        <div class="col-md-4 mb-3">
                            <div class="card p-2 shadow-sm">
                                <img src="/house_images/{{ $lodgePic->lodge_pic }}"
                                     class="img-thumbnail d-block mx-auto img-fluid"
                                     style="width: 100%; height: 200px;">
                                <form action="/agent/house/photo/{{ $lodgePic->id }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="house_pic" class="form-control">
                                    <input type="submit" value="Update Picture"
                                           class="btn btn-primary d-block mx-auto mt-2 mb-3">
                                </form>
                                <form action="/agent/house/photo/{{ $lodgePic->id }}/delete" method="post">
                                    @csrf
                                    <input class="btn btn-danger mx-auto d-block" value="Delete Pic" type="submit">
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection