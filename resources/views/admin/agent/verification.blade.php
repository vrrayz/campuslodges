@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Agent</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/admin/agent/{{ $agent->id }}">{{ $agent->username }}</a>
            </li>
            <li class="breadcrumb-item active">Verification</li>
        </ol>

        {{--    Verification Details Card    --}}
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Verification Details
                            <hr/>
                        </h5>
                        @if(session('form_success'))
                            <div class="alert alert-success">{{ session('form_success') }}</div>
                        @endif
                        @error('reason')
                        <div class="text-danger text-center my-3 small">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="row">
                            <div class="col-md-6">
                                @if($agent->kyc->id_photo == null || $agent->kyc->id_photo == '' )
                                    <img src="/images/id_sample.png" class="img-fluid d-block mx-auto w-100">
                                @else
                                    <img src="/agents_id/{{ $agent->kyc->id_photo }}"
                                         class="img-fluid d-block mx-auto w-100">
                                @endif
                                <p class="small text-center">
                                    <span class="font-weight-bold">Mode Of Identification</span><br/>
                                    <span class="text-secondary">{{ $agent->kyc->means_of_id }}</span>
                                    <br/><br/>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="small">
                                    <span class="font-weight-bold">State Of Origin</span><br/>
                                    <span class="text-secondary">{{ $agent->state_of_origin }}</span>
                                    <br/><br/>
                                    <span class="font-weight-bold">Local Govt.</span><br/>
                                    <span class="text-secondary">{{ $agent->lga_of_origin }}</span>
                                    <br/><br/>
                                    <span class="font-weight-bold">Hometown</span><br/>
                                    <span class="text-secondary">{{ $agent->hometown }}</span>
                                    <br/><br/>
                                    <span class="font-weight-bold">Residential Address</span><br/>
                                    <span class="text-secondary">{{ $agent->kyc->residential_address }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="text-center">
                            <button onclick="confirmAction()" class="btn btn-lg mx-auto btn-outline-success">Verify Account</button>
                            <button data-toggle="modal" data-target="#rejectionReason"
                                    class="btn btn-lg mx-auto btn-outline-danger">Reject Verification
                            </button>
                        </div>
                        <form action="/admin/agent/{{ $agent->id }}/verification" id="verifyingForm" method="post" style="display: none;">
                            @csrf
                            <input type="hidden" name="action" value="accepted">
                            <input type="hidden" name="reason" value="Your Agent Profile Has Been Validated">
                        </form>
                        <div class="modal fade" id="rejectionReason" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reason for rejection<br/>
                                            <span class="small text-secondary">This will be sent to the agent</span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="/admin/agent/{{ $agent->id }}/verification" method="post">
                                        @csrf
                                        <input type="hidden" name="action" value="rejected">
                                        <div class="modal-body">
                                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"
                                                      placeholder="Sample reason for rejecting verification"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
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
        function confirmAction(){
            if (confirm("Verify this account?") == true){
                document.getElementById("verifyingForm").submit();
            }
        }
    </script>
@endsection