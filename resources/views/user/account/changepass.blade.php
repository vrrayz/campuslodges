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
                            Change Password
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
                        @if(session('wrong_password'))
                            <div class="alert alert-danger">
                                {{ session('wrong_password') }}
                            </div>
                        @endif
                        <form action="/user/account/changepass" method="post">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row mx-3">
                                {{--            Current Password                  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="current_password">Current Password</label>
                                        <input type="password" class="form-control bg-transparent border-bottom-1" name="current_password"
                                               id="current_password" >
                                    </div>
                                </div>
                                {{--            Empty Field                  --}}
                                <div class="col-md-6">
                                </div>
                                {{--            New Password                  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="password">New Password</label>
                                        <input type="password" class="form-control bg-transparent border-bottom-1" name="password"
                                               id="password" >
                                    </div>
                                </div>
                                {{--            Empty Field                  --}}
                                <div class="col-md-6">
                                </div>
                                {{--            Retype Password                  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="password_confirmation">Retype Password</label>
                                        <input type="password" class="form-control bg-transparent border-bottom-1" name="password_confirmation"
                                               id="password_confirmation" >
                                    </div>
                                </div>
                                {{--            Empty Field                  --}}
                                <div class="col-md-6">
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