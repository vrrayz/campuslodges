@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body px-2">
                        @if(count($properties) == 0)
                            <div class="text-center font-weight-bold">
                                <h5>No Property </h5>
                            </div>
                        @endif
                        @if(session('update_success'))
                            <div class="alert alert-success">
                                {{ session('update_success') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach($properties as $property)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php
                                                $count = 0
                                                ?>
                                                @foreach($property->propertyPicture as $propertyPic)
                                                    <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                                        <img class="d-block card-img-top"
                                                             src="/properties/{{ $propertyPic->property_pic }}"
                                                             style="width: 100%;" height="150" alt="First slide">
                                                    </div>
                                                    <?php $count++ ?>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $property->name }}</h5>
                                            <div class="card-text m-0 p-0 d-flex justify-content-between">
                                                <span>Price:</span>
                                                <span>&#8358;{{ number_format($property->amount) }}</span></div>
                                            <div class="card-text d-flex justify-content-between">
                                                <span>Status:</span>
                                                <span class="@if($property->approval_status == 'pending') {{ 'text-warning' }}
                                                @elseif($property->approval_status == 'approved') {{ 'text-success' }} @endif">
                                                    {{ $property->approval_status }}
                                                </span>
                                            </div>
                                            <div class="card-text d-flex justify-content-between">
                                                <span>Availability:</span>
                                                <span class="@if($property->availability == 'unavailable') {{ 'text-warning' }}
                                                @elseif($property->availability == 'available') {{ 'text-success' }} @endif">
                                                    {{ $property->availability }}
                                                </span>
                                            </div>
                                            <hr/>
                                            <a href="/user/property/{{ $property->id }}"
                                               class="btn btn-info d-block mx-auto mb-2">Manage Property</a>
                                            @if($property->approval_status == 'approved' && $property->availability == 'unavailable')
                                                <button class="btn btn-success btn-block mx-auto" id="pushBtn"
                                                        data-toggle="tooltip" data-uid="{{ $property->id }}" type="button" title="Push property online">
                                                    Publish
                                                </button>
                                            @elseif($property->approval_status == 'approved' && $property->availability == 'available')
                                                <button class="btn btn-danger btn-block mx-auto" id="pullBtn"
                                                        data-toggle="tooltip" data-uid="{{ $property->id }}" type="button" title="Pull property">
                                                    Pull Down
                                                </button>
                                            @endif
                                            <form style="display: none;" id="push{{ $property->id }}"
                                                  action="/user/push_property/{{ $property->id }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                            </form>
                                            <form style="display: none;" id="pull{{ $property->id }}"
                                                  action="/user/pull_property/{{ $property->id }}" method="post">
                                                {{ method_field('PUT') }}
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-12">
                                {{ $properties->links() }}
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
        $("body").on("click", "#pushBtn", function () {
            var id = $(this).attr('data-uid');
            if (confirm("Publish this property online") == true){
                $("#push"+id).submit();
            }
        })
        $("body").on("click", "#pullBtn", function () {
            var id = $(this).attr('data-uid');
            if (confirm("Pull down this property") == true){
                $("#pull"+id).submit();
            }
        })
    </script>
@endsection