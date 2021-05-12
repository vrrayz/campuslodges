@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/properties">Properties</a>
            </li>
            <li class="breadcrumb-item active">{{ ucwords($property->name) }}</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-home"></i>
                        Property Detail
                    </div>
                    <div>
                        Uploaded by
                        <a href="/admin/user/{{ $property->user->id }}"
                           class="font-weight-bold">{{ $property->user->username }}</a>

                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="col-md-9 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if(session('form_success'))
                                <div class="alert alert-success small">
                                    {{ session('form_success') }}
                                </div>
                            @endif
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php
                                    $count = 0
                                    ?>
                                    @foreach($property->propertyPicture as $propertyPic)
                                        <li data-target="#houseCarousel" data-slide-to="{{ $count }}"
                                            class="@if($count == 0) {{ 'active' }}@endif"></li>
                                        <?php $count++ ?>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    <?php
                                    $count = 0
                                    ?>
                                    @foreach($property->propertyPicture as $propertyPic)
                                        <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                            <img class="d-block card-img-top"
                                                 src="/properties/{{ $propertyPic->property_pic }}"
                                                 style="width: 100%;" height="200" alt="First slide">
                                        </div>
                                        <?php $count++ ?>
                                    @endforeach
                                </div>
                            </div>
                            <div class="list-group-flush mb-3">
                                {{--                Description                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Description:
                                    </span>
                                    <span>
                                        {{ $property->description }}
                                    </span>
                                </div>
                                {{--                Name                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Property Name:
                                    </span>
                                    <span>
                                        {{ $property->name }}
                                    </span>
                                </div>
                                {{--                Category                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Category:
                                    </span>
                                    <span>
                                        {{ $property->category }}
                                    </span>
                                </div>
                                {{--                Condition                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Condition:
                                    </span>
                                    <span>
                                        {{ $property->condition }}
                                    </span>
                                </div>
                                {{--                Approval Status                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Approval Status:
                                    </span>
                                    <span>
                                        {{ $property->approval_status }}
                                    </span>
                                </div>
                                {{--                Price                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Price:
                                    </span>
                                    <span>
                                        &#8358; {{ number_format($property->amount) }}
                                    </span>
                                </div>

                            </div>
                            <div class="text-center">
                                <button onclick="confirmAction()" class="btn btn-lg mx-auto btn-outline-success">Verify
                                    Property
                                </button>
                                <button data-toggle="modal" data-target="#rejectionReason"
                                        class="btn btn-lg mx-auto btn-outline-danger">Reject Property
                                </button>
                                <form action="/admin/properties/{{ $property->id }}/verification" method="post"
                                      id="approvalForm" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="action" value="approved">
                                    <input type="hidden" name="reason" value="Property has been approved">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="rejectionReason" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason for rejection<br/>
                        <span class="small text-secondary">This will be sent to the agent</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/properties/{{ $property->id }}/verification" method="post">
                    @csrf
                    <input type="hidden" name="action" value="rejected">
                    <div class="modal-body">
                                            <textarea name="reason" id="" cols="30" rows="10" class="form-control"
                                                      placeholder="Sample reason for rejecting verification"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        function confirmAction() {
            if (confirm("Do you want to approve this property?") == true) {
                document.getElementById("approvalForm").submit();
            }
        }

        $('.for_students').hide();
        $('input[name="student"]').change(function () {
            if ($(this).val() == 'yes') {
                $('.for_students').show();
            } else {
                $('.for_students').hide();
            }
        })
        $('#makeUserAgentBtn').click(function () {
            if (confirm('Do you want to make this user an agent') == true) {
                document.getElementById('makeUserAgentForm').submit();
            }

        })
    </script>
@endsection