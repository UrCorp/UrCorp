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
  <title>@yield('title', 'UrCorp')</title>
  <!-- START [META TAGS] -->
  <meta name="description" content="¿Deseas tener tu propia app o sitio web para tu negocio? Entonces prueba el cotizador más intuitivo del mercado con UrCorp.">
  <meta name="keywords" content="Páginas web, Páginas web en Querétaro, Aplicaciones web y móviles, E-Commerce, Diseño gráfico, Imagen Corporativa, Negocios, SEO, UrCorp">
    <!-- START [OPEN GRAPH] -->
    <meta property="og:title" content="Cotizador de Web Apps | UrCorp">
    <meta property="og:description" content="¿Deseas tener tu propia app o sitio web para tu negocio? Entonces prueba el cotizador más intuitivo del mercado con UrCorp.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="UrCorp">
    <meta property="og:locale" content="es_ES">
    <meta property="og:url" content="{!! URL::to('/calculator') !!}">
    <meta property="og:image" content="{!! asset('public/assets/img/v2/urcorp-calculator-ogimage.png') !!}">
    <meta property="og:image:url" content="{!! asset('public/assets/img/v2/urcorp-calculator-ogimage.png') !!}">
    <meta property="og:image:secure_url" content="{!! secure_asset('public/assets/img/v2/urcorp-calculator-ogimage.png') !!}">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="600">
    <!-- END [OPEN GRAPH] -->
  <!-- END [META TAGS] -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- START [Favicon] -->
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/assets/img/favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/assets/img/favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/assets/img/favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/assets/img/favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/assets/img/favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/assets/img/favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/assets/img/favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/assets/img/favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/assets/img/favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('public/assets/img/favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/img/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/assets/img/favicon/favicon-96x96.png') }}">
  <link rel="shortcut icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/img/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('public/assets/img/favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{ asset('public/assets/img/favicon/ms-icon-144x144.png') }}">
  <meta name="theme-color" content="#ffffff">
  <!-- END [Favicon] -->

  <!-- START [Cascade Style Sheet Files] -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/bootstrap.min.css?v='.time()) !!}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/font-awesome.min.css?v='.time()) }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/animate.css?v='.time()) }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/hover.css?v='.time()) }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery.loading.css?v='.time()) }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css?v='.time()) }}">
  <!-- END [Cascade Style Sheet Files] -->
</head>
<body data-origin="{!! URL::to('/') !!}">
<div id="app-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<header>
  <div id="header" class="col-xs-12 app-header no-side-padding no-height">
    <div id="navbar" class="app-navbar-fixed col-xs-12 no-side-padding">
      <div class="col-sm-3 col-xs-12 app-logo-container no-side-padding">
        <a href="{!! URL::to('/') !!}">
          <img src="{!! asset('public/assets/img/v2/urcorp-logo.svg') !!}" alt="UrCorp logo" class="app-logo" title="UrCorp logo" />
        </a>
        <!--<button id="btn-open-nav" class="btn-menu btn btn-primary pull-right visible-xs" type="button" data-toggle="collapse" data-target="#nav" aria-expanded="false" aria-controls="navbar">
            <span class="fa fa-bars"></span>
        </button>-->
      </div> 
      <div id="nav" class="col-sm-9 col-xs-12 collapse no-side-padding">
        <div class="col-xs-12 no-side-padding">
          <nav class="app-nav">
            <ul>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
<div class="container-fluid">
  <div class="row">
    @yield('content')
    <section>
      <div class="col-xs-12 app-footer">
        <div class="col-xs-12">
          <div class="col-md-6 col-sm-8 col-xs-12 no-side-padding copyright">
            <h3>TODOS LOS DERECHOS RESERVADOS | URCORP &copy; 2016</h3>
            <a href="#" class="link">Política de Cookies</a>
          </div>
          <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-1 col-xs-12 text-center">
            <img src="{!! asset('public/assets/img/v2/urcorp-logo.svg') !!}" alt="UrCorp logo" class="logo" title="UrCorp logo">
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- START [JavaScript Files] -->
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.loading.js?v='.time())}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.validate.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/bootstrap.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.scrollspy.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.anchor.js?v='.time()) }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/app/app.js?v='.time()) }}"></script>
@yield('scripts')
<!-- END [JavaScript Files] -->

<!-- START [Google Analytics] -->
<script type="text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-78394522-1', 'auto');
ga('send', 'pageview');
</script>
<!-- END [Google Analytics] -->
</body>
</html>
