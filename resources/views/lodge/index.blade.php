@extends('layouts.app')
@section('main')
@include('layouts.homepage.modals')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mt-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title small font-weight-bold">Vicinity</h6>
                    <select class="form-control mb-3" name="vicinity">
                        <option value="All" {{ ((request('vicinity') != 'on' && request('vicinity') != 'off') ? 'selected':'') }}>All</option>
                        <option value="On" {{ (request('vicinity') == 'on'? 'selected':'') }}>On</option>
                        <option value="Off" {{ (request('vicinity') == 'off'? 'selected':'') }}>Off</option>
                    </select>
                    <h6 class="card-title small font-weight-bold">Location</h6>
                    <select class="form-control mb-3" name="location">
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                    </select>
                    <h6 class="card-title small font-weight-bold">Type</h6>
                    <select class="form-control mb-3" name="lodge_type">
                        <option value="On">On</option>
                        <option value="Off">Off</option>
                    </select>
                    <h6 class="card-title small font-weight-bold">Price</h6>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control price" name="min_price" placeholder="min" value="{{ $min_price }}">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control price" name="max_price" placeholder="max" value="{{ $max_price }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 mt-3">
            <div class="row" id="lodges_row">
                @foreach($lodges as $lodge)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="/house_images/{{ $lodge->lodgePicture->first()->lodge_pic }}"
                                class="card-img-top d-block img-fluid" style="height:100px;">
                            <div class="card-text mt-1">
                                <h5 class="card-title">{{ $lodge->type }} at {{ $lodge->location }} - {{ $lodge->vicinity }} campus</h5>
                                <b>&#8358;{{ number_format($lodge->price) }}</b>
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
                                        style="text-decoration: none;" id="flagBtn" data-content="{{ $lodge->id }}">
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
                                data-target="#loginSignupModal" @endif class="btn btn-site font-weight-bold btn-block">View
                                House</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    $(".price").on("keyup", function (event) {
            // alert($(this).val());
            var selection = window.getSelection().toString();
            if (selection !== '') {
                return;
            }
            if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                return;
            }
            var input = $(this).val().replace(/[\D\s\._\-]+/g, "");
            input = input ? parseInt(input, 10) : 0;

            $(this).val(function () {
                return (input === 0) ? "" : input.toLocaleString("en-Us");
            });
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $(document).ready(function () {
            var vicinity = "{{ request('vicinity') }}";
            var location = "{{ request('location') }}";
            var lodge_type = "{{ request('lodge_type') }}";
            if (vicinity == 'on' || vicinity == 'off')
                $.ajax({
                    url: '/getSearchLocation/' + vicinity,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        $('select[name="location"]').empty();
                        $('select[name="location"]').append(`<option value="">Location</option>`)
                        console.log(data);
                        data.map((row,index) => {
                            $('select[name="location"]').append(`<option value="${row.location}" ${location == row.location ? 'selected':''}>${row.location}</option>`)
                        });
                    }
                })
            $.ajax({
                url: '/getRoomLocation/' + vicinity,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('select[name="lodge_type"]').empty();
                    $('select[name="lodge_type"]').append(`<option value="">Room Type</option>`)
                    $.each(data, function (key, value) {
                        $('select[name="lodge_type"]').append(`<option value="${value}" ${lodge_type == value ? 'selected':''}>${value}</option>`)
                    });
                }
            })
        })
        $(".price").on("keyup", function (event) {
            // alert($(this).val());
            var selection = window.getSelection().toString();
            if (selection !== '') {
                return;
            }
            if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                return;
            }
            var input = $(this).val().replace(/[\D\s\._\-]+/g, "");
            input = input ? parseInt(input, 10) : 0;

            $(this).val(function () {
                return (input === 0) ? "" : input.toLocaleString("en-Us");
            });
        })

        function printErrorMessage(error, error_tag) {
            $.each(error, function (key, value) {
                error_tag.text(value);
            })
        }
</script>
<script src="/js/flag_and_save.js"></script>
@endsection