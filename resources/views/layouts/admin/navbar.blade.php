<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/admin">
        <img src="/images/logo6.png" class="img-fluid" width="100" height="100">
    </a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form action="/admin/search/users" method="post" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" name="search_item" placeholder="Search for..." aria-label="Search"
                   aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle d-flex justify-content-start" href="#" id="messagesDropdown"
               role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle d-flex justify-content-start" href="#" id="alertsDropdown" role="button"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                @php
                    $notifications = auth()->user()->notification()->where('status','unread')->orderBy('created_at','desc')->get();
                @endphp
                <span class="badge badge-danger">{{ count($notifications) }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right custom-notification-box" aria-labelledby="alertsDropdown">
                @foreach($notifications as $notification)
                    <a class="dropdown-item "
                       href="{{ $notification->link }}"><span><br/>
                            {{ $notification->message }}</span> <span class="small text-secondary">{{ $notification->created_at->diffForHumans() }}</span></a>
                @endforeach
                {{--                <div class="dropdown-divider"></div>--}}
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex justify-content-start" href="#" id="userDropdown" role="button"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li>
    </ul>

</nav>
