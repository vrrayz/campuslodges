@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-search"></i>
                       Search Result
                    </div>
{{--                    <div>--}}
{{--                        <a href="/admin/users/create" class="btn btn-primary"><i class="fas fa-plus"></i> Create User</a>--}}
{{--                    </div>--}}
                </div>

            </div>
            <div class="card-body">
                @if(count($users) == 0)
                    <h5 class="font-weight-bold text-center">
                        No user with the credential of {{ $result }} exist
                    </h5>
                @endif
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