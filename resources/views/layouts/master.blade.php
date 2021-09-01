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
  <!-- Theme style -->
  <link rel="stylesheet" href="../vendors/dist/css/adminlte.min.css">
  <!-- Data Table -->
  <link rel="stylesheet" href="../vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

</head>
<style>
    /* to show form clientside error in red */
    label.error {
         color: #dc3545;
         font-size: 12px;
    }
    /* to remove extra pagination style  */
    .w-5{
        display:none
    } 
    .dropdown-toggle{
        height: 40px;
        width: 400px !important;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @yield('content')

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
                    Dashboard 
                </p>
                </a>
                
            </li>
            

            <li class="nav-item menu-open">
                @if ($tabname == 'userform' || $tabname == 'userlist' || $tabname == '#')
                    <a href="#" class="nav-link active">
                @else
                    <a href="#" class="nav-link">
                @endif
                <i class="nav-icon fas fa-users"></i>
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
                @if ($tabname == 'hotel' || $tabname == '#' || $tabname == 'room' || $tabname == 'amenity')
                    <a href="#" class="nav-link active">
                @else
                    <a href="#" class="nav-link">
                @endif
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Hotel
                    <span class="badge badge-info right"></span>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                @if ($tabname == 'hotel')
                    <a href="../../admin/hotellist" class="nav-link active">
                @else
                    <a href="../../admin/hotellist" class="nav-link">
                @endif
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hotel Listing</p>
                    </a>
                </li>
                <li class="nav-item">
                @if ($tabname == 'room')
                    <a href="../../admin/rooms" class="nav-link active">
                @else
                    <a href="../../admin/rooms" class="nav-link">
                @endif
                    <i class="far fa-circle nav-icon"></i>
                    <p>Room Details</p>
                    </a>
                </li>
                <li class="nav-item">
                @if ($tabname == 'amenity')
                    <a href="../../admin/amenities" class="nav-link active">
                @else
                    <a href="../../admin/amenities" class="nav-link">
                @endif
                    <i class="far fa-circle nav-icon"></i>
                    <p>Amenities</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                @if ($tabname == '#')
                    <a href="#" class="nav-link active">
                @else
                    <a href="#" class="nav-link">
                @endif
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Bookings
                    <span class="badge badge-info right"></span>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                @if ($tabname == '#')
                    <a href="../../admin/bookings" class="nav-link active">
                @else
                    <a href="../../admin/bookings" class="nav-link">
                @endif
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Bookings</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item menu-open">
                <a href="../../admin/logout" class="nav-link ">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    Logout
                </p>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="https://adminlte.io">{{config('app.name')}}</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
        </div>
    </footer>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->

    <!-- DataTables  & Plugins -->
    <script src="../vendors/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Page specific script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @stack('userform.blade-scripts')
    @stack('userlist.blade-scripts')
    @stack('hotellist.blade-scripts')
    @stack('roomdetails.blade-scripts')
    
</body>
</html>