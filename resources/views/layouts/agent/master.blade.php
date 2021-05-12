<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css"/>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 85vw;
            height: 100vh;
            z-index: 10;
        }

        .sidebar ul {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
        }

        .sidebar ul li a {
            background-image: linear-gradient(
                    rgb(6, 21, 38) 40%,
                    rgba(6, 21, 38, 0.2)
            );
            width: 100%;
        }

        sidebar ul li a:hover {
            text-decoration: none;
            width: 100%;
        }

        .bg-light a.list-group-item:hover {
            text-decoration: none;
            background-color: #ddd;
        }

        .shadow-effect {
            position: fixed;
            background-color: rgba(0, 0, 0, .1);
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            z-index: 8;
        }

        .custom-upload-div {
            background-color: rgba(100, 100, 100, .1);
            width: 200px;
            height: 200px;
            border: 4px dashed #bbb;
            border-radius: 10%;
        }

        .custom-upload-btn-hidden {
            background-color: transparent;
            opacity: 0;
            width: 200px;
            height: 200px;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-transparent shadow-sm navbar-expand-lg justify-content-start">
    <button class="navbar-toggler mr-2" type="button"
            onclick="$('.sidebar').toggleClass('d-none');
        $('.shadow-effect').toggleClass('d-none');">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/"><img src="/images/logo2.png" width="100" height="100" class="img-fluid"></a>
    <ul class="navbar-nav d-none d-lg-flex">
        <li class="nav-item">
            <a class="nav-link" href="\">
                Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="\">
                Logout
            </a>
        </li>
    </ul>
</nav>
<div class="shadow-effect d-none d-lg-none">

</div>
<div class="sidebar bg-dark d-none d-lg-none">
    <button class="btn btn-outline-light ml-3" style="border: 1px solid grey;" type="button" onclick="$('.sidebar').toggleClass('d-none');
        $('.shadow-effect').toggleClass('d-none');">
        <span class="close px-2">X</span>
    </button>
    <a class="navbar-brand my-2" href="/"><img src="/images/logo6.png" width="100" height="100" class="img-fluid"></a>
    <ul>
        <li>
            <a class="text-light font-weight-bold d-block py-2 px-4" href="\">Home</a>
        </li>
        <li>
            <a class="text-light font-weight-bold d-block py-2 px-4" href="\agent\profile">My Profile</a>
        </li>
        <li>
            <a class="text-light font-weight-bold d-block py-2 px-4" href="#" id="mHButton">Manage Houses</a>
        </li>
        <div class="list-group bg-light collapse" id="mHDropdown">
            <a class="pl-4 list-group-item d-flex justify-content-start" href="#">
                <span class="fas fa-minus-square ml-3 mt-1 text-success"></span>
                <span class="mx-3 font-weight-bold text-dark">
                    Active
                </span>
            </a>
            <a class="pl-4 list-group-item d-flex justify-content-start" href="#">
                <span class="fas fa-minus-square ml-3 mt-1 text-warning"></span>
                <span class="mx-3 font-weight-bold text-dark">
                    Pending
                </span>
            </a>
            <a class="pl-4 list-group-item d-flex justify-content-start" href="#">
                <span class="fas fa-minus-square ml-3 mt-1 text-danger"></span>
                <span class="mx-3 font-weight-bold text-dark">
                    Rejected
                </span>
            </a>
        </div>
        <li>
            <a class="text-light font-weight-bold d-block py-2 px-4" href="#">Request Help</a>
        </li>
    </ul>
</div>
<main>
    @yield('main')
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" creat></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>
    $('#mHButton').click(function () {
        $('#mHDropdown').toggleClass('collapse');
    });
    $('.shadow-effect').click(function () {
        $('.sidebar').toggleClass('d-none');
        $('.shadow-effect').toggleClass('d-none');
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

    $("#addBtn").click(function(){
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    $("body").on("click","#removeBtn",function(){
        $(this).parents(".group-btn").remove();
    });
</script>
@yield('script')
</body>
</html>