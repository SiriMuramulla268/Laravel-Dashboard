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
</head>
<style>
    /* to show form clientside error in red */
    label.error {
         color: #dc3545;
         font-size: 12px;
    }
    /* to remove extra pagination style  */
    .w-5{display:none} 
</style>
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
                        Dashboard
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
                    @if ($tabname == 'logout')
                        <a href="../../admin/logout" class="nav-link active">
                    @else
                        <a href="../../admin/logout" class="nav-link">
                    @endif
                    <i class="nav-icon fas fa-sign-out-alt"></i>
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
            <strong>Copyright &copy; 2021 <a href="https://adminlte.io">{{config('app.name')}}</a>.</strong>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <!-- Page specific script -->
    <script>
    $(function () {
        $("#adduser").validate({
            rules: {
                name: "required",
                email: "required",
                password: {
                    required: true,
                    minlength: 6
                },
                company: "required",
                mobile: {   
                    required: true,
                    minlength: 10
                },
            },
            messages: {
                name: "Name is required",
                email: "Email is required",
                password: {
                    required: "Password is required",
                    minlength: "Password must be of 6 digits"
                },
                mobile: {
                    required: "Mobile number is required",
                    minlength: "Mobile number must be of 10 digits"
                },
                company: "Company is required",
            }
        }); 
    });
    </script>
</body>
</html>