@extends('layouts.app')
@section('main')
    <div class="container mb-3">
        <div class="row">
            {{--    Sidebar        --}}
            @include('layouts.user.sidebar')
            <div class="col-lg-9 mt-3 mb-3 pb-2">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mt-2 font-weight-normal">
                            Details
                        </h4>
                        @if(count($errors))
                            <div class="alert alert-danger py-1">
                                <ul style="list-style-type: none;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/user/address/edit" method="post">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row mx-3">
                                {{--            Programme               --}}
                                <div class="col-md-4">
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
                                <div class="col-md-4 not-for-jupeb {{ (auth()->user()->programme == 'Jupeb') ? 'd-none':'' }}">
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
                                <div class="col-md-4 not-for-jupeb {{ (auth()->user()->programme == 'Jupeb') ? 'd-none':'' }}">
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
                                {{--            State Of Origin                  --}}
                                <div class="col-md-4">
                                    <div class="form-group focused">
                                        <label class="form-label" for="state_of_origin">State Of Origin</label>
                                        <select class="form-control bg-transparent border-bottom-1 filled" name="state_of_origin" id="state_of_origin">
                                            @if(auth()->user()->state_of_origin != null)
                                                <option value="{{ auth()->user()->state_of_origin }}">{{ auth()->user()->state_of_origin }}</option>
                                            @endif
                                            <option value=""></option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>
                                            <option value="Cross River">Cross River</option>
                                            <option value="Delta">Delta</option>
                                            <option value="Ebonyi">Ebonyi</option>
                                            <option value="Edo">Edo</option>
                                            <option value="Ekiti">Ekiti</option>
                                            <option value="Enugu">Enugu</option>
                                            <option value="Federal Capital Territory">Federal Capital Territory</option>
                                            <option value="Gombe">Gombe</option>
                                            <option value="Imo">Imo</option>
                                            <option value="Jigawa">Jigawa</option>
                                            <option value="Kaduna">Kaduna</option>
                                            <option value="Kano">Kano</option>
                                            <option value="Katsina">Katsina</option>
                                            <option value="Kebbi">Kebbi</option>
                                            <option value="Kogi">Kogi</option>
                                            <option value="Kwara">Kwara</option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Nasarawa">Nasarawa</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Ogun">Ogun</option>
                                            <option value="Ondo">Ondo</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Plateau">Plateau</option>
                                            <option value="Rivers">Rivers</option>
                                            <option value="Sokoto">Sokoto</option>
                                            <option value="Taraba">Taraba</option>
                                            <option value="Yobe">Yobe</option>
                                            <option value="Zamfara">Zamfara</option>
                                        </select>
                                    </div>
                                </div>
                                {{--            LGA Of Origin                  --}}
                                <div class="col-md-4">
                                    <div class="form-group focused">
                                        <label class="form-label" for="lga_of_origin">L.G.A</label>
                                        <select class="form-control bg-transparent border-bottom-1 filled" name="lga_of_origin" id="lga_of_origin">
                                            @if(auth()->user()->lga_of_origin != null)
                                                <option value="{{ auth()->user()->lga_of_origin }}">{{ auth()->user()->lga_of_origin }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                {{--            Hometown                  --}}
                                <div class="col-md-4">
                                    <div class="form-group focused">
                                        <label class="form-label" for="hometown">Hometown</label>
                                        <input type="text" class="form-control bg-transparent border-bottom-1 filled" name="hometown"
                                               id="hometown" value="{{ auth()->user()->hometown }}">
                                    </div>
                                </div>
                                {{--            Residential Address                  --}}
                                <div class="col-md-12">
                                    <div class="form-group focused">
                                        <label class="form-label" for="residential_address">Residential Address</label>
                                        <input type="text" class="form-control bg-transparent border-bottom-1 filled" name="residential_address"
                                               id="residential_address" value="{{ auth()->user()->kyc->residential_address }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-site btn-block shadow">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("select[name='state_of_origin']").change(function () {
            $.ajax({
                url: "/user/address/state/"+$(this).val(),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="lga_of_origin"]').empty();
                    $('select[name="lga_of_origin"]').append('<option value="">Select City</option>');
                    $.each(data,function (key,value) {
                        $('select[name="lga_of_origin"]').append('<option value="'+value+'">'+value+'</option>');
                    })
                }
            })
        })
        $("select[name='programme']").change(function(){
            if ($(this).val() == 'Jupeb'){
                $('.not-for-jupeb').addClass('d-none');
            }else{
                $('.not-for-jupeb').removeClass('d-none');
            }
        })
    </script>
@endsection