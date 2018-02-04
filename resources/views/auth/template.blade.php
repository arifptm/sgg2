<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="/fav_ugm.ico">
  <title>@yield('page-title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/vendor/admin-lte/dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="/vendor/iCheck/flat/orange.css">
  @yield('meta')
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page register-page skin-red">
@yield('content')
<script src="/vendor/jquery/dist/jquery.min.js"></script>
<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendor/admin-lte/dist/js/adminlte.min.js"></script>
<script src="/vendor/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat-orange',
      radioClass: 'iradio_flat-orange'
    });
  });
</script>
@yield('scripts')
</body>
</html>