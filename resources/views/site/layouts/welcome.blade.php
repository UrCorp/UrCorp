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
  <meta name="description" content="Creamos páginas web pensando en las necesidades de tu negocio, con una gran calidad en diseño 100% adaptables a dispositivos móviles, desarrollamos plataformas de comercio electrónico, marketing dígital e imagen corporativa, todo para tu negocio.">
  <meta name="keywords" content="Páginas web, Páginas web en Querétaro, Aplicaciones web y móviles, E-Commerce, Diseño gráfico, Imagen Corporativa, Negocios, SEO, UrCorp">
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
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/bootstrap.min.css') !!}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/animate.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/hover.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery.loading.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
  <!-- END [Cascade Style Sheet Files] -->
</head>
<body>
  @yield('content')
  <!-- START [JavaScript Files] -->
  <script type="text/javascript" src="{{ asset('public/assets/js/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/jquery.loading.js')}}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/jquery.validate.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/bootstrap.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/jquery.scrollspy.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/jquery.anchor.js') }}"></script>
  <script type="text/javascript" src="{{ asset('public/assets/js/app/generic.js') }}"></script>
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