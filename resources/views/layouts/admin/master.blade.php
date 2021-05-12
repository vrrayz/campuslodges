<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/admin_ui/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="/admin_ui/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/admin_ui/css/sb-admin.css" rel="stylesheet">

    <link href="/admin_ui/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>

<body id="page-top">
{{-- Navbar --}}
@include('layouts.admin.navbar')
<div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.admin.sidebar')

    <div id="content-wrapper">

        @yield('main')
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        @include('layouts.admin.footer')
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/admin_ui/vendor/jquery/jquery.min.js"></script>
<script src="/admin_ui/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/admin_ui/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="/admin_ui/vendor/chart.js/Chart.min.js"></script>
<script src="/admin_ui/vendor/datatables/jquery.dataTables.js"></script>
<script src="/admin_ui/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="/admin_ui/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="/admin_ui/js/demo/datatables-demo.js"></script>
<script src="/admin_ui/js/demo/chart-area-demo.js"></script>
@yield('scripts')
</body>

</html>
