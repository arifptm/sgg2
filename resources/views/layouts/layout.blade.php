<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="/fav_ugm.ico">
  <title>Logistik TEDi</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/vendor/admin-lte/dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="/vendor/admin-lte/dist/css/skins/skin-blue.min.css">  

  <link rel="stylesheet" href="/vendor/iCheck/flat/orange.css">
  
  @yield('header-scripts')
  
  <link rel="stylesheet" href="/css/app.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    @include('layouts.header')
  </header>

  <aside class="main-sidebar">
  @include('layouts.sidebar-left')
  </aside>

  <div class="content-wrapper">
    <section class="content-header"> 
      @include('flash::message')
      <div id="ajaxmsg"></div>
        @if(View::hasSection('content-top'))
          @yield('content-top')
    @endif
    </section>

    <section class="content">
      @yield('content-main')
    </section>

  </div>

  <footer class="main-footer">
<!--    <div class="pull-right hidden-xs">
    by <a href="http://goried.com"><b>Goried</b> Studio</a>
    </div> -->
    <strong>Copyright &copy; {{ \Carbon\Carbon::parse()->format('Y') }} <a href="http://logistiktedi.com">Logistik TEDI</a></strong>&nbsp; :: &nbsp;  All rights
    reserved.
  </footer>
</div>

<script src="/vendor/jquery/dist/jquery.min.js"></script>
<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendor/admin-lte/dist/js/adminlte.min.js"></script>
<script src="/vendor/iCheck/icheck.min.js"></script>
<script src="/js/app.js"></script>
<script>
  $('body').tooltip({selector: '[data-toggle="tooltip"]'});
  checkCart()
</script>
@yield('footer-scripts')

</body>
</html>
