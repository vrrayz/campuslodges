@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Create User</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-user"></i>
                        User Creation Form
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form action="/admin/user" method="post">
                    @csrf
                    <div class="row mx-lg-3">
                        {{--        First Name                --}}
                        <div class="col-md-4 mb-3">
                            <label for="first_name">
                                First Name
                            </label>
                            @error('first_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name"/>
                        </div>
                        {{--        Last Name                --}}
                        <div class="col-md-4 mb-3">
                            <label for="last_name">
                                Last Name
                            </label>
                            @error('last_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name"/>
                        </div>
                        {{--        Username                --}}
                        <div class="col-md-4 mb-3">
                            <label for="username">
                                Username
                            </label>
                            @error('username')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="username" value="{{ old('username') }}" placeholder="Username" required/>
                        </div>
                        {{--        Email Address                --}}
                        <div class="col-md-6 mb-3">
                            <label for="email">
                                Email Address
                            </label>
                            @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="someone@example.com"
                                   required/>
                        </div>
                        {{--        Phone Number                --}}
                        <div class="col-md-6 mb-3">
                            <label for="phone_no">
                                Phone Number
                            </label>
                            @error('phone_no')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="phone_no" value="{{ old('phone_no') }}" placeholder="Phone Number"/>
                        </div>
                        {{--        Password                --}}
                        <div class="col-md-6 mb-3">
                            <label for="password">
                                Password
                            </label>
                            @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="password" name="password" placeholder="Password"/>
                        </div>
                        {{--        Password Confirmation               --}}
                        <div class="col-md-6 mb-3">
                            <label for="password-confirm">
                                Password Confirmation
                            </label>
                            @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Password"/>
                        </div>
                        {{--        Student Option                --}}
                        <div class="col-md-12 mb-3">
                            <label for="is_student">
                                Student?
                            </label>
                            <br/>
                            @error('student')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="student" id="studentRadioBox1"
                                       value="yes">
                                <label class="form-check-label" for="studentRadioBox1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="student" id="studentRadioBox2"
                                       value="no">
                                <label class="form-check-label" for="studentRadioBox2">No</label>
                            </div>
                        </div>

                        {{--          For Students              --}}
                        <div class="for_students col-md-12 mb-3 row">
                            <hr/>
                            {{--        Department                --}}
                            <div class="col-md-3 mb-3">
                                <label for="department">
                                    Department
                                </label>
                                @error('department')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                <input class="form-control" type="text" name="department" value="{{ old('department') }}" placeholder="Department"/>
                            </div>
                            {{--        Reg No                --}}
                            <div class="col-md-3 mb-3">
                                <label for="reg_no">
                                    Registration Number
                                </label>
                                @error('reg_no')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                <input class="form-control" type="text" name="reg_no" value="{{ old('reg_no') }}" placeholder="Reg No"/>
                            </div>
                            {{--        Level                --}}
                            <div class="col-md-3 mb-3">
                                <label for="level">
                                    Level
                                </label>
                                @error('level')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                <input class="form-control" type="text" name="level" value="{{ old('level') }}" placeholder="Level"/>
                            </div>
                            {{--        Programme                --}}
                            <div class="col-md-3 mb-3">
                                <label for="programme">
                                    Programme
                                </label>
                                @error('programme')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                                <select class="form-control" name="programme">
                                    <option value=""></option>
                                    <option value="Jupeb">Jupeb</option>
                                    <option value="Undergraduate">Undergraduate</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Sandwich">Sandwich</option>
                                    <option value="PostGraduate">PostGraduate</option>
                                    <option value="Lecturer">Lecturer</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>

                        {{--       State Of Origin               --}}
                        <div class="col-md-4 mb-3">
                            <label for="state_of_origin">
                                State Of Origin
                            </label>
                            @error('state_of_origin')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="state_of_origin"
                                   value="{{ old('state_of_origin') }}" placeholder="State Of Origin"/>
                        </div>
                        {{--        L.G.A                --}}
                        <div class="col-md-4 mb-3">
                            <label for="L_G_A">
                                Local Govt. Area
                            </label>
                            @error('L_G_A')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="L_G_A" value="{{ old('L_G_A') }}" placeholder="Local Govt. Area"/>
                        </div>
                        {{--        Hometown                --}}
                        <div class="col-md-4 mb-3">
                            <label for="hometown">
                                Hometown
                            </label>
                            @error('hometown')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <input class="form-control" type="text" name="hometown" value="{{ old('hometown') }}" placeholder="Hometown"/>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <input class="btn btn-primary" value="Create User Account" type="submit">
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $('.for_students').hide();
        $('input[name="student"]').change(function () {
            if ($(this).val() == 'yes') {
                $('.for_students').show();
            } else {
                $('.for_students').hide();
            }
        })
    </script>
@endsection