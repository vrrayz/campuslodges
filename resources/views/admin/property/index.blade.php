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
        <div class="card px-3 py-3" style="border: none;">
            <div class="card-body">
                <h5 class="text-center card-title">All Lodges</h5>
                <div class="row">
                    @foreach($properties as $property)
                        <div class="col-lg-3 col-md-4 mb-3">
                            <div id="lodgeCarousel{{ $property->id }}" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php
                                    $count = 0
                                    ?>
                                    @foreach($property->propertyPicture as $propertyPic)
                                        <li data-target="#lodgeCarousel{{ $property->id }}"
                                            data-slide-to="{{ $count }}"
                                            class="{{ ($count == 0)? 'active':'' }}"></li>
                                        <?php $count++ ?>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    <?php
                                    $count = 0
                                    ?>
                                    @foreach($property->propertyPicture as $propertyPic)
                                        <div class="carousel-item {{ ($count == 0)? 'active':'' }}">
                                            <img class="d-block card-img-top"
                                                 src="/properties/{{ $propertyPic->property_pic }}"
                                                 style="width: 100%;" height="150" alt="slides">
                                        </div>
                                        <?php $count++ ?>
                                    @endforeach

                                </div>
                                <a class="carousel-control-prev" role="button">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" role="button">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="card px-lg-2">
                                <div class="card-body m-0 p-2">
                                    <div class="card-text">
                                        <div class="small">{{ ucfirst( $property->name)}}</div>
                                        <b>&#8358;{{ number_format($property->amount) }}</b>
                                        <div class="d-flex justify-content-center mt-2">
                                            <span class="d-flex mr-2">
                                                <i class="fas fa-eye mt-1 mr-2"></i> {{ $property->view_count }}
                                            </span>
                                            <span class="d-flex mr-2">
                                                <i class="far fa-heart mt-1 mr-2"></i> {{ count($property->savedProperty) }}
                                            </span>

                                            <span class="d-flex mr-2">
                                                <i class="far fa-flag mt-1 mr-2"></i> {{ count($property->flaggedProperty) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a @if(auth()->user()) href="/admin/properties/{{$property->id}}" @else href="javascript:void(0)"
                                       data-toggle="modal"
                                       data-target="#loginSignupModal" @endif class="btn btn-outline-primary btn-block">View
                                        House</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-6 mx-auto">
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection