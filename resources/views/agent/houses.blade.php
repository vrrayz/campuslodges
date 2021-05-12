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
                                <h3>No Houses Uploaded Yet</h3>
                            </div>
                        @endif
                        <div class="row">
                            @foreach($lodges as $lodge)
                                <div class="col-lg-4 col-md-6 mb-3">
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
                                                @elseif($lodge->availability == 'available') {{ 'text-success' }} @endif">
                                                    {{ $lodge->availability }}
                                                </span>
                                            </div>
                                            <hr/>
                                            <a href="/agent/house/{{ $lodge->id }}" class="btn btn-site d-block mx-auto">Manage Lodge</a>
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