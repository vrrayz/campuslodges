@extends('layouts.app')
@section('main')
    <div class="container">
        {{--    Mobile Top Nav    --}}
        <div class="row d-lg-none shadow-sm">
            <div class="col-6 text-center pt-2 pb-1">
                <a href="/login" class="text-secondary tab-link">Login</a>
            </div>
            <div class="col-6 text-center active-tab pt-2 pb-1">
                <a href="#" class="text-site tab-link">Create Account</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 px-5 mt-lg-5 mx-auto">
                <div class="mx-lg-5 px-lg-5">
                    <div class="text-center d-none d-lg-block text-default-head">
                        <h5>Create your CampusLodges Account</h5>
                    </div>
                    @if(count($errors))
                        <div class="alert alert-danger py-1">
                            <ul style="list-style-type: none;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/register" method="post">
                        @csrf
                        <div class="row">
                            {{--            First Name                  --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="first-name">First Name</label>
                                    <input type="text" class="form-control bg-transparent border-bottom-1" name="first_name"
                                           id="first-name">
                                </div>
                            </div>
                            {{--            Last Name                  --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="last-name">Last Name</label>
                                    <input type="text" class="form-control bg-transparent border-bottom-1" name="last_name"
                                           id="last-name">
                                </div>
                            </div>
                            {{--            Username                  --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" class="form-control bg-transparent border-bottom-1" name="username"
                                           id="username">
                                </div>
                            </div>
                            {{--            Email                  --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control bg-transparent border-bottom-1" name="email"
                                           id="email">
                                </div>
                            </div>
                            {{--            Phone Number                  --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="phoneNo">Phone Number(+234)</label>
                                    <input type="number" class="form-control bg-transparent border-bottom-1" name="phone_no"
                                           id="phoneNo">
                                </div>
                            </div>
                            {{--            Password                  --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control bg-transparent border-bottom-1" name="password"
                                           id="password">
                                </div>
                            </div>
                            {{--            Confirm Password                  --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="cpassword">Confirm Password</label>
                                    <input type="password" class="form-control bg-transparent border-bottom-1" name="password_confirmation"
                                           id="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <input type="checkbox" value="remember" name="remember"> <span
                                        class="small">Remember Me</span>
                            </div>
                            <a href="#" class="text-site small">Forgot Your Password?</a>
                        </div>
                        <button type="submit" class="btn btn-site btn-block shadow">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection