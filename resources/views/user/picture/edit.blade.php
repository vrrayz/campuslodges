@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--    Sidebar        --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mt-2 font-weight-normal">
                            Details
                        </h4>
                        @if(count($errors))
                            <div class="alert alert-danger py-1">
                                <ul style="list-style-type: none;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/user/picture/edit" method="post" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row mb-3 mx-3">
                                {{--            Profile Picture                  --}}
                                <div class="col-md-6 mx-auto">
                                    @if(auth()->user()->profilePicture->picture_name == '')
                                        <img src="\images\user_icon.png" id="picture" alt="Profile Picture"
                                             class="img-fluid d-block mx-auto" width="200" height="250" style="border-radius: 50%;">
                                    @else
                                        <img src="\profile\{{ auth()->user()->profilePicture->picture_name }}" id="picture" alt="Profile Picture"
                                             class="img-fluid d-block mx-auto" width="200" height="250" style="border-radius: 50%;">

                                    @endif
                                    <input type="file" name="profile_picture" class="form-control" id="pic_select">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-site btn-block shadow">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#picture').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#pic_select").change(function () {
            readURL(this);
        });
    </script>
@endsection