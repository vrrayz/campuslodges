@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            {{--            @include('layouts.user.sidebar')--}}
            <div class="col-lg-12 mx-auto mt-3 mb-3 pb-2">
                <div class="card shadow-sm pt-3">
                    <h5 class="text-center">Property Detail</h5>
                    <div class="row mt-2">
                        <div class="col-md-8 mb-3 ml-3">
                            <img src="/properties/{{ $property->propertyPicture->first()->property_pic }}"
                                 style="width: 90%; height: 50vh;" id="preview" class="d-block ml-3 img-fluid img-thumbnail">
                        </div>
                        <div class="col-md-3 d-lg-block d-none">
                            <div style="overflow-x: hidden; overflow-y: scroll; height: 50vh;">
                                @foreach($property->propertyPicture as $propertyPicture)
                                    <a href="javascript:void(0)" id="side_pic">
                                        <img src="/properties/{{ $propertyPicture->property_pic }}"
                                             style="width: 80%; height: 150px;"
                                             class="mb-2 img-fluid img-thumbnail"></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 d-lg-none" style="display: inline-block">
                            <div class="px-3" style="overflow-x: scroll; overflow-y: hidden; height: 100px;">
                                @foreach($property->propertyPicture as $propertyPicture)
                                    <a href="javascript:void(0)" id="side_pic">
                                        <img src="/properties/{{ $propertyPicture->property_pic }}"
                                             style="width: 100px; height: 100px;"
                                             class="mb-2 img-fluid img-thumbnail"></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">{{ $property->name }}</h4>
                        <h5 class="card-title text-center">
                            Description
                        </h5>
                        <div class="col-md-9 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text text-secondary">
                                        {{ $property->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 mx-auto">
                        <p class="text-secondary ml-3">
                            <span class="font-weight-bold">Condition:</span> {{ ucfirst($property->condition) }}
                        </p>
                    </div>
                    <h5 class="text-center">
                        Price
                    </h5>
                    <p class="font-weight-bold text-center">
                        &#8358;{{ number_format($property->amount) }}
                    </p>
                    <h5 class="d-flex mx-auto my-3 text-secondary">
                        <i class="fas fa-phone-alt mt-1 mr-2 "></i>Seller's contact
                    </h5>
                    <h3 class="d-flex mx-auto">
                        {{ $property->user->phone_no }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('body').on('click','#side_pic',function () {
            // alert($(this).find('img').attr('src'));
            $("#preview").attr('src',$(this).find('img').attr('src'));
        })
    </script>
@endsection