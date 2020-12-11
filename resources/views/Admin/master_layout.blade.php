<!DOCTYPE html>
<html>
<head>
  @include('admin.blocks.head')
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
     <!-- Navbar -->
     @include('admin.blocks.navbar')

     @include('admin.blocks.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     @include('admin.blocks.header')
    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('admin.blocks.footer')
</div>
<!-- ./wrapper -->
@include('admin.blocks.foot')
</body>
</html>
