@extends('layouts.app')
@section('main')
    <div class="container">
        <div class="row d-lg-none shadow-sm">
            <div class="col-6 text-center active-tab pt-2 pb-1">
                <a href="#" class="text-site tab-link">Login</a>
            </div>
            <div class="col-6 text-center pt-2 pb-1">
                <a href="/register" class="text-secondary tab-link">Create Account</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 px-5 mt-lg-5">
                <div class="mx-lg-5 px-lg-5">
                    <div class="text-center d-none d-lg-block text-default-head">
                        <h5>Login</h5>
                    </div>
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-group">
                            @error('email')
                            <div class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control bg-transparent border-bottom-1" name="email"
                                   id="email">
                        </div>
                        <div class="form-group mb-3">
                            @error('password')
                            <div class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control bg-transparent border-bottom-1" name="password"
                                   id="password">
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <input type="checkbox" value="remember" name="remember"> <span
                                        class="small">Remember Me</span>
                            </div>
                            <a href="#" class="text-site small">Forgot Your Password?</a>
                        </div>
                        <button type="submit" class="btn btn-site btn-block shadow">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block px-5 mt-5" style="border-left: .5px solid #aaa;">
                <div class="mx-md-5 px-md-5">
                    <div class="text-center text-default-head mb-5">
                        <h5>Sign Up!</h5>
                    </div>
                    <p class="mb-5">
                        Create your CampusLodges customer account in just a few clicks! Its a very easy and all you need
                        to create your own account is an e-mail address.
                    </p>
                    <div class="mt-5 pt-5">
                        <a href="/register" class="btn btn-site btn-block shadow">Sign Up
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection