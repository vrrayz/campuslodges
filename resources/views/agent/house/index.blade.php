@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9">
                <div class="mt-3 mb-3 pb-2">
                    <div class="px-2">
                        @if(count($lodges) == 0)
                            <div class="text-center font-weight-bold">
                                <h5>No Lodge </h5>
                            </div>
                        @endif
                        @if(session('update_success'))
                            <div class="alert alert-success">
                                {{ session('update_success') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach($lodges as $lodge)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php
                                                $count = 0
                                                ?>
                                                @foreach($lodge->lodgePicture as $lodgePic)
                                                    <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                                        <img class="d-block card-img-top"
                                                             src="/house_images/{{ $lodgePic->lodge_pic }}"
                                                             style="width: 100%;" height="150" alt="First slide">
                                                    </div>
                                                    <?php $count++ ?>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $lodge->location }} {{ $lodge->type }}</h5>
                                            <div class="card-text m-0 p-0 d-flex justify-content-between">
                                                <span>For:</span>
                                                <span>{{ $lodge->department }} {{ $lodge->level }}</span></div>
                                            <div class="card-text d-flex justify-content-between">
                                                <span>Status:</span>
                                                <span class="@if($lodge->approval_status == 'pending') {{ 'text-warning' }}
                                                @elseif($lodge->approval_status == 'approved') {{ 'text-success' }} @endif">
                                                    {{ $lodge->approval_status }}
                                                </span>
                                            </div>
                                            <div class="card-text d-flex justify-content-between">
                                                <span>Availability:</span>
                                                <span class="@if($lodge->availability == 'unavailable') {{ 'text-warning' }}
                                                @elseif($lodge->availability == 'expired') {{ 'text-danger' }}
                                                @elseif($lodge->availability == 'available') {{ 'text-success' }} @endif">
                                                    {{ $lodge->availability }}
                                                </span>
                                            </div>
                                            <hr/>
                                            <a href="/agent/house/{{ $lodge->id }}"
                                               class="btn btn-site d-block mx-auto mb-2">Manage Lodge</a>
                                            @if($lodge->approval_status == 'approved' && $lodge->availability == 'unavailable')
                                                <button class="btn btn-success btn-block mx-auto" id="pushBtn"
                                                        data-toggle="tooltip" title="Push lodge online">
                                                    Publish
                                                </button>
                                            @elseif($lodge->approval_status == 'approved' && $lodge->availability == 'available')
                                                <button class="btn btn-danger btn-block mx-auto" id="pullBtn"
                                                        data-toggle="tooltip" title="Push lodge online">
                                                    Pull Down
                                                </button>
                                            @endif
                                            <form style="display: none;" id="push{{ $lodge->id }}"
                                                  action="/agent/push/{{ $lodge->id }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                            </form>
                                            <form style="display: none;" id="pull{{ $lodge->id }}"
                                                  action="/agent/pull/{{ $lodge->id }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("body").on("click", "#pushBtn", function () {
            if (confirm("Publish this lodge online") == true){
                $(this).next().submit();
            }
        })
        $("body").on("click", "#pullBtn", function () {
            if (confirm("Pull down this lodge") == true){
                $(this).next().next().submit();
            }
        })
    </script>
@endsection