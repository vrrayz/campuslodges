<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>CampusLodge</title>
    @include('layouts.styles')
    @yield('extra-styles')
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: rgba(240, 191, 4,.3)">
    <div class="col-xs-6">
        <div class="d-flex justify-content-start">
            <button class="btn btn-site-transparent text-secondary border-0 py-0 pl-0 d-lg-none" onclick="toggleSidebar()">
                <i class="fas fa-toggle-off"></i>
            </button>
            <a class="navbar-brand" href="/"><img src="/images/logo2.png" width="100" height="100"
                                                  class="img-fluid"></a>

        </div>
    </div>
    @if(auth()->user())
        <div class="col-xs-6 d-lg-none">
            <div class="d-flex justify-content-end">
                <a class="mr-3 text-secondary" href="javascript:void(0)" onclick="document.getElementById('logout-form').submit()"><i
                            class="fas fa-sign-out-alt fa-1x"></i></a>
                <form method="post" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    @endif


    {{--  Laptop Navigation  --}}
    <div class="collapse navbar-collapse d-sm-none font-weight-bold " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            @if(auth()->user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Hi, {{ auth()->user()->first_name }}</a>
                    <div class="dropdown-menu" aria-labelledby="userDropDown">
                        <a class="dropdown-item d-flex justify-content-start" href="/user/account/index"><span
                                    class="fas fa-user-alt mr-3 mt-1"></span>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-site text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/about">About Us</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="propertiesDropdown" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Properties
                </a>
                <div class="dropdown-menu" aria-labelledby="propertiesDropdown">
                    <a href="/props" class="dropdown-item d-flex justify-content-start">
                        Buy Properties
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/user/properties/upload" class="dropdown-item d-flex justify-content-start">
                        Sell Properties
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="agentDropdown" role="button" data-toggle="dropdown"
                   href="#">Agents</a>
                <div class="dropdown-menu" aria-labelledby="agentDropdown">
                    <a href="#" class="dropdown-item d-flex justify-content-start">
                        Our Trusted Agents
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/agent" class="dropdown-item d-flex justify-content-start">
                        Become an agent
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>

            @if(!auth()->user())
                <li class="nav-item">
                    <a class="btn btn-site text-light mx-1" id="regBtn" href="/register">Register</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-site mx-1" id="logBtn" href="/login">Login</a>
                </li>
            @endif

        </ul>
        {{--        <form class="form-inline my-2 my-lg-0">--}}
        {{--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
        {{--            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
        {{--        </form>--}}
    </div>
</nav>
{{-- Home Page Mobile Nav--}}
@include('layouts.homepage.mobileNav')
<main>
    @yield('main')
</main>
<footer class="page-footer">
    <div class="container-fluid bg-dark p-3">
        <div class="row mt-4">
            <div class="col-md-4 text-light ml-md-4 ml-2">
                <a href="/">
                    <img src="/images/logo6.png" class="img-fluid" width="100" height="100">
                </a>
                <p class="my-3">Accomodation in just a click!</p>
            </div>
            <div class="col-md-4 text-light d-flex justify-content-between">
                <a href="https://m.facebook.com/campuslodges" class="text-light ml-3">
                    <i class="fab fa-facebook-f fa-2x"></i>
                </a>
                <a href="https://twitter.com/campuslodges?s=09" class="text-light">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="https://www.instagram.com/campuslodges/" class="text-light mr-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
<script>
    function toggleSidebar() {
        $('.sidebar-shade').toggleClass('d-none');
        $('.sidebar-shade .sidebar').toggleClass('animate');
        $('.sidebar-shade .outside').toggleClass('animate');
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
<script src="/js/croppie.js"></script>
<script>
    $('a[data-toggle="customDropdown"]').click(function () {
        var dataTarget = $(this).attr('data-target');
        $('div[id=' + dataTarget + ']').toggleClass('d-none');
    })
    $('input').focus(function () {
        $(this).parents('.form-group').addClass('focused');
    });
    $('input').blur(function () {
        var inputValue = $(this).val();
        if (inputValue == "") {
            $(this).removeClass('filled');
            $(this).parents('.form-group').removeClass('focused');
        } else {
            $(this).addClass('filled');
        }
    })
    $('#regBtn').hover(function () {
        $('#regBtn').toggleClass('btn-outline-site');
    });
    $('input:radio[name="vicinity"]').change(function () {
        // console.log($(this).val());
        var el = $(this)
        addTypeAndLocation(el);
    });
    $('select[name="vicinity"]').change(function () {
        // console.log($(this).val());
        var el = $(this)
        addTypeAndLocation(el);
    });

    function addTypeAndLocation(element) {
        var location = element.val();
        if (location) {
            $.ajax({
                url: '/getSearchLocation/' + location,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('select[name="location"]').empty();
                    $('select[name="location"]').append(`<option value="">Location</option>`);
                    {{-- console.log(data); --}}
                    data.map((row,index) => {
                    $('select[name="location"]').append('<option value="' + row.location + '">' + row.location + '</option>')
                    });
                }
            })
            $.ajax({
                url: '/getRoomLocation/' + location,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('select[name="lodge_type"]').empty();
                    $('select[name="lodge_type"]').append(`<option value="">Room type</option>`);
                    $.each(data, function (key, value) {
                        $('select[name="lodge_type"]').append('<option value="' + value + '">' + value + '</option>')
                    });
                }
            })
        }
    }

    $('#agentDropdown').hover(function () {
        $(this).parent().toggleClass('show');
        $("div[aria-labelledby='agentDropdown']").toggleClass('show');
    })

    $('#manageHousesToggler').click(function () {
        $('#manageHousesDropdown').toggleClass('d-none');
    })
    $('#managePropertiesToggler').click(function () {
        $('#managePropertiesDropdown').toggleClass('d-none');
    })
</script>
@yield('scripts')
</body>

</html>