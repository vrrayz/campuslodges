@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div id="lodgeCarousel{{ $lodge->id }}" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $count = 0
                            ?>
                            @foreach($lodge->lodgePicture as $lodgePic)
                                @if($count == 0)
                                    <li data-target="#lodgeCarousel{{ $lodge->id }}"
                                        data-slide-to="{{ $count }}"
                                        class="active"></li>
                                @else
                                    <li data-target="#lodgeCarousel{{ $lodge->id }}"
                                        data-slide-to="{{ $count }}"></li>
                                @endif
                                <?php $count++ ?>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $count = 0
                            ?>
                            @foreach($lodge->lodgePicture as $lodgePic)
                                @if($count == 0)
                                    <div class="carousel-item active">
                                        <img class="d-block card-img-top"
                                             src="/house_images/{{ $lodgePic->lodge_pic }}"
                                             style="width: 100%;" height="250" alt="slides">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="d-block card-img-top"
                                             src="/house_images/{{ $lodgePic->lodge_pic }}"
                                             style="width: 100%;" height="250" alt="slides">
                                    </div>
                                @endif
                                <?php $count++ ?>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev" role="button"
                           href="#lodgeCarousel{{ $lodge->id }}" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" role="button" href="#lodgeCarousel{{ $lodge->id }}"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="card-body px-2">
                        <div class="">
                            <h5 class="card-title text-center">{{ $lodge->type }} at {{ $lodge->location }}</h5>
                            <h6 class="text-center">
                                <i class="fas fa-eye mt-1 mr-2"></i> {{ $lodge->view_count }}
                                <?php $saved = false; ?>
                                @foreach(auth()->user()->savedLodge as $saveLodge)
                                    @if($saveLodge->lodge_id == $lodge->id)
                                        <?php $saved = true;?>
                                        @break
                                    @endif
                                @endforeach
                                <a href="javascript:void(0)"
                                   class="@if($saved) {{ 'text-danger' }} @else {{ 'text-dark' }}@endif ml-2 mr-2"
                                   style="text-decoration: none;" id="saveBtn" data-content="{{ $lodge->id }}">
                                    <i class="@if($saved) {{ 'fas' }} @else {{ 'far' }}@endif fa-heart mt-1 mr-2"></i>
                                </a>
                            </h6>
                            <div class="list-group-flush">
                                <div class="list-group-item">
                                    <span class="font-weight-bold">Description:</span> {{ $lodge->description }}
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold">Vicinity:</span> {{ $lodge->vicinity }} campus
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold">Who can rent:</span> {{ $lodge->who_can_rent }}
                                </div>
                                @if($lodge->who_can_rent != 'Jupeb')
                                    <div class="list-group-item">
                                        <span class="font-weight-bold">Department:</span> {{ $lodge->department }}
                                    </div>
                                    <div class="list-group-item">
                                        <span class="font-weight-bold">Level:</span> {{ $lodge->level }} {{ ($lodge->level == 'Unavailable' || $lodge->level == 'All') ? '':'level' }}
                                    </div>
                                @endif
                                <div class="list-group-item">
                                    <span class="font-weight-bold">Price:</span>
                                    &#8358;{{ number_format($lodge->price) }}
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold">Rules:</span>
                                    <ul>
                                        @if(count($lodge->lodgeRule) == 0)
                                            No rules posted
                                        @endif
                                        @foreach($lodge->lodgeRule as $lodgeRule)
                                            <li>
                                                {{ $lodgeRule->rule }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="list-group-item">
                                    <span class="font-weight-bold">Uploaded: </span>
                                    <span>
                                        {{ $lodge->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 my-3">
                                    <a class="btn btn-site shadow-sm py-2 text-light d-block mx-3" id="requestVisitBtn">
                                        Request a visit
                                    </a>
                                </div>
                                <div class="col-md-6 my-3">
                                    <a class="btn btn-dark py-2 shadow-sm text-light d-block mx-3">
                                        Request a visit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="requestVisitSuccessModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                        <p>Your request has been sent please call the following numbers</p>
                    </div>
                    <ul id="admin_numbers">

                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $("body").on("click", "#saveBtn", function () {
            var btn = $(this);
            $.ajax({
                url: '/user/lodge/save/' + $(this).attr('data-content'),
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    btn.children("i").first().toggleClass("far");
                    btn.children("i").first().toggleClass("fas");
                    btn.toggleClass("text-dark");
                    btn.toggleClass("text-danger");
                    // console.log(data.message);
                }
            })
        })
        $('#requestVisitBtn').click(function () {
            $.ajax({
                url: '/user/request_visit/{{ $lodge->id }}',
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    $('#admin_numbers').empty();
                    $.each(data.message,function (key,value) {
                        $('#admin_numbers').append('<li>'+value.phone_no+'</li>')
                    })
                    $('#requestVisitSuccessModal').modal()
                },
                error: function () {
                }
            })
        })
    </script>
@endsection
