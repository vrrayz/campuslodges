<div class="sidebar-shade d-none">

    <div class="outside" onclick="toggleSidebar()">

    </div>
    <nav class="sidebar">
        <div class="d-flex justify-content-start pt-2 pl-3 pb-2 shadow-sm" style="background-color: rgba(240, 191, 4,.3)">
            <button class="btn btn-site-transparent border-0 py-0 pl-0" onclick="toggleSidebar()">
                <i class="fas fa-toggle-on text-site"></i>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/logo2.png" width="100" height="100"
                                                  class="img-fluid"></a>

        </div>
        <a href="/user/account/index" class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
            <i class="fas fa-user-circle text-secondary mt-1 mr-3 fa-fw"></i>
            My Account
        </a>
        @if(auth()->user())
            @if(auth()->user()->is_agent == 1)
                <a href="/agent/kyc" class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
                    <i class="fas fa-id-card text-secondary mt-1 mr-3 fa-fw"></i>
                    Verify your profile
                </a>
                <a href="/agent/upload_house"
                   class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
                    <i class="fas fa-home text-secondary mt-1 mr-3 fa-fw"></i>
                    Upload a lodge
                </a>
                {{--     Manage House Dropdown   --}}
                <a href="javascript:void(0)" data-toggle="customDropdown" data-target="manageHouseDropdown"
                   class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
                    <i class="fas fa-user-cog text-secondary mt-1 mr-3 fa-fw"></i>
                    Manage Lodges
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
                <div id="manageHouseDropdown" class="d-none">
                    <a href="/agent/houses/approved"
                       class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                        <i class="fas fa-check text-secondary mt-1 mr-3 fa-fw"></i>
                        Approved Lodges
                    </a>
                    <a href="/agent/houses/pending"
                       class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                        <i class="fas fa-spinner text-warning mt-1 mr-3 fa-fw"></i>
                        Pending Lodges
                    </a>
                    <a href="/agent/houses/denied"
                       class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                        <i class="fas fa-times text-danger mt-1 mr-3 fa-fw"></i>
                        Denied Lodges
                    </a>
                    <a href="/agent/houses/expired"
                       class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                        <i class="fas fa-exclamation text-danger mt-1 mr-3 fa-fw"></i>
                        Expired Lodges
                    </a>
                </div>
            @endif
            <a href="/user/saved_lodges" class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
                <i class="fas fa-heart text-danger mt-1 mr-3 fa-fw"></i>
                Saved Lodges
            </a>
        @endif
        {{--    Properties dropdown    --}}
        <a href="#" data-toggle="customDropdown" data-target="propertyDropdown"
           class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
            <i class="fab fa-houzz text-secondary mt-1 mr-3 fa-fw"></i>
            Properties
        </a>
        <div id="propertyDropdown" class="d-none">
            <a href="/props" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                <i class="fas fa-exchange-alt text-secondary mt-1 mr-3 fa-fw"></i>
                Buy Properties
            </a>
            <a href="/user/properties/upload"
               class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                <i class="fas fa-exchange-alt text-danger mt-1 mr-3 fa-fw"></i>
                Sell Properties
            </a>
            <a href="/user/saved_properties"
               class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                <i class="fas fa-heart text-danger mt-1 mr-3 fa-fw"></i>
                Saved Properties
            </a>
            {{--      Manage Property Dropdown      --}}
            <a href="javascript:void(0)" data-toggle="customDropdown" data-target="managePropertyDropdown"
               class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                <i class="fas fa-box-open text-danger mt-1 mr-3 fa-fw"></i>
                Manage Properties
            </a>
            <div class="d-none" id="managePropertyDropdown">
                <a href="/user/properties/approved" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                    <i class="fas fa-check text-success mt-1 mr-3 fa-fw"></i>
                    Approved Properties
                </a>
                <a href="/user/properties/pending" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                    <i class="fas fa-spinner text-secondary mt-1 mr-3 fa-fw"></i>
                    Pending Properties
                </a>
                <a href="/user/properties/denied" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                    <i class="fas fa-times-circle text-secondary mt-1 mr-3 fa-fw"></i>
                    Denied Properties
                </a>
                <a href="/user/properties/expired" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                    <i class="fas fa-exclamation text-secondary mt-1 mr-3 fa-fw"></i>
                    Denied Properties
                </a>
            </div>
        </div>

        <a href="/about" class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
            <i class="fas fa-info-circle text-site mt-1 mr-3 fa-fw"></i>
            About Us
        </a>
        {{--    Agent Dropdown    --}}
        <a href="#" data-toggle="customDropdown" data-target="agentDropdown"
           class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
            <i class="fas fa-users text-danger mt-1 mr-3 fa-fw"></i>
            Agents
        </a>
        <div id="agentDropdown" class="d-none">
            <a href="#" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                <i class="fas fa-thumbs-up text-secondary mt-1 mr-3 fa-fw"></i>
                Our trusted agents
            </a>
            <a href="#" class="sidebar-link d-flex py-2 pl-4 mt-1 justify-content-start text-dark">
                <i class="fas fa-user-plus text-danger mt-1 mr-3 fa-fw"></i>
                Become an agent
            </a>
        </div>
        <a href="/contact" class="sidebar-link d-flex py-3 pl-3 mt-1 justify-content-start text-dark">
            <i class="fas fa-phone-alt text-site mt-1 mr-3 fa-fw"></i>
            Contact Us
        </a>
    </nav>
</div>
