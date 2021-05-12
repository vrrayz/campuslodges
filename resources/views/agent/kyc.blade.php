@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--      Sidebar      --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center">
                                    @if(session('upload_success'))
                                        <div class="alert alert-success">
                                            {{ session('upload_success') }}
                                        </div>
                                    @endif
                                    @if(auth()->user()->kyc->id_photo == null || auth()->user()->kyc->id_photo == '' )
                                        <img src="/images/id_sample.png" id="blah"
                                             class="img-fluid d-block mt-3 mx-auto w-100"
                                             height="200">
                                    @else
                                        <img src="/agents_id/{{ auth()->user()->kyc->id_photo }}" id="blah"
                                             class="img-fluid d-block mt-3 mx-auto w-100" height="200">
                                    @endif
                                    @if(auth()->user()->kyc->is_validated)
                                        <div class="text-success small">
                                            Verified
                                        </div>
                                    @else
                                        <div class="text-warning small">
                                            Verification Pending
                                        </div>
                                        <form action="/agent/kyc" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @error('id_card')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <input class="form-control" name="id_card" id="id_card" type="file"/>
                                            <br/>
                                            <input class="btn btn-primary" type="submit" value="Upload">
                                        </form>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="\agent\profile\update" method="post">
{{--                                    {{ method_field('PUT') }}--}}
                                    @csrf
                                    <div class="row mx-3">
                                        {{--            Occupation                  --}}
                                        <div class="col-md-12">
                                            @error('occupation')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <div class="form-group focused">
                                                <label class="form-label" for="occupation">Occupation</label>
                                                <select class="form-control bg-transparent border-bottom-1 filled"
                                                        name="occupation" id="occupation">
                                                    <option value="">...</option>
                                                    <option value="student">Student</option>
                                                    <option value="non_student">Non Student</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="for_student" class="col-md-12">
                                            {{--            Programme               --}}
                                            <div class="col-md-12">
                                                @error('programme')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="programme">Programme</label>
                                                    <select class="form-control bg-transparent border-bottom-1 filled"
                                                            name="programme" id="programme">
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
                                            <div class="col-md-12">
                                                @error('department')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="department">Department</label>
                                                    <input type="text"
                                                           class="form-control bg-transparent border-bottom-1 filled"
                                                           name="department"
                                                           id="department" value="{{ auth()->user()->department }}">
                                                </div>
                                            </div>
                                            {{--             Level                               --}}
                                            <div class="col-md-12">
                                                @error('level')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="level">Level</label>
                                                    <input type="text"
                                                           class="form-control bg-transparent border-bottom-1 filled"
                                                           name="level"
                                                           id="level" value="{{ auth()->user()->level }}">
                                                </div>
                                            </div>
                                            {{--            Reg No               --}}
                                            <div class="col-md-12">
                                                @error('reg_no')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="reg_no">Reg Number</label>
                                                    <input type="text"
                                                           class="form-control bg-transparent border-bottom-1 filled"
                                                           name="reg_no"
                                                           id="reg_no" value="{{ auth()->user()->reg_no }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="for_non_student" class="col-md-12">
                                            {{--             Occupation Description                   --}}
                                            <div class="col-md-12">
                                                @error('occupation_description')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="occupation_description">Occupation
                                                        Description</label>
                                                    <input type="text"
                                                           class="form-control bg-transparent border-bottom-1 filled"
                                                           name="occupation_description"
                                                           id="occupation_description"
                                                           value="{{ auth()->user()->occupation_description }}">
                                                </div>
                                            </div>
                                            {{--             Means Of ID                   --}}
                                            <div class="col-md-12">
                                                @error('means_of_id')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="means_of_id">Means Of
                                                        Identification</label>
                                                    <select class="form-control bg-transparent border-bottom-1 filled"
                                                            name="means_of_id" id="means_of_id">
                                                        <option value="{{ auth()->user()->kyc->means_of_id }}">{{ auth()->user()->kyc->means_of_id }}</option>
                                                        <option value="...">...</option>
                                                        <option value="International Passport">International Passport
                                                        </option>
                                                        <option value="Driver's License">Driver's License</option>
                                                        <option value="National ID">National ID</option>
                                                        <option value="Voter's ID">Voter's ID</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{--             ID Number                   --}}
                                            <div class="col-md-12">
                                                @error('id_number')
                                                <div class="text-danger small">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <div class="form-group focused">
                                                    <label class="form-label" for="id_number"> Valid ID Number</label>
                                                    <input type="text"
                                                           class="form-control bg-transparent border-bottom-1 filled"
                                                           name="id_number"
                                                           id="id_number"
                                                           value="{{ auth()->user()->id_number }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-site btn-block shadow">Save</button>
                                </form>
                            </div>
                            <div class="col-md-6">
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
    </div>
@endsection
@section('scripts')
    <script>
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
        $("#for_student").hide();
        $("#for_non_student").hide();
        $('select[name="occupation"]').change(function () {
            if ($(this).val() == 'student') {
                $("#for_student").show();
                $("#for_non_student").hide();
            } else if ($(this).val() == 'non_student') {
                $("#for_non_student").show();
                $("#for_student").hide();
            } else {
                $("#for_student").hide();
                $("#for_non_student").hide();
            }
        })
    </script>
@endsection