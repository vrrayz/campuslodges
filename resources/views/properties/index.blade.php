@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
{{--            @include('layouts.user.sidebar')--}}
            <div class="col-lg-12 mt-3 mb-3 pb-2">
                @if(count($properties) == 0)
                    <h4>Nothing uploaded yet</h4>
                @else
                    <div class="row">
                        @foreach($properties as $property)
                            <div class="col-md-2 col-6 mb-3">
                                <div class="card shadow-sm">
                                    <img src="/properties/{{ $property->propertyPicture->first()->property_pic }}" class="card-img-top d-block img-fluid" style="height:100px;">
                                    <div class="card-body pb-1 pt-2">
                                        <div class="d-flex justify-content-center">
                                            <span class="d-flex mr-2">
                                                <i class="fas fa-eye mt-1 mr-2"></i> {{ $property->view_count }}
                                            </span>
                                            @if(auth()->user())
                                                <?php $saved = false;?>
                                                @foreach(auth()->user()->savedProperty as $savedProperty)
                                                    @if($savedProperty->property_id == $property->id)
                                                        <?php $saved = true;?>
                                                        @break
                                                    @endif
                                                @endforeach
                                                <a href="javascript:void(0)"
                                                   class="@if($saved) {{ 'text-danger' }} @else {{ 'text-dark' }}@endif ml-2 mr-2"
                                                   style="text-decoration: none;" id="saveBtn" data-content="{{ $property->id }}">
                                                    <i class="@if($saved) {{ 'fas' }} @else {{ 'far' }}@endif fa-heart mt-1 mr-2"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="text-dark ml-2 mr-2"
                                                   style="text-decoration: none;" data-toggle="modal"
                                                   data-target="#loginSignupModal">
                                                    <i class="far fa-heart mt-1 mr-2"></i>
                                                </a>
                                            @endif
                                        </div>
                                        <h6 class="card-title">{{ $property->name }}</h6>
                                        <p class="card-text"><span class="font-weight-bold">&#8358;</span>
                                            {{ number_format($property->amount) }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="/props/{{ $property->id }}" class="btn btn-outline-info">View More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            {{ $properties->links() }}
                        </div>
                    </div>
                @endif
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
                url: '/user/property/save/' + $(this).attr('data-content'),
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    btn.children("i").first().toggleClass("far");
                    btn.children("i").first().toggleClass("fas");
                    btn.toggleClass("text-dark");
                    btn.toggleClass("text-danger");
                    console.log(data.message);
                }
            })
        })
        $("body").on("click", "#flagPropertyBtn", function () {
            var btn = $(this);
            if (btn.hasClass('text-site')) {
                $.ajax({
                    url: '/user/property/flag/' + $(this).attr('data-content'),
                    type: 'POST',
                    dataType: 'json',
                    success: function (data) {
                        btn.children("i").first().toggleClass("far");
                        btn.children("i").first().toggleClass("fas");
                        btn.toggleClass("text-dark");
                        btn.toggleClass("text-site");
                        // console.log(data.message);
                    }
                })
            } else {
                $('#reasonForFlagging').removeClass('d-none');
                $('#reasonCard').removeClass('d-none');
                $('#successMessage').addClass('d-none');
                $('textarea[name="reason_for_flag"]').attr('id', btn.attr('data-content'));
            }
        })

    </script>
@endsection