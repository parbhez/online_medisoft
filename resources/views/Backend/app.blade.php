@include('Backend._partials.top')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
@include('Backend._partials.nav')
@include('Backend._partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content-header')
    @include('Backend.common.message')
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('main-content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('Backend.common.modal')
  @include('Backend._partials.footer')
</div>
<!-- ./wrapper -->
@yield('extra-script')
@include('Backend._partials.bottom')
