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
                        Account Overview
                    </h4>
                    @if(session('update_success'))
                    <div class="alert alert-success">
                        {{ session('update_success') }}
                    </div>
                    @endif
                    @if(session('v_agent_error'))
                    <div class="alert alert-warning">
                        {{ session('v_agent_error') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-header bg-transparent d-flex justify-content-between">
                                    <span class="h6 mt-1">Profile picture</span>
                                    <a href="/user/picture/edit" class="text-site">
                                        <i class="fas fa-camera fa-2x"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    @if(auth()->user()->profilePicture->picture_name == '')
                                    <div class="text-center">
                                        <i class="fas fa-user fa-6x"></i>
                                    </div>
                                    @else
                                    <img src="/profile/{{auth()->user()->profilePicture->picture_name }}"
                                        alt="Profile Picture" class="img-fluid d-block mx-auto rounded-circle"
                                        width="200">
                                    @endif
                                    {{--                                        <a href="{{ route('changepass') }}"
                                    class="btn btn-outline-site small text-uppercase" style="border:0;">Change
                                    Password</a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-header bg-transparent d-flex justify-content-between">
                                    <span class="h6 mt-1">Account Details</span>
                                    <a href="/user/account/edit" class="text-site">
                                        <i class="fas fa-pencil-alt fa-1x"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-uppercase ml-3">{{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}
                                        <br>
                                        <span
                                            class="small text-lowercase text-secondary">{{ auth()->user()->email }}</span>
                                    </p>
                                    <a href="{{ route('changepass') }}"
                                        class="btn btn-outline-site small text-uppercase" style="border:0;">Change
                                        Password</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-header bg-transparent d-flex justify-content-between">
                                    <span class="h6 mt-1">Personal Information</span>
                                    <a href="/user/address/edit" class="text-site">
                                        <i class="fas fa-pencil-alt fa-1x"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="list-group-flush px-0">
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                Programme:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->programme == null || auth()->user()->programme == '')? 'None':auth()->user()->programme }}
                                            </span>
                                        </div>
                                        @if(auth()->user()->programme != 'Jupeb')
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                Department:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->level != '' || auth()->user()->level !=null) ? ' l':'None' }}
                                            </span>
                                        </div>
                                        @endif
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                Reg No:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->reg_no == null || auth()->user()->reg_no == '')? 'None':auth()->user()->reg_no }}
                                            </span>
                                        </div>
                                        {{--  State Of Origin  --}}
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                State Of Origin:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->state_of_origin == null || auth()->user()->state_of_origin == '')? 'None':auth()->user()->state_of_origin }}
                                            </span>
                                        </div>
                                        {{--  L G A  --}}
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                L G A:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->lga_of_origin == null || auth()->user()->lga_of_origin == '')? 'None':auth()->user()->lga_of_origin }}
                                            </span>
                                        </div>
                                        {{--  Hometown  --}}
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                Hometown:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->hometown == null || auth()->user()->hometown == '')? 'None':auth()->user()->hometown }}
                                            </span>
                                        </div>
                                        {{--  Residential Address  --}}
                                        <div class="list-group-item d-flex px-0 justify-content-start"
                                            style="font-size:.9em;">
                                            <span>
                                                Residential Address:
                                            </span>
                                            <span class="font-weight-bold pl-2">
                                                {{ (auth()->user()->kyc->residential_address == null || auth()->user()->kyc->residential_address == '')? 'None':auth()->user()->kyc->residential_address }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            @if(auth()->user()->is_agent != 1)
                            <button type="button" class="btn d-block mt-4 btn-site"
                                onclick="document.getElementById('agentForm').submit()">Apply to be an agent
                            </button>
                            <form action="/user/agent/application" id="agentForm" method="post" style="display: none;">
                                @csrf
                            </form>
                            @else
                            <div class="card">
                                <div class="card-header bg-transparent d-flex justify-content-between">
                                    <span class="h6 mt-1">Verification Details</span>
                                    <a href="/agent/kyc" class="text-site">
                                        <i class="fas fa-pencil-alt fa-1x"></i>
                                    </a>
                                </div>
                                <div class="card-body">
                                    @if(auth()->user()->kyc->is_validated)
                                    <div class="text-success small">
                                        Verified
                                    </div>
                                    @else
                                    <div class="text-site small">
                                        Verification Pending
                                    </div>
                                    @endif

                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection