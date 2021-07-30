<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../vendors/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../vendors/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../vendors/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../vendors/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../vendors/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../vendors/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../vendors/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../vendors/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
    <link rel="stylesheet" href="../vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @yield('content')

    @section('sidebar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <img src="../vendors/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin  - {{ Auth::user()->name }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="../vendors/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    @if ($tabname == 'dashboard')
                        <a href="../admin/dashboard" class="nav-link active">
                    @else
                        <a href="../admin/dashboard" class="nav-link">
                    @endif
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard {{$tabname}}
                        <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                    </a>
                    
                </li>
                

                <li class="nav-item menu-open">
                    @if ($tabname == 'userform' || $tabname == 'userlist' || $tabname == '#')
                        <a href="#" class="nav-link active">
                    @else
                        <a href="#" class="nav-link">
                    @endif
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Users
                        <!-- <i class="fas fa-angle-left right"></i> -->
                        <span class="badge badge-info right"></span>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                    @if ($tabname == 'userform')
                        <a href="../../admin/userform" class="nav-link active">
                    @else
                        <a href="../../admin/userform" class="nav-link">
                    @endif
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    @if ($tabname == 'userlist')
                        <a href="../../admin/userlist" class="nav-link active">
                    @else
                        <a href="../../admin/userlist" class="nav-link">
                    @endif
                        <i class="far fa-circle nav-icon"></i>
                        <p>Listing User</p>
                        </a>
                    </li>
                    </ul>
                </li>

                <li class="nav-item menu-open">
                    @if ($tabname == 'logout')
                        <a href="../../admin/logoutpage" class="nav-link active">
                    @else
                        <a href="../../admin/logoutpage" class="nav-link">
                    @endif
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Logout
                        <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                    </a>
                </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    @show

    @section('footer')
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
            </div>
        </footer>
    @show

</div>
    <!-- jQuery -->
    <script src="../vendors/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../vendors/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../vendors/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../vendors/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../vendors/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../vendors/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../vendors/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../vendors/plugins/moment/moment.min.js"></script>
    <script src="../vendors/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../vendors/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../vendors/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../vendors/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../vendors/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../vendors/dist/js/pages/dashboard.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="../vendors/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../vendors/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/plugins/jszip/jszip.min.js"></script>
    <script src="../vendors/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../vendors/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../vendors/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../vendors/dist/js/adminlte.min.js"></script>
    <!-- Page specific script -->
    <script>
    $(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        });
    });
    </script>
</body>
</html>