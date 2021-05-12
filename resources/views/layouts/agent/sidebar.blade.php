<div class="col-lg-3 mt-3 d-none d-lg-block">
    <div class="card">
        <div class="card-body user-sidebar p-0 shadow-sm">
            <a href="\agent\profile"
               class="{{ (request()->is('agent/profile*')) ? 'sidebar-active':'bg-light' }} d-block w-100 px-4 py-3 text-dark d-flex justify-content-start">
                MY PROFILE

            </a>
            <a href="\agent\kyc"
               class="{{ (request()->is('agent/kyc*')) ? 'sidebar-active':'bg-light' }} d-block w-100 px-4 py-3 text-dark ">
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
            <a href="\agent\upload_house"
               class="{{ (request()->is('agent/upload_house*')) ? 'sidebar-active':'bg-light' }} d-block w-100 px-4 py-3 text-dark d-flex justify-content-start">
                UPLOAD A HOUSE
                @php
                    $verification_notifications = auth()->user()->notification()->where([
                    ['notification_type','=','admin_response_lodge_verification'],
                    ['status','=','unread']
                    ])->get();
                @endphp
                @if(count($verification_notifications) == 0)

                @else
                    <span class="badge badge-danger">{{ count($verification_notifications) }}</span>
                @endif
            </a>
            <a href="\agent\houses"
               class="{{ (request()->is('agent/houses*')) ? 'sidebar-active':'bg-light' }} d-block w-100 px-4 py-3 text-dark d-flex justify-content-star">
                MANAGE HOUSES
            </a>
            <a href="#"
               class="{{ (request()->is('/help*')) ? 'sidebar-active':'bg-light' }} d-block w-100 px-4 py-3 text-dark d-flex justify-content-star">
                REQUEST HELP
            </a>

        </div>
    </div>
</div>
