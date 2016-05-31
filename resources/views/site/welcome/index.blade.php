@extends('site.layouts.welcome')
@section('content')
@include('flash::message')
<div class="container-fluid app-header" data-adjust-style="true" data-styles="min-height:100" id="inicio">
  <div class="row">
    <div class="clean-for-navbar"></div>
    <div class="col-xs-12 no-padding">
      <div class="col-xs-12 col-md-8">
        <div class="app-header-content-logo"> 
          <img alt="Logotipo UrCorp" src="{{ asset('public/assets/img/logo_white.png') }}" id="app-header-logo" class="app-header-logo" /> 
        </div>
        <div id="header-animation-a" class="header-animation-a header-animation-container">
          <div> Desarrollo de Oferta Exportable </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 no-padding">
      <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4 landing-section">
        <div class="landing-section-header">
          <h2 class="text-center"> Cotiza tu idea gratis </h2>
        </div>
        <div class="landing-section-form">
          {!! Form::open(['url' => 'contact/save']) !!}
            <div class="form-group">
              {!! Form::text('client[name]', null, ['class' => 'form-control', 'placeholder' => 'NOMBRE / EMPRESA', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('client[email]', null, ['class' => 'form-control', 'placeholder' => 'E-MAIL']) !!}
            </div>
            <div class="text-center">
              <button class="btn btn-success inline-block"> 
                COTIZAR &nbsp;
                <span class="fa fa-chevron-right"></span>
              </button>
              @if ($exists_contact)
                <a href="{!! URL::to('calculator') !!}" class="btn btn-warning inline-block"> 
                  IR DIRECTO &nbsp;
                  <span class="fa fa-chevron-right"></span>
                </a>
              @endif
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="quienesomos">
  <div class="row app-article-01">
    <div class="col-xs-12 col-md-12">
      <div class="clean-for-navbar"></div>
    </div>
    <div class="col-xs-12 col-md-12">
      <div class="col-xs-12 col-md-11">
        <div class="app-article-01-content">
          <div class="app-article-01-title">
            <h2 id="quienesomos-title" class="animated"> ¿Quiénes somos? </h2>
            <div class="line-black-01"></div>
          </div>
          <div id="quienesomos-content">
            <p class="animated"> 
              Somos una empresa que busca mejorar la economía del Estado de Querétaro, ayudando al <br/>
              desarrollo, crecimiento, creación de pequeñas y medianas empresas. Para la<br/> 
              generación como la conservación de empleo a través del desarrollo de la tecnología e<br/>
              imagen corporativa para las empresas.<br/>
            </p>
            <p class="animated"> Buscamos destacar y hacer notar el potencial que una empresa proyecta al tener<br/>
              una imagen profesional y el desarrollo adecuado de los servicios tecnológicos<br/> 
              de la misma, generando así un gran impacto ante clientes potenciales<br/> 
              nacionales e internacionales. 
            </p>
          </div>
          <div class="app-article-01-link">
            <div class="line-black-02"></div>
            <a href="#" class="read-more">Leer más</a>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-1"> </div>
      <div class="col-xs-12 col-md-12">
        <div class="clean-for-navbar"></div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid app-bg-black-1" id="estrategia">
  <div class="row app-article-03">
    <!--<div class="col-xs-12 col-md-12">
      <div class="clean-for-navbar"></div>
    </div>-->
    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 services service-1">
      <div class="icon-service icon-service-1"></div>
      <h3> Branding </h3>
      <div class="hide-service">
        <p> Diseño de logotipo </p>
        <p> Imagen corporativa </p>
        <p> Registro de marca </p>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 services service-2">
      <div class="icon-service icon-service-2"></div>
      <h3> Diseño gráfico </h3>
      <div class="hide-service">
        <p> Diseño de catálogos </p>
        <p> Diseño de banners </p>
        <p> Edición de manuales </p>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 services service-3">
      <div class="icon-service icon-service-3"></div>
      <h3> Desarrollo y <br/>diseño web </h3>
      <div class="hide-service">
        <p> Páginas Informativas </p>
        <p> Landing Page </p>
        <p> Plataformas ecommerce y de negocios </p>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 services service-4">
      <div class="icon-service icon-service-4"></div>
      <h3> Apps móviles </h3>
    </div>
    <div class="col-xs-12 col-md-12 block-services">
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      </div>
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div class="title-services">
          <div class="ur-icon"></div>
          <div class="vertical-line"></div>
          <h2> SERVICIOS </h2>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      </div>
    </div>
  </div>
</div>
<div class="container-fluid app-bg-black-1" id="servicios">
  <div class="row app-article-04">
    <div class="col-xs-12 col-md-12">
      <div class="clean-for-navbar"></div>
    </div>
    <div class="col-xs-12 col-md-12">
      <h3> Para empresas: </h3>
    </div>
    <div class="col-xs-12 col-md-12 offer-container" id="offer-container-1">
      <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offer-box offer-container-1">
        <div class="icon-offer icon-offer-1"></div>
        <div class="offer-list-container">
          <ul class="offer-margin-left">
            <li> Elaboración de perfil de la empresa </li>
            <li> Elaboración de hojas descriptivas de productos y servicios </li>
          </ul> 
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offer-box offer-container-2">
        <div class="icon-offer icon-offer-2 offer-inline"></div>
        <div class="offer-list-container">
          <ul>
            <li> Taller de sensibilización a la exportación </li>
            <li> Análisis de campo de la competencia </li>
            <li> Muestreo internacional para la comercialización </li>
            <li> Alternativas de comercialización </li>
          </ul>
        </div>
      </div>
      <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
      </div>
    </div>
    <div class="col-xs-12 col-md-12 offer-container offer-container-final" id="offer-container-2">
      <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offer-box offer-container-3">
        <div class="icon-offer icon-offer-3"></div>
        <div class="offer-list-container">
          <ul class="offer-margin-left">
            <li> Distribución de arranque para <br/>el mercado de Norte América </li> 
            <li> Representación internacional </li> 
            <li> Canales de venta al menudeo </li> 
          </ul>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 offer-box offer-container-4">
        <div class="icon-offer icon-offer-4 offer-inline"></div>
        <div class="offer-list-container">
          <ul>
            <li> Branding fundamental </li>
            <li> Condiciones de venta y costeo </li>
            <li> Envío de muestras </li>
            <li> Logística internacional </li>
            <li> Traducciones </li>
            <li> Edición de contenidos </li>
          </ul>
        </div>
      </div>
      <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
      </div>
    </div>
    <div class="col-xs-12 col-md-12">
      <h3> Para estados e instituciones: </h3>
    </div>
    <div class="col-xs-12 col-md-12">
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="offer-list-container-2">
          <ul>
            <li> Servicio integral de internacionalización </li>
            <li> Catálogo multiplataforma de productos y servicios </li>
          </ul>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
      </div>
    </div>
  </div>
</div>
<div class="container-fluid app-bg-black-1" data-adjust-style="true" data-styles="min-height:100" id="clientes">
  <div class="row app-article-05">
    <div class="col-xs-12 col-md-12">
      <div class="clean-for-navbar"></div>
    </div>
    <div class="col-xs-12 col-md-12 block-clients">
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      </div>
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div class="title-clients">
          <div class="ur-icon"></div>
          <div class="vertical-line"></div>
          <h2> CLIENTES </h2>
        </div>
      </div>
      <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
      </div>
    </div>
    <div class="col-xs-12 col-md-12">
      <div class="clients-container text-center">
        <div class="icon-client icon-aem">
        </div>
        <!--<div class="icon-client icon-wtc">
        </div>-->
        <div class="icon-client icon-cardom">
        </div>
        <div class="icon-client icon-trocal">
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-12">
      <div class="clean-for-navbar"></div>
    </div>
  </div>
</div>
<div class="container-fluid app-article-06" id="contacto">
  <div class="col-xs-12 col-md-12 block-contact">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
      <div class="title-contact">
        <div class="ur-icon"></div>
        <div class="vertical-line"></div>
        <h2> CONTACTO </h2>
      </div>
    </div>
    <!--<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
    </div>-->
  </div>
  <div class="col-xs-12 col-md-12">
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 form-contact-container">
      <div class="col-xs-12 col-md-12">
        <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 form-contact">
          {!! Form::open(['url' => '/contact/send', 'id' => 'form-contact']) !!}
            {!! Form::text('contact[name]', null, ['id' => 'contact-name', 'placeholder' => 'Tu nombre completo...', 'class' => 'form-control', 'maxlength' => '45', 'required' => 'required']) !!}
            {!! Form::email('contact[email]', null, ['id' => 'contact-email', 'placeholder' => 'Tu correo electrónico...', 'class' => 'form-control', 'maxlength' => '250', 'required' => 'required']) !!}
            {!! Form::textarea('contact[comment]', null, ['id' => 'contact-comment', 'placeholder' => 'Escribe un comentario...', 'class' => 'form-control', 'maxlength' => '250', 'required' => 'required']) !!}
            <button name="contact[submit]" id="contact-submit" class="button-xlarge pure-button pure-button-primary margin-center hvr-bounce-to-top" style="margin-top:20px;">
                Enviar
            </button>
          {!! Form::close() !!}
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
    </div>
  </div>
  <div class="col-xs-12 col-md-12 block-contact">
    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
      <div class="title-contact">
        <div class="icon-space"></div>
        <div class="vertical-line"></div>
      </div>
    </div>
    <!--<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
    </div>-->
  </div>
</div>
@endsection