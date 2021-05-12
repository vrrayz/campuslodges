<ul class="sidebar navbar-nav">
    {{--  Dashboard  --}}
    <li class="nav-item ">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    {{--  Agents  --}}
    <li class="nav-item {{ (request()->is('admin/agent*')? 'active':'') }}">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-user-secret"></i>
            <span>Agents</span>
        </a>
    </li>
    {{--  Upload LodgeSpot  --}}
    <li class="nav-item {{ (request()->is('admin/lodgespots*')? 'active':'') }}">
        <a class="nav-link" href="/admin/lodgespots">
            <i class="fas fa-fw fa-map-marker-alt"></i>
            <span>LodgeSpots</span>
        </a>
    </li>
    {{--  Upload Room Type  --}}
    <li class="nav-item {{ (request()->is('admin/room_types*')? 'active':'') }}">
        <a class="nav-link" href="/admin/room_types">
            <i class="fas fa-fw fa-bed"></i>
            <span>Rooms</span>
        </a>
    </li>
    {{--  Lodges  --}}
    <li class="nav-item {{ (request()->is('admin/lodges*')? 'active':'') }}">
        <a class="nav-link" href="/admin/lodges">
            <i class="fas fa-fw fa-home"></i>
            <span>Lodges</span>
        </a>
    </li>
    {{--  Properties  --}}
    <li class="nav-item {{ (request()->is('admin/properties*')? 'active':'') }}">
        <a class="nav-link" href="/admin/properties">
            <i class="fas fa-fw fa-chair"></i>
            <span>Properties</span>
        </a>
    </li>
{{--    <li class="nav-item dropdown">--}}
{{--        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"--}}
{{--           aria-haspopup="true" aria-expanded="false">--}}
{{--            <i class="fas fa-fw fa-folder"></i>--}}
{{--            <span>Pages</span>--}}
{{--        </a>--}}
{{--        <div class="dropdown-menu" aria-labelledby="pagesDropdown">--}}
{{--            <h6 class="dropdown-header">Login Screens:</h6>--}}
{{--            <a class="dropdown-item" href="login.html">Login</a>--}}
{{--            <a class="dropdown-item" href="register.html">Register</a>--}}
{{--            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>--}}
{{--            <div class="dropdown-divider"></div>--}}
{{--            <h6 class="dropdown-header">Other Pages:</h6>--}}
{{--            <a class="dropdown-item" href="404.html">404 Page</a>--}}
{{--            <a class="dropdown-item" href="blank.html">Blank Page</a>--}}
{{--        </div>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="charts.html">--}}
{{--            <i class="fas fa-fw fa-chart-area"></i>--}}
{{--            <span>Charts</span></a>--}}
{{--    </li>--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="tables.html">--}}
{{--            <i class="fas fa-fw fa-table"></i>--}}
{{--            <span>Tables</span></a>--}}
{{--    </li>--}}
</ul>