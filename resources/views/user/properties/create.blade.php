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
                            <h5>PROPERTIES DETAILS</h5>
                            <h5>Uploads</h5>
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
                        <form action="/user/properties/upload" method="post" enctype="multipart/form-data">
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
                                               placeholder="Name of the item"/>
                                    </div>
                                </div>
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
                                               placeholder="Item Category"/>
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
                                               placeholder="Price(&#8358;)">
                                    </div>
                                </div>

                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-site btn-block mt-3 btn-lg" value="Post property">
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
        $("#addPictureBtn").click(function () {
            $(".edit-photo-box").append('<div class="child-box ml-2"><input type="file" name="filename[]">' +
                '<button class="btn btn-danger p-0 child-box-close" type="button">\n' +
                '                                                    <i class="fas fa-times"></i>\n' +
                '                                                </button></div>');
        });
        $("body").on("click",".child-box .child-box-close",function () {
            // var prop_id = $(this).parent().attr("data-uid");
            var element = $(this);
            element.parent().remove();
        })
        $("body").on("change","input[name='filename[]']",function () {
            var input = this;
            var element = $(this);
            console.log(element.val());
            readURL(this, element);
        })


        $("#addBtn").click(function () {
            var html = $(this).parent().parent().parent();
            $(".clone > .theEl").clone().appendTo(html.parent());
            // $(".increment").after(html);
        });
        $("body").on("click", "#removeBtn", function () {
            // alert("sh");
            $(this).parent().parent().parent().remove();
        });
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

        function readURL(input, element) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    // element.parent().prev().attr('src', e.target.result);
                    element.parent().css("background",'url("'+e.target.result+'")').css("background-size","cover");
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("body").on("change", "#fileBtn", function () {
            readURL(this, $(this));
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
    </script>
@endsection