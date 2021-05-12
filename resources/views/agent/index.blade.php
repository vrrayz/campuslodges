@extends('layouts.agent.master')
@section('main')
    <div class="container mb-3">
        <div class="row">
            @include('layouts.agent.sidebar')
            <div class="col-md-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <h5>AGENT DASHBOARD DETAILS</h5>
                            <img src="\images\user_default.jpg" class="img-fluid" width="200" height="200"
                                 style="border-radius: 50%;">
                        </div>
                        <form action="\agent\profile\update" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="list-group-flush mt-3 mx-lg-5">
                                {{--            First Name                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        First Name:
                                    </div>
                                    <div class="ml-3">
                                        @error('first_name')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name"
                                               value="{{ auth()->user()->first_name }}">
                                    </div>
                                </div>
                                {{--            Last Name                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Last Name:
                                    </div>
                                    <div class="ml-3">
                                        @error('last_name')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                               value="{{ auth()->user()->last_name }}">
                                    </div>
                                </div>
                                {{--            Username                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Username:
                                    </div>
                                    <div class="ml-3">
                                        <input type="text" class="form-control" placeholder="Username" name="username"
                                               value="{{ auth()->user()->username }}" disabled>
                                    </div>
                                </div>
                                {{--            Email                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Email:
                                    </div>
                                    <div class=ml-3">
                                        <input type="email" name="email" class="form-control"
                                               value="{{ auth()->user()->email }}"
                                               placeholder="someone@example.com" disabled>
                                    </div>
                                </div>
                                {{--            Phone No                --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Phone No:
                                    </div>
                                    <div class="ml-3">
                                        @error('phone_number')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" name="phone_number" class="form-control"
                                               value="{{ auth()->user()->phone_no }}"
                                               placeholder="Phone Number">
                                    </div>
                                </div>
                                {{--            Occupation               --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Occupation:
                                    </div>
                                    <div class="bg-light ml-3">
                                        @error('occupation')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <select name="occupation" class="form-control">
                                            <option value="">...</option>
                                            <option value="student">Student</option>
                                            <option value="non_student">Non Student</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="for_student">
                                    {{--            Programme               --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Programme:
                                        </div>
                                        <div class="ml-3">
                                            @error('programme')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <select name="programme" class="form-control">
                                                <option value="{{ auth()->user()->programme }}">{{ auth()->user()->programme }}</option>
                                                <option value="">...</option>
                                                <option value="Jupeb">Jupeb</option>
                                                <option value="Undergraduate">Undergraduate</option>
                                                <option value="Masters">Masters</option>
                                                <option value="Sandwich">Sandwich</option>
                                                <option value="Post Graduate">Post Graduate</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--            Department               --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Department:
                                        </div>
                                        <div class=" ml-3">
                                            @error('department')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input type="text" placeholder="Department" name="department"
                                                   value="{{ auth()->user()->department }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    {{--            Level               --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Level:
                                        </div>
                                        <div class="ml-3">
                                            @error('level')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input type="text" placeholder="Level" name="level" class="form-control"
                                                   value="{{ auth()->user()->level }}">
                                        </div>
                                    </div>
                                    {{--            Reg No               --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Reg No:
                                        </div>
                                        <div class="ml-3">
                                            @error('reg_no')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input type="text" placeholder="Reg Number" name="reg_no"
                                                   class="form-control"
                                                   value="{{ auth()->user()->reg_no }}">
                                        </div>
                                    </div>

                                </div>
                                <div id="for_non_student">
                                    {{--             Occupation Description                   --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Occupation Description:
                                        </div>
                                        <div class="bg-light ml-3">
                                            @error('occupation_description')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input type="text" placeholder="Occupation Description"
                                                   name="occupation_description"
                                                   value="{{ auth()->user()->occupation_description }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    {{--             Means Of ID                   --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Means Of Identification:
                                        </div>
                                        <div class="ml-3">
                                            @error('means_of_id')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <select class="form-control" name="means_of_id">
                                                <option value="{{ auth()->user()->kyc->means_of_id }}">{{ auth()->user()->kyc->means_of_id }}</option>
                                                <option value="...">...</option>
                                                <option value="International Passport">International Passport</option>
                                                <option value="Driver's License">Driver's License</option>
                                                <option value="National ID">National ID</option>
                                                <option value="Voter's ID">Voter's ID</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--             ID Number                   --}}
                                    <div class="list-group-item d-flex justify-content-between">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            Valid ID Number:
                                        </div>
                                        <div class="bg-light ml-3">
                                            @error('id_number')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input type="text" placeholder="ID Number" name="id_number"
                                                   value="{{ auth()->user()->kyc->id_number }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                {{--            ID Card               --}}
                                @if(auth()->user()->kyc->id_photo == '' || auth()->user()->kyc->id_photo == null)
                                    <div class="list-group-item d-flex justify-content-between" id="id_card_panel">
                                        <div class="font-weight-bold mr-3 mt-2">
                                            <span id="what_to_upload">Upload School ID / Admission Letter:</span>
                                        </div>
                                        <div class="ml-3">
                                            @error('id_card')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input class="form-control" name="id_card" id="id_card" type="file"/>
                                            <br/>
                                            <img src="/images/prev_icon.png" id="blah"
                                                 class="img-fluid d-block mt-3 mx-auto" width="200" height="200">
                                            <br/>
                                        </div>
                                    </div>
                                @endif
                                {{--            State Of Origin               --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        State Of Origin:
                                    </div>
                                    <div class="bg-light ml-3">
                                        @error('state_of_origin')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" placeholder="State" name="state_of_origin"
                                               class="form-control" value="{{ auth()->user()->state_of_origin }}">
                                    </div>
                                </div>
                                {{--            LGA Of Origin               --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        LGA Of Origin:
                                    </div>
                                    <div class="ml-3">
                                        @error('lga_of_origin')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" placeholder="LGA" name="lga_of_origin" class="form-control"
                                               value="{{ auth()->user()->lga_of_origin }}">
                                    </div>
                                </div>
                                {{--            Hometown               --}}
                                <div class="list-group-item d-flex justify-content-between mb-3">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Hometown:
                                    </div>
                                    <div class="ml-3">
                                        @error('hometown')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" placeholder="Hometown" name="hometown" class="form-control"
                                               value="{{ auth()->user()->hometown }}">
                                    </div>
                                </div>
                                {{--             Residential Address                   --}}
                                <div class="list-group-item d-flex justify-content-between">
                                    <div class="font-weight-bold mr-3 mt-2">
                                        Residential Address:
                                    </div>
                                    <div class="ml-3">
                                        @error('residential_address')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <input type="text" placeholder=" Residential Address"
                                               name="residential_address"
                                               value="{{ auth()->user()->kyc->residential_address }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-outline-primary btn-lg" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#id_card_panel").removeClass("d-flex");
        $("#id_card_panel").addClass("d-none");

        $('select[name="occupation"]').change(function () {
            if ($(this).val() == "student"){
                $("#id_card_panel").addClass("d-flex");
                $("#id_card_panel").removeClass("d-none");
                $("#what_to_upload").text("Upload School ID / Admission Letter");
            } else if ($(this).val() == "non_student"){
                $("#id_card_panel").addClass("d-flex");
                $("#id_card_panel").removeClass("d-none");
                $("#what_to_upload").text("National ID / International Passport / Driver's License / Voter's Card: ");
            }
        })
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#id_card").change(function () {
            readURL(this);
        });
    </script>
@endsection