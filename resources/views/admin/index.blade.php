@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
{{--        <div class="row">--}}
{{--            <div class="col-xl-3 col-sm-6 mb-3">--}}
{{--                <div class="card text-white bg-primary o-hidden h-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-body-icon">--}}
{{--                            <i class="fas fa-fw fa-comments"></i>--}}
{{--                        </div>--}}
{{--                        <div class="mr-5">26 New Messages!</div>--}}
{{--                    </div>--}}
{{--                    <a class="card-footer text-white clearfix small z-1" href="#">--}}
{{--                        <span class="float-left">View Details</span>--}}
{{--                        <span class="float-right">--}}
{{--                  <i class="fas fa-angle-right"></i>--}}
{{--                </span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-sm-6 mb-3">--}}
{{--                <div class="card text-white bg-warning o-hidden h-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-body-icon">--}}
{{--                            <i class="fas fa-fw fa-list"></i>--}}
{{--                        </div>--}}
{{--                        <div class="mr-5">11 New Tasks!</div>--}}
{{--                    </div>--}}
{{--                    <a class="card-footer text-white clearfix small z-1" href="#">--}}
{{--                        <span class="float-left">View Details</span>--}}
{{--                        <span class="float-right">--}}
{{--                  <i class="fas fa-angle-right"></i>--}}
{{--                </span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-sm-6 mb-3">--}}
{{--                <div class="card text-white bg-success o-hidden h-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-body-icon">--}}
{{--                            <i class="fas fa-fw fa-shopping-cart"></i>--}}
{{--                        </div>--}}
{{--                        <div class="mr-5">123 New Orders!</div>--}}
{{--                    </div>--}}
{{--                    <a class="card-footer text-white clearfix small z-1" href="#">--}}
{{--                        <span class="float-left">View Details</span>--}}
{{--                        <span class="float-right">--}}
{{--                  <i class="fas fa-angle-right"></i>--}}
{{--                </span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-xl-3 col-sm-6 mb-3">--}}
{{--                <div class="card text-white bg-danger o-hidden h-100">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-body-icon">--}}
{{--                            <i class="fas fa-fw fa-life-ring"></i>--}}
{{--                        </div>--}}
{{--                        <div class="mr-5">13 New Tickets!</div>--}}
{{--                    </div>--}}
{{--                    <a class="card-footer text-white clearfix small z-1" href="#">--}}
{{--                        <span class="float-left">View Details</span>--}}
{{--                        <span class="float-right">--}}
{{--                  <i class="fas fa-angle-right"></i>--}}
{{--                </span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-users"></i>
                        Users List
                    </div>
                    <div>
                        <a href="/admin/users/create" class="btn btn-primary"><i class="fas fa-plus"></i> Create User</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="list-group-flush">
                    @foreach($users as $user)
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="font-weight-bold">{{ $user->name }}</span><br/>
                                    <span class="font-weight-bold">{{ $user->username }}</span><br/>
                                    <span class="font-weight-bold">{{ $user->email }}</span><br/>
                                    <span class="font-weight-bold">{{ $user->phone_no }}</span><br/>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <span>
                                        <a href="/admin/user/{{ $user->id }}" class="mx-2 bg-info p-1 text-light">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="/admin/user/{{ $user->id }}/edit"
                                           class="mx-2 bg-primary p-1 text-light">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $users->links() }}
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

    </div>
@endsection