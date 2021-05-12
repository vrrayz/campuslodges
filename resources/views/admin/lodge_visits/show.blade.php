@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin/requests">Requests</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/admin/requests/lodge_visits">Lodge Visit Requests</a>
            </li>
            <li class="breadcrumb-item active">
                #{{ $visit_request->id }}
            </li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-users"></i>
                        Lodge Visit Request List
                    </div>
                    <div>
{{--                        <a href="{{ back() }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back</a>--}}
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <img src="/house_images/{{ $lodge_picture }}" class="img-fluid d-block w-100 card-img-top" style="height: 200px;">
                        <div class="card-body">
                            <div class="text-center mb-2">
                                <h5 class="card-title mb-1">{{ $lodge_title }}</h5>
                                <p class="small card-text text-secondary">posted by <a href="/admin/user/{{$lodge_agent_id}}">{{ $lodge_agent }}</a></p>
                            </div>
                            <p class="text-left small card-text">Request from <a href="/admin/user/{{$user_id}}">{{ $username }}</a></p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="/admin/lodges/{{ $visit_request->lodge->id }}" class="btn btn-primary">View this lodge</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

    </div>
@endsection