@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body px-2">
                        <div class="text-center font-weight-bold">
                            @if(count($savedLodges) == 0)
                                <h5>No Lodge </h5>
                            @else
                                <h5>Saved Items </h5>
                            @endif
                        </div>
                        @if(session('update_success'))
                            <div class="alert alert-success">
                                {{ session('update_success') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach($savedLodges as $savedLodge)
                                <div class="col-md-4 mb-3">
                                    <a href="/lodges/{{ $savedLodge->lodge->id }}" class="text-dark" style="text-decoration: none">
                                        <div class="card">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $count = 0
                                                    ?>
                                                    @foreach($savedLodge->lodge->lodgePicture as $savedLodgePic)
                                                        <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                                            <img class="d-block card-img-top"
                                                                 src="/house_images/{{ $savedLodgePic->lodge_pic }}"
                                                                 style="width: 100%;" height="150" alt="First slide">
                                                        </div>
                                                        <?php $count++ ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $savedLodge->lodge->type }} at {{ $savedLodge->lodge->location }}</h6>
                                                <b>&#8358;{{ number_format($savedLodge->lodge->price) }}</b>
                                            </div>
                                        </div>
                                    </a>
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

    </script>
@endsection
