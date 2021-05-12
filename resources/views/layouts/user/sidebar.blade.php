<div class="col-lg-3 mt-3 d-none d-lg-block">
    <div class="card">
        <div class="card-body user-sidebar p-0 shadow-sm">
            <a href="/user/account/index"
               class="{{ (request()->is('user/account*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                <i class="far fa-user ml-2 mr-4 mt-1"></i>
                My Account
            </a>
            @if(auth()->user()->is_agent == 1)
                <a href="/agent/kyc"
                   class="{{ (request()->is('agent/kyc*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                    <i class="far fa-address-card ml-2 mr-4 mt-1"></i>
                    Verify your profile
                    @php
                        $verification_notifications = auth()->user()->notification()->where([
                        ['notification_type','=','admin_response_agent_verification'],
                        ['status','=','unread']
                        ])->get();
                    @endphp
                    @if(count($verification_notifications) == 0)

                    @else
                        <span class="badge badge-danger">{{ count($verification_notifications) }}</span>
                    @endif
                </a>
                <a href="/agent/upload_house"
                   class="{{ (request()->is('agent/upload_house*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                    <i class="fas fa-home ml-2 mr-4 mt-1"></i>
                    UPLOAD A HOUSE
                </a>
                <a href="#" id="manageHousesToggler"
                   class="{{ (request()->is('agent/houses*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                    <i class="fas fa-user-cog ml-2 mr-4 mt-1"></i>
                    MANAGE HOUSES
                    @php
                        $lodge_notifications = auth()->user()->notification()->where([
                        ['notification_type','=','admin_response_lodge_verification'],
                        ['status','=','unread']
                        ])->get();
                    @endphp
                    @if(count($lodge_notifications) == 0)
                    @else
                        <span class="ml-1 badge badge-danger my-1"
                              style="border-radius: 50%;">{{ count($lodge_notifications) }}</span>
                    @endif

                </a>
                <div id="manageHousesDropdown" class="list-group-flush px-4 d-none">
                    <a href="/agent/houses/approved" class="list-group-item d-flex justify-content-start text-dark">
                        <i class="fas fa-check text-success mt-1"></i>
                        <span class="mx-2">Approved Lodges</span>
                    </a>
                    <a href="/agent/houses/pending" class="list-group-item d-flex justify-content-start text-dark">
                        <i class="fas fa-spinner text-warning mt-1"></i>
                        <span class="mx-2">Pending Lodges</span>
                    </a>
                    <a href="/agent/houses/denied" class="list-group-item d-flex justify-content-start text-dark">
                        <i class="fas fa-times-circle text-danger mt-1"></i>
                        <span class="mx-2">Denied Lodges</span>
                    </a>
                    <a href="/agent/houses/expired" class="list-group-item d-flex justify-content-start text-dark">
                        <i class="fas fa-times text-danger mt-1"></i>
                        <span class="mx-2">Expired Lodges</span>
                    </a>
                </div>
            @endif

            <a href="/user/saved_lodges"
               class="{{ (request()->is('user/saved_lodges*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                <i class="fas fa-heart text-danger ml-2 mr-4 mt-1"></i>
                Saved Lodges
            </a>
            <a href="/user/saved_properties"
               class="{{ (request()->is('user/saved_properties*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                <i class="fas fa-box-open text-danger ml-2 mr-4 mt-1"></i>
                Saved Properties
            </a>
            <a href="/user/properties/upload"
               class="{{ (request()->is('user/properties/upload*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                <i class="fas fa-box text-site ml-2 mr-4 mt-1"></i>
                Sell Properties
            </a>
            <a href="#" id="managePropertiesToggler"
               class="{{ (request()->is('user/properties/*')) ? 'sidebar-active text-light':'bg-light text-dark' }} d-block w-100 px-4 py-3 d-flex justify-content-start">
                <i class="fas fa-box-open ml-2 mr-4 mt-1"></i>
                MANAGE PROPERTIES
                @php
                    $property_notifications = auth()->user()->notification()->where([
                    ['notification_type','=','property_pending_notification'],
                    ['status','=','unread']
                    ])->get();
                @endphp
                @if(count($property_notifications) == 0)
                @else
                    <span class="ml-1 badge badge-danger my-1"
                          style="border-radius: 50%;">{{ count($property_notifications) }}</span>
                @endif

            </a>
            <div id="managePropertiesDropdown" class="list-group-flush px-4 d-none">
                <a href="/user/properties/approved" class="list-group-item d-flex justify-content-start text-dark">
                    <i class="fas fa-check text-success mt-1"></i>
                    <span class="mx-2">Approved Properties</span>
                </a>
                <a href="/user/properties/pending" class="list-group-item d-flex justify-content-start text-dark">
                    <i class="fas fa-spinner text-warning mt-1"></i>
                    <span class="mx-2">Pending Properties</span>
                </a>
                <a href="/user/properties/denied" class="list-group-item d-flex justify-content-start text-dark">
                    <i class="fas fa-times-circle text-danger mt-1"></i>
                    <span class="mx-2">Denied Properties</span>
                </a>
                <a href="/user/properties/expired" class="list-group-item d-flex justify-content-start text-dark">
                    <i class="fas fa-times text-danger mt-1"></i>
                    <span class="mx-2">Expired Properties</span>
                </a>
            </div>
            {{--            <a href="#"--}}
            {{--               class="{{ (request()->is('someurl*')) ? 'sidebar-active':'bg-light' }} d-block w-100 px-4 py-3 text-dark d-flex justify-content-start">--}}
            {{--                <i class="fas fa-icons ml-2 mr-4 mt-1"></i>--}}
            {{--                Write Up--}}
            {{--            </a>--}}
            <a href="javascript:void(0)" class="bg-light d-block w-100 px-4 py-3 text-dark d-flex justify-content-start"
               onclick="document.getElementById('logout-form').submit()">
                <i class="fas fa-sign-out-alt ml-2 mr-4 mt-1"></i>
                Logout
            </a>
            <form method="post" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>