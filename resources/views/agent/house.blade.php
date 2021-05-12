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
                                        @foreach($lodge->lodgePicture as $lodgePic)
                                            <li data-target="#houseCarousel" data-slide-to="{{ $count }}"
                                                class="@if($count == 0) {{ 'active' }}@endif"></li>
                                            <?php $count++ ?>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $count = 0
                                        ?>
                                        @foreach($lodge->lodgePicture as $lodgePic)
                                            <div class="carousel-item @if($count == 0) {{ 'active' }}@endif">
                                                <img class="d-block card-img-top"
                                                     src="/house_images/{{ $lodgePic->lodge_pic }}"
                                                     style="width: 100%;" height="200" alt="First slide">
                                            </div>
                                            <?php $count++ ?>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="list-group-flush px-2">
                                    <div class="list-group-item text-center">
                                        <button type="button"
                                           class="btn btn-outline-success mt-3 mr-md-2" onclick="document.getElementById('renewForm').submit();">
                                            Renew Lodge
                                        </button>
                                        <form action="/agent/house/{{ $lodge->id }}/renew" style="display: none;" method="post" id="renewForm">
                                            @csrf
                                        </form>
                                        <a href="/agent/house/{{ $lodge->id }}/photos"
                                           class="btn btn-primary mt-3 ml-md-2">
                                            Edit Photos
                                        </a>
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success mt-3">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form action="/agent/house/{{ $lodge->id }}" method="post">
                                        @csrf
                                        {{--                   Description                     --}}
                                        <div class="list-group-item">
                                            <span class="font-weight-bold">
                                                Description:
                                            </span>
                                            <div>
                                                @error('description')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <textarea type="text" class="form-control" name="description" placeholder="Description">{{ $lodge->description }}</textarea>
                                            </div>
                                        </div>
                                        {{--               Location             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                            <span class="font-weight-bold">
                                                Location:
                                            </span>
                                            <div>
                                                @error('location')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" class="form-control" name="location"
                                                       value="{{ $lodge->location }}" placeholder="Location"/>
                                            </div>
                                        </div>
                                        {{--               Type             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">
                                    Type:
                                </span>
                                            <div>
                                                @error('type')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="text" class="form-control" name="type"
                                                       value="{{ $lodge->type }}" placeholder="Lodge Type"/>
                                            </div>
                                        </div>
                                        {{--               Who Can Rent             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">
                                    Target Programme:
                                </span>
                                            <div>
                                                @error('who_can_rent')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <select class="form-control" name="who_can_rent" id="who_can_rent"
                                                        required>
                                                    <option value="{{ $lodge->who_can_rent }}">{{ $lodge->who_can_rent }}</option>
                                                    <option value=""></option>
                                                    <option value="All">All Programmes</option>
                                                    <option value="Jupeb">Jupeb</option>
                                                    <option value="Undergraduate">Undergraduate</option>
                                                    <option value="Post Graduate">Post Graduate</option>
                                                </select>
                                            </div>

                                        </div>
                                        {{--               Department             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">
                                    Department:
                                </span>
                                            <div>
                                                @error('department')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <select class="form-control" name="department" id="department">
                                                    <option value="{{ $lodge->department }}">{{ $lodge->department }}</option>
                                                    <option value=""></option>
                                                    <option value="All">All Departments</option>
                                                    @foreach($departments as $department)
                                                        <option value="{{ $department->department }}">{{ $department->department }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{--               Level             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">
                                    Level:
                                </span>
                                            <div>
                                                @error('level')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <select class="form-control" name="level" id="level">
                                                    <option value="{{ $lodge->level }}">{{ $lodge->level }}</option>
                                                    <option value="..."></option>
                                                    <option value="All">All Levels</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{--               Approval Status             --}}
                                        <div class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">
                                    Approval Status:
                                </span>
                                            <span>
                                    {{ $lodge->approval_status }}
                                </span>
                                        </div>

                                        <div class="list-group-item ">

                                            @foreach($lodge->lodgeRule as $lodgeRule)
                                                <div class="input-group mb-2">
                                                    <input type="text" readonly value="{{ $lodgeRule->rule }}"
                                                           id="{{ $lodgeRule->id }}"
                                                           class="form-control"/>
                                                    <button type="button" id="editRuleBtn">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    {{--                                                    <button class="btn-danger" type="button" id="editRuleBtn">--}}
                                                    {{--                                                        <i class="fas fa-minus-square"></i>--}}
                                                    {{--                                                    </button>--}}
                                                </div>

                                            @endforeach

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
    </script>
@endsection