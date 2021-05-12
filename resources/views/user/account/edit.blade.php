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
                        @if(session('phone_error'))
                            <div class="text-danger small">
                                {{ session('phone_error') }}
                            </div>
                        @endif
                        <form action="/user/account/edit" method="post">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row mx-3">
                                {{--            First Name                  --}}
                                <div class="col-md-6">
                                    <div class="form-group focused">
                                        <label class="form-label" for="first-name">First Name</label>
                                        <input type="text" class="form-control bg-transparent border-bottom-1 filled" name="first_name"
                                               id="first-name" value="{{ auth()->user()->first_name }}">
                                    </div>
                                </div>
                                {{--            Last Name                  --}}
                                <div class="col-md-6">
                                    <div class="form-group focused">
                                        <label class="form-label" for="last-name">Last Name</label>
                                        <input type="text" class="form-control bg-transparent border-bottom-1 filled" name="last_name"
                                               id="last-name" value="{{ auth()->user()->last_name }}">
                                    </div>
                                </div>
                                {{--            Email                  --}}
                                <div class="col-md-6">
                                    <div class="form-group focused">
                                        <label class="form-label" style="color: #888;" for="email">Email</label>
                                        <input type="text" class="form-control bg-transparent border-bottom-1 filled" name="email"
                                               id="email" value="{{ auth()->user()->email }}" style="border-color: #eee;" disabled>
                                    </div>
                                </div>
                                {{--            Phone Number                  --}}
                                <div class="col-md-6">
                                    <div class="form-group focused">
                                        <label class="form-label" for="phone_no">Phone Number</label>
                                        <input type="text" class="form-control bg-transparent border-bottom-1 filled" name="phone_no"
                                               id="phone_no" value="{{ auth()->user()->phone_no }}">
                                    </div>
                                </div>
                                {{--            Gender                  --}}
                                <div class="col-md-6 mx-auto">
                                    <div class="form-group focused">
                                        <label class="form-label" for="gender">Gender</label>
                                        <select class="form-control bg-transparent border-bottom-1 filled" name="gender" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
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