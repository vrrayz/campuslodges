@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body px-2">
                        <div class="row">
                            <div class="col-md-8">
                                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php
                                        $count = 0
                                        ?>
                                        @foreach($property->propertyPicture as $propertyPic)
                                            <li data-target="#houseCarousel" data-slide-to="{{ $count }}"
                                                class="@if($count == 0) {{ 'active' }}@endif"></li>
                                            <?php $count++ ?>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $count = 0
                                        ?>
                                        @foreach($property->propertyPicture as $propertyPic)
                                            <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                                <img class="d-block card-img-top"
                                                     src="/properties/{{ $propertyPic->property_pic }}"
                                                     style="width: 100%;" height="200" alt="First slide">
                                            </div>
                                            <?php $count++ ?>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="list-group-flush px-2">

                                    {{--                                    <a href="/user/property/{{ $property->id }}/photos"--}}
                                    {{--                                       class="btn btn-primary d-block mx-auto mt-3">--}}
                                    {{--                                        Edit Photos--}}
                                    {{--                                    </a>--}}
                                    <div class="edit-photo-box py-3 w-100">
                                        <div class="child-box btn-box ml-2">
                                            <button class="d-block w-100 h-100 btn btn-primary text-center"
                                                    id="addPictureBtn" type="button">
                                                <i class="fas fa-plus fa-1x"></i>
                                            </button>
                                        </div>
                                        @foreach($property->propertyPicture as $propertyPic)
                                            <div class="child-box ml-2" data-uid="{{ $propertyPic->id }}"
                                                 style="background: url('/properties/{{ $propertyPic->property_pic }}'); background-size: cover;">
                                                <form>
                                                    <input type="file" name="property_pic" disabled>
                                                </form>
                                                <button class="btn btn-danger p-0 child-box-close">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="list-group-item text-center">
                                        <button href="" class="btn btn-outline-success" onclick="document.getElementById('renewForm').submit()">Renew Property</button>
                                        <form method="post" action="/user/renew_property/{{ $property->id }}" id="renewForm">
                                            @csrf
                                        </form>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success mt-3">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form action="/user/property/{{ $property->id }}" method="post">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        {{--            Description                --}}
                                        <div class="list-group-item">
                                            <div class="font-weight-bold mr-3 mt-2">
                                                Description:
                                            </div>
                                            <div class="ml-3">
                                                @error('description')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <textarea placeholder="Description" name="description" id="description"
                                                          class="form-control"
                                                          required>{{ $property->description }}</textarea>
                                            </div>
                                        </div>
                                        {{--            Name Of The Itmem                --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                            <div class="font-weight-bold mr-3 mt-2">
                                                Name:
                                            </div>
                                            <div class="ml-3">
                                                @error('name')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" name="name" class="form-control"
                                                       placeholder="Name of the item" value="{{ $property->name }}"/>
                                            </div>
                                        </div>
                                        {{--            Category                --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                            <div class="font-weight-bold mr-3 mt-2">
                                                Category:
                                            </div>
                                            <div class="ml-3">
                                                @error('category')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" name="category" class="form-control"
                                                       placeholder="Item Category" value="{{ $property->category }}"/>
                                            </div>
                                        </div>
                                        {{--            Condition                --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                            <div class="font-weight-bold mr-3 mt-2">
                                                Condition:
                                            </div>
                                            <div class="ml-3">
                                                @error('category')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <select name="condition" class="form-control">
                                                    <option value="{{ $property->condition }}">{{ ucfirst($property->condition) }}</option>
                                                    <option value=""></option>
                                                    <option value="used">Used</option>
                                                    <option value="new">New</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{--             Price                   --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                            <div class="font-weight-bold mr-3 mt-2">
                                                Price:
                                            </div>
                                            <div class="ml-3">
                                                @error('price')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" name="price" class="form-control"
                                                       placeholder="Price(&#8358;)"
                                                       value="{{ number_format($property->amount) }}">
                                            </div>
                                        </div>
                                        {{--               Approval Status             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">
                                    Approval Status:
                                </span>
                                            <span>
                                    {{ $property->approval_status }}
                                </span>
                                        </div>

                                        <input type="submit" class="btn btn-primary btn-lg d-block mx-auto my-3"
                                               value="Update">
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="list-group mt-3">
                                    @foreach($verification_notifications as $notification)
                                        <div
                                                class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"></h5>
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1 small">{{ $notification->message }}.</p>
                                        </div>
                                    @endforeach
                                </div>
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
        $("body").on("click", "#editRuleBtn", function () {
            $(this).prev().removeAttr("readonly");
            $(this).empty();
            $(this).attr('id', 'submitRuleBtn');
            $(this).append('<i class="fas fa-check"></i>')
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $("body").on("click", "#submitRuleBtn", function () {
            var button = $(this);
            var input = button.prev();
            $.ajax({
                url: '/agent/houseRule/' + $(this).prev().attr('id') + '/edit/' + $(this).prev().val(),
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    // alert(input.val());
                    button.empty();
                    button.attr('id', 'editRuleBtn');
                    button.append('<i class="fas fa-pencil-alt"></i>');
                    input.attr("readonly", "readonly");
                }
            })
        })
        $("input[name='price']").on("keyup", function (event) {
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
        $("#addPictureBtn").click(function () {
            $(".edit-photo-box").append('<div class="child-box ml-2"><form id="uploadForm" enctype="multipart/form-data"><input type="file" name="property_pic"></form><button class="btn btn-danger p-0 child-box-close">\n' +
                '                                                    <i class="fas fa-times"></i>\n' +
                '                                                </button></div>');
        })

        $("body").on("change","input[name='property_pic']",function () {
            var input = this;
            var element = $(this);
            console.log(element.val());
            $.ajax({
                url: '/user/property/{{ $property->id }}/photo',
                type: 'POST',
                data: new FormData(element.parent()[0]),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success:function (data) {
                    if ($.isEmptyObject(data.error)){
                        element.parent().removeAttr('id');
                        element.parent().removeAttr('enctype');
                        element.attr('disabled','disabled');
                        element.parent().parent().attr('data-uid',''+data.property_id);
                        element.parent().parent().css("background","url('/properties/"+data.pic_name+"')").css("background-size","cover");
                        // alert(data.success);
                    }else{
                        $.each(data.error,function (key,value) {
                            console.log(value);
                        })
                    }
                }
            })
            // readURL(input,element);
        })
        $("body").on("click",".child-box .child-box-close",function () {
            var prop_id = $(this).parent().attr("data-uid");
            var element = $(this);
            // console.log($(this).parent().attr('data-uid'))
            // alert($(this).parent().attr("data-uid"))
            $.ajax({
                url: '/user/property/{{ $property->id }}/'+prop_id,
                type:'DELETE',
                dataType: 'json',
                success: function (data) {
                    if (data.error == undefined){
                        element.parent().remove();
                    }else {
                        alert(data.error);
                    }
                }
            })
        })
    </script>
@endsection