<!DOCTYPE html>
<html lang="en">
@include('admin.partials._head')
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.partials._nav')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('admin.partials._leftside')
        <!-- Content Wrapper. Contains page content -->
        @yield('_content')
        <!-- /.content-wrapper -->
        <!-- Main Footer -->
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
  @include('admin.partials._scripts')
</body>
</html>
