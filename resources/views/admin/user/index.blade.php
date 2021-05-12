@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">View User</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-user"></i>
                        User Profile
                    </div>
                    @if($user->is_agent != 1)
                        <button class="btn btn-primary" id="makeUserAgentBtn">
                            Make User Agent
                        </button>
                    @endif


                    <form action="/admin/user/{{$user->id}}/make_agent" id="makeUserAgentForm" method="post" style="display: none;">
                        @csrf
                    </form>
                </div>

            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body small">
                            @if(session('update_success'))
                                <div class="alert alert-success small">
                                    {{ session('update_success') }}
                                </div>
                            @endif
                            <img src="/images/user_icon.png" class="img-fluid d-block mx-auto">
                            <div class="text-center">
                                <p class="font-weight-bold">
                                    <span style="font-size: 20px">{{ $user->name }}</span> <a href="/admin/user/{{ $user->id }}/edit"><i class="fa fa-pencil fa-2x text-primary"></i></a><br/>
                                    <span class="text-secondary small"> {{ $user->email }}</span>
                                </p>
                            </div>
                            <hr/>
                            <h5>Bio:</h5>
                            <div class="list-group-flush">
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        First Name:
                                    </span>
                                    <span>
                                        {{ $user->first_name }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Last Name:
                                    </span>
                                    <span>
                                        {{ $user->last_name }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Email:
                                    </span>
                                    <span>
                                        {{ $user->email }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Phone No:
                                    </span>
                                    <span>
                                        {{ $user->phone_no }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        State:
                                    </span>
                                    <span>
                                        {{ $user->state_of_origin }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        L.G.A:
                                    </span>
                                    <span>
                                        {{ $user->lga_of_origin }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Hometown:
                                    </span>
                                    <span>
                                        {{ $user->hometown }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Student:
                                    </span>
                                    <span>
                                        @if($user->is_student == '1')
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Department:
                                    </span>
                                    <span>
                                        {{ $user->department }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Level:
                                    </span>
                                    <span>
                                        {{ $user->level }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Reg No:
                                    </span>
                                    <span>
                                        {{ $user->reg_no }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Programme:
                                    </span>
                                    <span>
                                        {{ $user->programme }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Occupation:
                                    </span>
                                    <span>
                                        {{ $user->occupation_description }}
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Agent:
                                    </span>
                                    <span>
                                        @if($user->is_agent == '1')
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold mr-3">
                                        Admin:
                                    </span>
                                    <span>
                                        @if($user->is_admin == '1')
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
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
        $('#makeUserAgentBtn').click(function () {
            if (confirm('Do you want to make this user an agent') == true){
                document.getElementById('makeUserAgentForm').submit();
            }

        })
    </script>
@endsection