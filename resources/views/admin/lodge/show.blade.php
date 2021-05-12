@extends('layouts.admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin/lodges">Lodges</a>
            </li>
            <li class="breadcrumb-item active">Lodge</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <i class="fas fa-home"></i>
                        Lodge Detail
                    </div>
                    <div>
                        Uploaded by
                        <a href="/admin/user/{{ $lodge->user->id }}"
                           class="font-weight-bold">{{ $lodge->user->username }}</a>

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
                                    @foreach($lodge->lodgePicture as $lodgePic)
                                        <li data-target="#houseCarousel" data-slide-to="{{ $count }}"
                                            class="@if($count == 0) {{ 'active' }}@endif"></li>
                                        <?php $count++ ?>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    <?php
                                    $count = 0
                                    ?>
                                    @foreach($lodge->lodgePicture as $lodgePic)
                                        <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                            <img class="d-block card-img-top"
                                                 src="/house_images/{{ $lodgePic->lodge_pic }}"
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
                                        {{ $lodge->description }}
                                    </span>
                                </div>
                                {{--                Location                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Location:
                                    </span>
                                    <span>
                                        {{ $lodge->location }}
                                    </span>
                                </div>
                                {{--                Vicinity                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Vicinity:
                                    </span>
                                    <span>
                                        {{ $lodge->vicinity }}
                                    </span>
                                </div>
                                {{--                Type                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Type:
                                    </span>
                                    <span>
                                        {{ $lodge->type }}
                                    </span>
                                </div>
                                {{--                Who Can Rent                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Who Can Rent:
                                    </span>
                                    <span>
                                        {{ $lodge->who_can_rent }}
                                    </span>
                                </div>
                                {{--                Price                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="font-weight-bold">
                                        Price:
                                    </span>
                                    <span>
                                        &#8358; {{ number_format($lodge->price) }}
                                    </span>
                                </div>

                            </div>
                            <div class="text-center">
                                <button onclick="confirmAction()" class="btn btn-lg mx-auto btn-outline-success">Verify
                                    Lodge
                                </button>
                                <button data-toggle="modal" data-target="#rejectionReason"
                                        class="btn btn-lg mx-auto btn-outline-danger">Reject Lodge
                                </button>
                                <form action="/admin/lodges/{{ $lodge->id }}/verification" method="post"
                                      id="approvalForm" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="action" value="approved">
                                    <input type="hidden" name="reason" value="Lodge has been approved">
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
                <form action="/admin/lodges/{{ $lodge->id }}/verification" method="post">
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
            if (confirm("Do you want to approve this lodge?") == true) {
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