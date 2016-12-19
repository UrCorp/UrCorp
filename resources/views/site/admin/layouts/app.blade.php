<!--
  00000     00000 000 000 0000  0000000
  000000   000000 000 000 000   000
  000 000 000 000 000 000000    000000
  000   000   000 000 000 000   000
  000         000 000 000 00000 0000000

  ======= [Software Developer] ========

  E-mail: mikebsg01@gmail.com
  Author: Michael Serrato
-->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="57x57" href="{!! asset('public/assets/img/favicon/apple-icon-57x57.png') !!}">
  <link rel="apple-touch-icon" sizes="60x60" href="{!! asset('public/assets/img/favicon/apple-icon-60x60.png') !!}">
  <link rel="apple-touch-icon" sizes="72x72" href="{!! asset('public/assets/img/favicon/apple-icon-72x72.png') !!}">
  <link rel="apple-touch-icon" sizes="76x76" href="{!! asset('public/assets/img/favicon/apple-icon-76x76.png') !!}">
  <link rel="apple-touch-icon" sizes="114x114" href="{!! asset('public/assets/img/favicon/apple-icon-114x114.png') !!}">
  <link rel="apple-touch-icon" sizes="120x120" href="{!! asset('public/assets/img/favicon/apple-icon-120x120.png') !!}">
  <link rel="apple-touch-icon" sizes="144x144" href="{!! asset('public/assets/img/favicon/apple-icon-144x144.png') !!}">
  <link rel="apple-touch-icon" sizes="152x152" href="{!! asset('public/assets/img/favicon/apple-icon-152x152.png') !!}">
  <link rel="apple-touch-icon" sizes="180x180" href="{!! asset('public/assets/img/favicon/apple-icon-180x180.png') !!}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{!! asset('public/assets/img/favicon/android-icon-192x192.png') !!}">
  <link rel="icon" type="image/png" sizes="32x32" href="{!! asset('public/assets/img/favicon/favicon-32x32.png') !!}">
  <link rel="icon" type="image/png" sizes="96x96" href="{!! asset('public/assets/img/favicon/favicon-96x96.png') !!}">
  <link rel="shortcut icon" type="image/png" sizes="16x16" href="{!! asset('public/assets/img/favicon/favicon-16x16.png') !!}">
  <link rel="manifest" href="{!! asset('public/assets/img/favicon/manifest.json') !!}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{!! asset('public/assets/img/favicon/ms-icon-144x144.png') !!}">
  <meta name="theme-color" content="#ffffff">
  <title>@yield('title') | UrCorp</title>

  <!-- OPEN [META TAGS] -->
  <meta name="description" content="">
  <meta name="keywords" content="">
  <!-- END [META TAGS] -->

  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/bootstrap.min.css?v='.time()) !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/font-awesome.min.css?v='.time()) !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/animate.css?v='.time()) !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/hover.css?v='.time()) !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/jquery.loading.css?v='.time()) !!}">
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/admin.css?v='.time()) !!}">
</head>
<body id="app-layout">
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Branding Image -->
        <a class="navbar-brand" href="{!! route('site.admin.panel.index') !!}">
          UrCorp
        </a>
      </div>
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          @yield('nav')
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span>
                {!! Auth::user()->full_name !!}
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li>
                  <a href="{!! route('site.admin.logout') !!}">
                    <i class="fa fa-btn fa-sign-out"></i>
                    Cerrar sesión
                  </a>
                </li>
              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session('flash_notification.level') }} top-margin">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('flash_notification.message') !!}
          </div>
        @endif
      </div>
      <div class="@yield('panel-container', 'col-md-10 col-md-offset-1') top-margin">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <h1 class="panel-title">@yield('title')</h1>
                  </div>
                  <div class="col-md-6">
                    @yield('panel-top-button')
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="col-md-12">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- JavaScripts -->
  <script type="text/javascript" src="{!! asset('public/assets/js/jquery.js?v='.time()) !!}"></script>
  <script type="text/javascript" src="{!! asset('/public/assets/js/defiant.min.js?v='.time()) !!}"></script>
  <script type="text/javascript" src="{!! asset('public/assets/js/jquery.loading.js?v='.time())!!}"></script>
  <script type="text/javascript" src="{!! asset('public/assets/js/jquery.validate.js?v='.time()) !!}"></script>
  <script type="text/javascript" src="{!! asset('public/assets/js/bootstrap.min.js?v='.time()) !!}"></script>
  @yield('scripts')
  {{-- <script src="{!! elixir('js/app.js') !!}"></script> --}}
</body>
</html>