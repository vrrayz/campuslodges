@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h5>LODGE DETAILS</h5>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('picture_amount'))
                            <div class="alert alert-danger">
                                {{ session('picture_amount') }}
                            </div>
                        @endif
                        <form action="\agent\upload_house" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center">
                                @error('filename')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                                @enderror
                                @error('filename[]')
                                <div class="text-danger small">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            {{--             Uploads                   --}}
                            <div class="edit-photo-box py-3">
                                <div class="child-box btn-box ml-2">
                                    <button class="d-block w-100 h-100 btn btn-site text-center"
                                            id="addPictureBtn" type="button">
                                        <i class="fas fa-plus fa-1x"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="list-group-flush mt-3 mx-lg-5">
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
                                                  class="form-control" required></textarea>
                                    </div>
                                </div>
                                {{--              Vicinity                  --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Vicinity:
                                    </div>
                                    <div class="ml-3">
                                        @error('vicinity')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="radio" placeholder="Vicinity" name="vicinity" value="on"><span
                                                class="mr-3">On Campus</span><br/>
                                        <input type="radio" placeholder="Vicinity" name="vicinity" value="off">Off
                                        Campus
                                    </div>
                                </div>
                                {{--            Location                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Location:
                                    </div>
                                    <div class="ml-3">
                                        @error('location')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select class="form-control" name="location" id="#locationSelect" required>
                                            <option value="">Location</option>
                                        </select>
                                    </div>
                                </div>
                                {{--            Type                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Type:
                                    </div>
                                    <div class="ml-3">
                                        @error('lodge_type')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select class="form-control" name="lodge_type">
                                            <option value="">Type</option>
                                            <option value="BQ">BQ</option>
                                            <option value="2 Man BQ">2 Man BQ</option>
                                            <option value="Chain BQ">Chain BQ</option>
                                            <option value="Single Room">Single Room</option>
                                        </select>
                                    </div>
                                </div>
                                {{--            Who can rent                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Who can rent:
                                    </div>
                                    <div class="ml-3">
                                        @error('who_can_rent')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select class="form-control" name="who_can_rent" id="who_can_rent" required>
                                            <option value=""></option>
                                            <option value="All">Anybody</option>
                                            <option value="Jupeb">Jupeb</option>
                                            <option value="Undergraduate">Undergraduate</option>
                                            <option value="Post Graduate">Post Graduate</option>
                                        </select>
                                    </div>
                                </div>
                                {{--            Department(Optional)               --}}
                                <div class="list-group-item d-flex justify-content-between not-for-jupeb">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Department:
                                    </div>
                                    <div class="ml-3">
                                        @error('department')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select class="form-control" name="department" id="department">
                                            <option value=""></option>
                                            <option value="All">All Departments</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->department }}">{{ $department->department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--             Level                   --}}
                                <div class="list-group-item d-flex justify-content-between not-for-jupeb">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Level:
                                    </div>
                                    <div class="ml-3">
                                        @error('level')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select class="form-control" name="level" id="level">
                                            <option value="..."></option>
                                            <option value="All">All Levels</option>
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
                                               placeholder="Price(&#8358;)">
                                    </div>
                                </div>
                                {{--              Rules                  --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Rules:
                                    </div>
                                    <div class="ml-3">
                                        @error('lodge_rules')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="radio" name="lodge_rules" value="yes"><span
                                                class="mr-3">Yes</span><br/>
                                        <input type="radio" name="lodge_rules" value="no" checked>No

                                    </div>
                                </div>
                                <div class="list-group-item d-none lodge-rules">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        <span class="text-danger font-weight-bold">*</span>
                                        <ul id="listedRules">

                                        </ul>
                                    </div>
                                    <div class="ml-3">
                                        @error('rules')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @error('rules[]')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Lodge Rules"/>
                                            <button class="btn btn-success" id="addRuleBtn" type="button">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-site mt-3 btn-block btn-lg" value="Post Lodge">
                            </div>
                        </form>
                        <div class="clone d-none">
                            <div class="col-md-4 mb-3 theEl">
                                <img src="/images/prev_icon.png" id="house_prev" class="img-fluid d-block mx-auto mb-3"
                                     style="width: 100%; height: 200px;">
                                <div class="input-group control-group">
                                    <input type="file" name="filename[]" id="fileBtn" class="form-control">
                                    <div class="input-group-btn ml-2">
                                        <button class="btn btn-danger" id="removeBtn" type="button"><i
                                                    class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none cloned-rule">
                            <div class="input-group mb-3">
                                <input type="text" name="rules[]" class="form-control" placeholder="Lodge Rules"/>
                                <button class="btn btn-danger" id="removeRuleBtn" type="button">
                                    <i class="fas fa-trash"></i>
                                </button>
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
        {{--   Picture Display     --}}
        $("#addPictureBtn").click(function () {
            $(".edit-photo-box").append('<div class="child-box ml-2"><input type="file" name="filename[]">' +
                '<button class="btn btn-danger p-0 child-box-close" type="button">\n' +
                '                                                    <i class="fas fa-times"></i>\n' +
                '                                                </button></div>');
        });
        $("body").on("click", ".child-box .child-box-close", function () {
            // var prop_id = $(this).parent().attr("data-uid");
            var element = $(this);
            element.parent().remove();
        })
        $("body").on("change", "input[name='filename[]']", function () {
            var input = this;
            var element = $(this);
            console.log(element.val());
            readURL(this, element);
        })
        //read url function
        function readURL(input, element) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // element.parent().prev().attr('src', e.target.result);
                    element.parent().css("background", 'url("' + e.target.result + '")').css("background-size", "cover");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Creating new rules field if the button is clicked
        $("#addRuleBtn").click(function () {
            // $(".cloned-rule > .input-group").clone().appendTo($(this).parent().parent());
            $("#listedRules").append('<li class="mb-2"><input type="text" class="form-control" name="rules[]" readonly value="' + $(this).prev().val() + '"></li>');
            $(this).prev().val('');
        })
        $("body").on("click", "#removeRuleBtn", function () {
            $(this).parent().remove();
        })
        $("input[name='lodge_rules']").change(function () {
            if ($(this).val() == 'yes') {
                $(".lodge-rules").removeClass('d-none');
            } else if ($(this).val() == 'no') {
                $(".lodge-rules").addClass('d-none');
            }
        })


        //Price formatting
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

        //Fetch levels based on department
        $('select[name="department"]').change(function () {
            var d = $(this).val();
            if ($(this).val() == '') {
                $('select[name="level"]').empty();
            } else {
                $.ajax({
                    url: "/admin/upload_house/getLevel/" + d,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="level"]').empty();
                        $('select[name="level"]').append('<option value="All">All levels</option>');
                        i = 100;
                        while (i <= parseInt(data[0].level)) {
                            $('select[name="level"]').append('<option value="' + i + '">' + i + ' level</option>');
                            i += 100;
                        }
                    }
                })
            }
        })
        //For jupeb remove some fields
        $('select[name="who_can_rent"]').change(function () {
            if ($(this).val() == 'Jupeb') {
                $('.not-for-jupeb').removeClass('d-flex');
                $('.not-for-jupeb').addClass('d-none');
                $('.not-for-jupeb').removeClass('justify-content-between');
            } else {
                $('.not-for-jupeb').addClass('d-flex');
                $('.not-for-jupeb').addClass('justify-content-between');
                $('.not-for-jupeb').removeClass('d-none');
            }
        })
    </script>
@endsection