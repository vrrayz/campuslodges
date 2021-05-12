@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row">
        <div class="col-lg-3 mt-3 d-none d-lg-block">
            <div class="list-group-flush shadow-sm" style="border-radius: 25%;">
                {{--On Campus Header--}}
                <div class="list-group-item custom-lg-sidebar-head p-0">
                    <a href="javascript:void(0)" onclick="hideVicinity('on')" class="d-flex justify-content-between">
                        <span>
                            <i class="fas fa-university"></i> On Campus
                        </span>
                        <span class="fas fa-caret-down"></span>
                    </a>
                </div>
                {{--On Campus List--}}
                <div style="display:block; height:30vh; width:100%; overflow-x:hidden;overflow-y:scroll;" data-vicinity="on">
                    @foreach ($lodgeSpots as $lodgeSpot)
                        @if ($lodgeSpot->vicinity == 'on')
                            <div class="list-group-item custom-lg-sidebar p-0">
                                <a href="javascript:void(0)" onclick="submitData('{{ $lodgeSpot->location }}')" class="d-flex justify-content-between px-5 py-2">
                                    <span>
                                        <i class="fas fa-map-marker-alt text-success"></i> {{ $lodgeSpot->location }}
                                    </span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                {{--Off Campus Header--}}
                <div class="list-group-item custom-lg-sidebar-head p-0">
                    <a href="javascript:void(0)" onclick="hideVicinity('off')" class="d-flex justify-content-between">
                        <span>
                            <i class="fas fa-road"></i> Off Campus
                        </span>
                        <span class="fas fa-caret-down"></span>
                    </a>
                </div>
                {{--Off Campus List--}}
                <div style="display:block; height:30vh; width:100%; overflow-x:hidden;overflow-y:scroll;" data-vicinity="off">
                    @foreach ($lodgeSpots as $lodgeSpot)
                        @if ($lodgeSpot->vicinity == 'off')
                            <div class="list-group-item custom-lg-sidebar p-0">
                                <a href="javascript:void(0)" onclick="submitData('{{ $lodgeSpot->location }}')" class="d-flex justify-content-between px-5 py-2">
                                    <span>
                                        <i class="fas fa-map-marker-alt text-success"></i> {{ $lodgeSpot->location }}
                                    </span>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-9 mt-3 mb-3 pb-2">
            <div id="houseCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#houseCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#houseCarousel" data-slide-to="1"></li>
                    <li data-target="#houseCarousel" data-slide-to="2"></li>
                    {{--  <li data-target="#houseCarousel" data-slide-to="1"></li>
                    <li data-target="#houseCarousel" data-slide-to="2"></li>  --}}
                </ol>
                <div class="carousel-inner img-wrapper">
                    {{--  <div class="carousel-item active custom-img">
                        <img src="/images/lodges/download.png" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item custom-img">
                        <img src="/images/lodges/lodge2.jpg" class="d-block w-100 h-100">
                    </div>  --}}
                    <div class="carousel-item active custom-img">
                        <img src="/images/lodges/coshen.jpg" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item custom-img">
                        <img src="/images/lodges/real_lodge.jpg" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item custom-img">
                        <img src="/images/lodges/real_lodge2.jpg" class="d-block w-100 h-100">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#houseCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#houseCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mb-3">
    <div class="card px-3 py-3" style="border: none;">
        <form action="/lodges" class="mx-auto" method="get">
            @csrf
            <div class="form-row align-items-center">
                {{--          Vicinity              --}}
                <div class="col-md-auto my-1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="vicinity" id="inlineRadio1" value="on">
                        <label class="form-check-label" for="inlineRadio1">On Campus</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="vicinity" id="inlineRadio2" value="off">
                        <label class="form-check-label" for="inlineRadio2">Off Campus</label>
                    </div>
                </div>
                {{--          Location          --}}
                <div class="col-md-auto my-1">
                    <select class="form-control" name="location" id="#locationSelect">
                        <option value="">Location</option>
                    </select>
                </div>
                {{--          Type          --}}
                <div class="col-md-auto my-1">
                    <select class="form-control" name="lodge_type">
                        <option value="">Room type</option>
                        <option value="BQ">BQ</option>
                        <option value="2 Man BQ">2 Man BQ</option>
                        <option value="Chain BQ">Chain BQ</option>
                        <option value="Single Room">Single Room</option>
                    </select>
                </div>
                {{--          Lodge Min Price          --}}
                <div class="col-md-auto text-center my-1">
                    <input type="text" name="min_price" placeholder="Min Price" class="form-control price">
                </div>
                {{--           Lodge Max Price         --}}
                <div class="col-md-auto text-center my-1">
                    <input type="text" name="max_price" placeholder="Max Price" class="form-control price">
                </div>
                <div class="col-auto my-1">
                    <button type="submit" class="btn btn-site">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--  Featured Houses  --}}
<div class="container-fluid">
    <div class="card pt-3" style="border: none;">
        <div class="card-body">
            <h5 class="text-center card-title bg-danger py-2 mb-3 text-light">Featured Lodges</h5>
            <div class="row mt-3 px-3">
                @foreach($lodges as $lodge)
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card">
                        <div id="lodgeCarousel{{ $lodge->id }}" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                        $count = 0
                                        ?>
                                @foreach($lodge->lodgePicture as $lodgePic)
                                @if($count == 0)
                                <li data-target="#lodgeCarousel{{ $lodge->id }}" data-slide-to="{{ $count }}"
                                    class="active"></li>
                                @elseif(auth()->user())
                                <li data-target="#lodgeCarousel{{ $lodge->id }}" data-slide-to="{{ $count }}"></li>
                                @endif
                                <?php $count++ ?>
                                @endforeach
                            </ol>
                            <div class="carousel-inner img-wrapper">
                                <?php
                                        $count = 0
                                        ?>
                                @foreach($lodge->lodgePicture as $lodgePic)
                                @if($count == 0)
                                <div class="carousel-item active custom-img">
                                    <img class="d-block card-img-top h-auto"
                                        src="/house_images/{{ $lodgePic->lodge_pic }}" style="width: 100%;"
                                        alt="slides">
                                </div>
                                @elseif(auth()->user())
                                <div class="carousel-item custom-img">
                                    <img class="d-block card-img-top h-auto"
                                        src="/house_images/{{ $lodgePic->lodge_pic }}" style="width: 100%;"
                                        alt="slides">
                                </div>
                                @endif
                                <?php $count++ ?>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" role="button"
                                @if(auth()->user())href="#lodgeCarousel{{ $lodge->id }}" data-slide="prev"
                                @else data-toggle="modal"
                                data-target="#loginSignupModal" @endif>
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" role="button"
                                @if(auth()->user())href="#lodgeCarousel{{ $lodge->id }}" data-slide="next"
                                @else data-toggle="modal"
                                data-target="#loginSignupModal" @endif>
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body m-0 p-2">
                            <div class="card-text">
                                <div class="small">{{ $lodge->type }} at {{ $lodge->location }}</div>
                                <b>
                                    &#8358;{{ number_format($lodge->price) }}
                                </b>
                                <div class="d-flex justify-content-center mt-2">
                                    <span class="d-flex mr-2">
                                        <i class="fas fa-eye mt-1 mr-2"></i> {{ $lodge->view_count }}
                                    </span>
                                    @if(auth()->user())
                                        {{--                   Check if it has been saved by this user before                             --}}
                                        <?php $saved = false;?>
                                        @foreach(auth()->user()->savedLodge as $saveLodge)
                                            @if($saveLodge->lodge_id == $lodge->id)
                                                <?php $saved = true;?>
                                                @break
                                            @endif
                                        @endforeach
                                        <a href="javascript:void(0)"
                                            class="@if($saved) {{ 'text-danger' }} @else {{ 'text-dark' }}@endif ml-2 mr-2"
                                            style="text-decoration: none;" id="saveBtn" data-content="{{ $lodge->id }}">
                                            <i
                                                class="@if($saved) {{ 'fas' }} @else {{ 'far' }}@endif fa-heart mt-1 mr-2"></i>
                                        </a>

                                        {{--                   Check if it has been flagged by this user before                             --}}
                                        <?php $flagged = false;?>
                                        @foreach(auth()->user()->flaggedLodge as $flaggedLodge)
                                            @if($flaggedLodge->lodge_id == $lodge->id)
                                                <?php $flagged = true;?>
                                                @break
                                            @endif
                                        @endforeach
                                        <a href="javascript:void(0)"
                                            class="@if($flagged) {{ 'text-site' }} @else {{ 'text-dark' }}@endif ml-2 mr-2"
                                            style="text-decoration: none;" id="flagPropertyBtn"
                                            data-content="{{ $lodge->id }}">
                                            <i class="@if($flagged) {{ 'fas' }} @else {{ 'far' }}@endif fa-flag mt-1 mr-2"
                                                title="Flag this lodge?"></i>
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="text-dark ml-2 mr-2"
                                            style="text-decoration: none;" data-toggle="modal"
                                            data-target="#loginSignupModal">
                                            <i class="far fa-heart mt-1 mr-2"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="text-dark ml-2 mr-2"
                                            style="text-decoration: none;" data-toggle="modal"
                                            data-target="#loginSignupModal">
                                            <i class="far fa-flag mt-1 mr-2"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a @if(auth()->user()) href="/lodges/{{$lodge->id}}" @else href="javascript:void(0)"
                                data-toggle="modal"
                                data-target="#loginSignupModal"
                                @endif class="btn btn-site font-weight-bold btn-block">View
                                House</a>
                        </div>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#socialMediaShareModal" class="mr-2 bg-warning text-light pl-2" style="position:absolute;border-left-radius:4px">
                                <i class="fas fa-share mt-1 mr-2"></i>
                            </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card pt-0" style="border: none;">
        <div class="card-body">
            <h5 class="text-center card-title bg-danger py-2 mb-3 text-light">Featured Properties</h5>
            <div class="row mt-3 px-3">
                @foreach($properties as $property)
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card">
                        <div id="lodgeCarousel{{ $property->id }}" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                        $count = 0
                                        ?>
                                @foreach($property->propertyPicture as $propertyPic)
                                @if($count == 0)
                                <li data-target="#propertyCarousel{{ $property->id }}" data-slide-to="{{ $count }}"
                                    class="active"></li>
                                @elseif(auth()->user())
                                <li data-target="#propertyCarousel{{ $property->id }}" data-slide-to="{{ $count }}">
                                </li>
                                @endif
                                <?php $count++ ?>
                                @endforeach
                            </ol>
                            <div class="carousel-inner img-wrapper">
                                <?php
                                        $count = 0
                                        ?>
                                @foreach($property->propertyPicture as $propertyPic)
                                @if($count == 0)
                                <div class="carousel-item active custom-img">
                                    <img class="d-block card-img-top h-auto"
                                        src="/properties/{{ $propertyPic->property_pic }}" style="width: 100%;"
                                        alt="slides">
                                </div>
                                @elseif(auth()->user())
                                <div class="carousel-item custom-img">
                                    <img class="d-block card-img-top h-auto"
                                        src="/house_images/{{ $propertyPic->property_pic }}" style="width: 100%;"
                                        alt="slides">
                                </div>
                                @endif
                                <?php $count++ ?>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" role="button"
                                @if(auth()->user())href="#propertyCarousel{{ $property->id }}" data-slide="prev"
                                @else data-toggle="modal"
                                data-target="#loginSignupModal" @endif>
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" role="button"
                                @if(auth()->user())href="#propertyCarousel{{ $property->id }}" data-slide="next"
                                @else data-toggle="modal"
                                data-target="#loginSignupModal" @endif>
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body m-0 p-2">
                            <div class="card-text">
                                <div class="small">{{ ucwords($property->name) }}</div>
                                <b>&#8358;{{ number_format($property->amount) }}</b>
                                <div class="d-flex justify-content-center mt-2">
                                    <span class="d-flex mr-2">
                                        <i class="fas fa-eye mt-1 mr-2"></i> {{ $property->view_count }}
                                    </span>
                                    @if(auth()->user())
                                    {{--                   Check if it has been saved by this user before                             --}}
                                    <?php $saved = false;?>
                                    @foreach(auth()->user()->savedProperty as $savedProperty)
                                    @if($savedProperty->property_id == $property->id)
                                    <?php $saved = true;?>
                                    @break
                                    @endif
                                    @endforeach
                                    <a href="javascript:void(0)"
                                        class="@if($saved) {{ 'text-danger' }} @else {{ 'text-dark' }}@endif ml-2 mr-2"
                                        style="text-decoration: none;" id="savePropertyBtn"
                                        data-content="{{ $property->id }}">
                                        <i
                                            class="@if($saved) {{ 'fas' }} @else {{ 'far' }}@endif fa-heart mt-1 mr-2"></i>
                                    </a>

                                    {{--                   Check if it has been flagged by this user before                             --}}
                                    <?php $flagged = false;?>
                                    @foreach(auth()->user()->flaggedProperty as $flaggedProperty)
                                    @if($flaggedProperty->property_id == $property->id)
                                    <?php $flagged = true;?>
                                    @break
                                    @endif
                                    @endforeach
                                    <a href="javascript:void(0)"
                                        class="@if($flagged) {{ 'text-site' }} @else {{ 'text-dark' }}@endif ml-2 mr-2"
                                        style="text-decoration: none;" id="flagPropertyBtn"
                                        data-content="{{ $property->id }}">
                                        <i class="@if($flagged) {{ 'fas' }} @else {{ 'far' }}@endif fa-flag mt-1 mr-2"
                                            title="Flag this property?"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="text-dark ml-2 mr-2"
                                        style="text-decoration: none;" data-toggle="modal"
                                        data-target="#loginSignupModal">
                                        <i class="far fa-heart mt-1 mr-2"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="text-dark ml-2 mr-2"
                                        style="text-decoration: none;" data-toggle="modal"
                                        data-target="#loginSignupModal">
                                        <i class="far fa-flag mt-1 mr-2"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a @if(auth()->user()) href="/props/{{$property->id}}"
                                @else href="javascript:void(0)"
                                data-toggle="modal"
                                data-target="#loginSignupModal" @endif class="btn btn-site btn-block">View
                                Property</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="card pt-0" style="border: none;">
        <div class="card-body">
            <h5 class="text-center card-title bg-danger py-2 mb-3 text-light">Featured Locations</h5>
            <form action="/lodges" method="get" id="location_form" class="d-none">
                @csrf
                <input type="hidden" name="location" />
            </form>
            <div class="row mt-3 px-3">
                {{-- Odim_street --}}
                <div class="col-lg-4 col-md-4 mb-3">
                    <a href="javascript:void(0)" style="background-color:black;" onclick="submitData('Odim Street')">
                        <img src="/images/location/odim_street.jpeg" alt="..." class="img-thumbnail">
                        <div style="position:relative; width:97%; background-color:rgba(50,50,50,1); top:-45px;left:0"
                            class="text-white py-2 mx-auto text-center">
                            Odim Street
                        </div>
                    </a>
                </div>
                {{-- Ezeopi --}}
                <div class="col-lg-4 col-md-4 mb-3">
                    <a href="javascript:void(0)" style="background-color:black;" onclick="submitData('Ezeopi')">
                        <img src="/images/location/ezeopi_i.jpeg" alt="..." class="img-thumbnail">
                        <div style="position:relative; width:97%; background-color:rgba(50,50,50,1); top:-45px;left:0"
                            class="text-white py-2 mx-auto text-center">
                            Ezeopi
                        </div>
                    </a>
                </div>
                {{-- Umunkanka --}}
                <div class="col-lg-4 col-md-4 mb-3">
                    <a href="javascript:void(0)" style="background-color:black;" onclick="submitData('Umunkanka')">
                        <img src="/images/location/umunkanka.jpeg" alt="..." class="img-thumbnail">
                        <div style="position:relative; width:97%; background-color:rgba(50,50,50,1); top:-45px;left:0"
                            class="text-white py-2 mx-auto text-center">
                            Umunkanka
                        </div>
                    </a>
                </div>
                {{-- Fulton --}}
                <div class="col-lg-4 col-md-4 mb-3">
                    <a href="javascript:void(0)" style="background-color:black;" onclick="submitData('Fulton')">
                        <img src="/images/location/fulton_avenue.jpeg" alt="..." class="img-thumbnail">
                        <div style="position:relative; width:97%; background-color:rgba(50,50,50,1); top:-45px;left:0"
                            class="text-white py-2 mx-auto text-center">
                            Fulton
                        </div>
                    </a>
                </div>
                {{-- Ikejiani --}}
                <div class="col-lg-4 col-md-4 mb-3">
                    <a href="javascript:void(0)" style="background-color:black;" onclick="submitData('Ikejiani')">
                        <img src="/images/location/ikejiani_avenue_2.jpeg" alt="..." class="img-thumbnail">
                        <div style="position:relative; width:97%; background-color:rgba(50,50,50,1); top:-45px;left:0"
                            class="text-white py-2 mx-auto text-center">
                            Ikejiani
                        </div>
                    </a>
                </div>
                {{-- Maguerite Cartwrite --}}
                <div class="col-lg-4 col-md-4 mb-3">
                    <a href="javascript:void(0)" style="background-color:black;" onclick="submitData('Catrite')">
                        <img src="/images/location/maguerite_cartwrite.jpeg" alt="..." class="img-thumbnail">
                        <div style="position:relative; width:97%; background-color:rgba(50,50,50,1); top:-45px;left:0"
                            class="text-white py-2 mx-auto text-center">
                            Maguerite Cartwrite
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.homepage.modals')
@endsection
@section('scripts')
<script src="/js/index_page.js">
</script>
<script>
    function submitData(data){
        $("input[name='location']").val(data);
        document.getElementById("location_form").submit();
    }
    function hideVicinity(vicinity){
        $("div[data-vicinity='"+vicinity+"']").toggleClass('d-none');
        {{--  console.log($("div[data-vicinity='on']").text())  --}}
    }
</script>
<script src="/js/flag_and_save.js">
</script>
@endsection