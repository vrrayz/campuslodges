@extends('layouts.app')
@section('extra-styles')
    <style>
        .info-card{
            /*background-image: linear-gradient(45deg, #E5B000, #E5B000 15%, #BF0B0C 15%, #BF0B0C);*/
            background-color: #BF0B0C;
            border: transparent;
        }
        /*.step-cards{*/
        /*    position: relative;*/
        /*    background-color: #BF0B0C;*/
        /*    display: inline-block;*/
        /*    padding: 4px 16px;*/
        /*    color: #fff;*/
        /*    z-index: 2;*/
        /*}*/
        /*.step-cards:after{*/
        /*    content: '';*/
        /*    background-color: #BF0B0C;*/
        /*    position: absolute;*/
        /*    top: 0;*/
        /*    right:-22px;*/
        /*    width: 50px;*/
        /*    height: 100%;*/
        /*    transform: skew(45deg);*/
        /*    z-index: -1;*/
        /*}*/
        .btn-danger:hover{
            background-color: #D20B0E !important;
        }
    </style>
@endsection
@section('main')
    <div class="container mb-3">
        <br/>
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="py-3 font-weight-bold mb-3" style="border-bottom: 2px solid #ddd;"> <span style="color: #BF0B0C" class="">Campuslodges</span> Agent</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center text-secondary">
                            Fill in your personal information in order to register and become a Campuslodges consultant.
                        </h5>
                        <div class="col-md-8 mx-auto">
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
                                <button type="submit" class="btn btn-danger btn-block shadow" style="background-color: #BF0B0C">Create Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--@section('scripts')--}}
{{--    <script src="/js/index_page.js">--}}
{{--    </script>--}}
{{--    <script src="/js/flag_and_save.js">--}}
{{--    </script>--}}
{{--@endsection--}}