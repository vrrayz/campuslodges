@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="row mt-3 mb-3">
            @include('layouts.user.sidebar')
            <div class="col-md-9 mb-3">
                <div class="row mt-3">
                    <div class="col-md-12 mb-3">
                        <div class="card shadow-sm">
                            <a href="javascript:void(0)" id="addPicCardHead"
                               class="card-header d-flex justify-content-between" style="text-decoration: none;">
                                Add Picture
                                <span>
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                            <div class="card-body d-none">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="#">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <button class="btn btn-success" type="button" id="addBtn"><i
                                                        class="fas fa-plus"></i> Add
                                            </button>
                                            <button class="btn btn-primary" type="button" id="uploadBtn"><i
                                                        class="fas fa-upload"></i> Upload Picture
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-none">
                        <div class="col-md-4 mb-3 cloned">
                            <div class="card p-2 shadow-sm">
                                <img src="/images/prev_icon.png"
                                     class="img-thumbnail d-block mx-auto img-fluid"
                                     style="width: 100%; height: 200px;">
                                <div class="input-group">
                                    <input type="file" id="fileBtn" name="property_pic" class="form-control">
                                    <button type="button" class="btn btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        @error('property_pic')
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
                            @foreach($property->propertyPicture as $propertyPic)
                                <div class="col-md-4 mb-3">
                                    <div class="card p-2 shadow-sm">
                                        <img src="/properties/{{ $propertyPic->property_pic }}"
                                             class="img-thumbnail d-block mx-auto img-fluid"
                                             style="width: 100%; height: 200px;">
                                        <form action="/user/property/{{ $property->id }}/photo/{{ $propertyPic->id }}"
                                              method="post"
                                              enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @csrf
                                            <input type="file" id="fileBtn" name="property_pic" class="form-control">
                                            <input type="submit" value="Update Picture"
                                                   class="btn btn-primary d-block mx-auto mt-2 mb-3">
                                        </form>
                                        <form action="/user/property/{{ $property->id }}/photo/{{ $propertyPic->id }}"
                                              method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <input class="btn btn-danger mx-auto d-block" value="Delete Pic"
                                                   type="submit">
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function readURL(input, element) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    element.parent().prev().attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on("change", "#fileBtn", function () {
            readURL(this, $(this));
        })
        $("#addBtn").click(function () {
            // console.log($(".d-none > .cloned"));
            $(this).parent().before($(".d-none > .cloned").clone());
            // $(".d-none > .cloned").clone().appendTo($(this).parent().parent());
        })
        $("#addPicCardHead").click(function () {
            $(this).next().toggleClass("d-none");
        })
        $("#uploadBtn").click(function () {
            console.log($(this).parent().prev().hasClass("cloned"));
        })
    </script>
@endsection