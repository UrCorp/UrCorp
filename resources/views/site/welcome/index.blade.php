@extends('site.layouts.welcome')

@section('content')
@include('flash::message')
<section>
  <div class="col-xs-12 no-padding app-jumbotron">
    <div class="col-xs-12 app-slogan-container">
      <div class="col-xs-12">
        <img src="{!! asset('public/assets/img/v2/urcorp-slogan.png') !!}" alt="UrCorp eslogan" title="UrCorp eslogan" class="app-slogan" />
      </div>
      <div class="col-xs-12 app-arrow-container">
        <img src="{!! asset('public/assets/img/v2/icon-down-arrow.svg') !!}" alt="Flecha hacia abajo" title="Ir Abajo" />
      </div>
    </div>
    <div class="coverpage-mobile visible-xs"></div>
    <video class="hidden-xs" autoplay muted loop>
      <source src="{!! asset('public/assets/video/welcome-v2.mp4?v='.time()) !!}" type="video/mp4" >
      <!--
      <source src="{!! asset('public/assets/video/welcome.ogg') !!}" type="video/ogg" >
      <source src="{!! asset('public/assets/video/welcome.webm') !!}" type="video/webm" >
      -->
    </video>
    <div class="col-xs-12 bg-black app-clients-container">
      <div class="col-sm-3 col-xs-12">
      <a href="http://www.pechakucha.org/" title="pechakucha.org" target="_blank">
        <img src="{!! asset('public/assets/img/v2/logo-client-1.svg') !!}" class="logo-client logo-client-1" alt="Pecha Kucha Night" title="Pecha Kucha Night">
      </a>
      </div>
      <div class="col-sm-3 col-xs-12">
      <a href="http://emprendeya.org" title="EmpredeYa" target="_blank">
        <img src="{!! asset('public/assets/img/v2/logo-client-2.svg') !!}" class="logo-client logo-client-2" alt="EmprendeYA" title="EmprendeYA">
      </a>
      </div>
      <div class="col-sm-3 col-xs-12">
      <a href="http://kanpai.mx/" title="Kanpai.mx" target="_blank">
        <img src="{!! asset('public/assets/img/v2/logo-client-3.svg') !!}" class="logo-client logo-client-3" alt="Kanpai" title="Kanpai">
      </a>
      </div>
      <div class="col-sm-3 col-xs-12">
      <a href="https://www.wtca.org/world-trade-center-queretaro" title="WTC" target="_blank">
        <img src="{!! asset('public/assets/img/v2/logo-client-4.svg') !!}" class="logo-client logo-client-4" alt="WTC" title="WTC">
      </a>
      </div>
    </div>
  </div>
</section>
<section>
  <article>
    <div class="col-xs-12 no-border app-description-container">
      <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
        <div class="text-center">
          <h1 class="title">Desarrollamos soluciones dígitales a tu medida</h1>
        </div>
        <div class="text-center">
          <h2 class="subtitle">Crecemos tu negocio pensando global</h2>
        </div>
        <div class="text-center">
          <div class="divider"></div>
        </div>
        <div class="text-center">
          <p class="content">
            Diseñamos marcas y estrategias de posicionamiento que te acercan a tus clientes transformando ideas en aplicaciones y páginas web.<br/>
            En internet no hay fronteras, crecemos tu negocio pensando global.
          </p>
        </div>
        <!--div class="text-center">
          <a href="#" class="btn-learn-more">CONOCE MÁS</a>
        </div-->
      </div>
    </div>
  </article>
</section>
<section>
  <div id="services" class="col-xs-12 app-services-container">
    <div class="col-xs-12">
      <h2 class="text-center title ">NUESTROS SERVICIOS</h2>
    </div>
    <div class="col-md-10 col-md-offset-1 col-xs-12 articles no-side-padding">
      <article>
        <div class="col-sm-4 col-xs-12">
          <div class="text-center">
            <img src="{!! asset('public/assets/img/v2/img-service-1.svg') !!}" alt="Páginas web" title="Páginas web" class="img-service-1" />
            <h3 class="title title-1 ">PÁGINAS WEB</h3>
          </div>
          <div>
            <p class="content text-justify">
              Desde una página informativa hasta una plataforma multimedia interactiva. Analizamos el objetivo, función y sector de tu empresa para desarrollar el concepto que tus clientes necesitan.
            </p>
          </div>
        </div>
      </article>
      <article>
        <div class="col-sm-4 col-xs-12">
          <div class="text-center">
            <img src="{!! asset('public/assets/img/v2/img-service-2.svg') !!}" alt="Branding" title="Branding" class="img-service-2" />
            <h3 class="title title-2">BRANDING</h3>
          </div>
          <div>
            <p class="content text-justify">
              Diseñamos marcas que conectan con la gente y sus necesidades que cambian mas rápido que nunca. Creamos conexiones significativas, valiosas y competitivas para tus clientes.
            </p>
          </div>
        </div>
      </article>
      <article>
        <div class="col-sm-4 col-xs-12">
          <div class="text-center">
            <img src="{!! asset('public/assets/img/v2/img-service-3.svg') !!}" alt="Apps" title="Apps" class="img-service-3" />
            <h3 class="title title-3">APPS</h3>
          </div>
          <div>
            <p class="content text-justify">
              El éxito de tu negocio depende de la capacidad de ofrecerles  experiencias consistentes en todos los canales, usamos las tecnologías más nuevas para llegar a ellos.
            </p>
          </div>
        </div>
      </article>
    </div>
  </div>
</section>
<section>
  <div id="smart-calculator" class="col-xs-12 app-calculators-container no-side-padding">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 title-container">
      <h2 class="title text-center fc-white">COTIZADOR INTELIGENTE</h2>
      <h3 class="subtitle text-center">Cotiza tu idea en menos de 1 minuto</h3>
      <div class="text-center">
        <div class="divider"></div>
      </div>
      <p class="text-center content">Elige solo las funciones o características que necesites, ya sea diseño web o diseño de la imagen de su empresa</p>
    </div>
    <div class="col-xs-12 no-side-padding">
      <div class="calculator-wrap col-md-10 col-md-offset-1 col-xs-12 no-side-padding">
        <section>
          <div class="col-md-12 col-xs-12 calculator calculator-1">
            <div class="header">
              <header>
                <h3 class="title">COTIZA DISEÑO WEB</h3>
              </header>
              <div id="items-container" class="items-container col-xs-12 no-side-padding">
                {!! Form::open(['route' => 'site.calculator.index', 'id' => 'web-calculator', 'method' => 'GET']) !!}
                  <select id="items-selector" name="p[]" class="hidden" multiple>
                    @if (!is_null($calculator))
                      @foreach ($calculator->platforms as $platform)
                        <option id="platform-{{ $platform->slug }}" value="{{ $platform->slug }}">{{ $platform->name }}</option>
                      @endforeach
                    @endif
                  </select>
                  <div class="col-xs-12 no-side-padding">
                    @if (!is_null($calculator))
                      @foreach ($calculator->platforms as $platform)
                        <div class="col-sm-4 col-xs-6 no-side-padding">
                          <div class="item animated bounce col-xs-10 col-xs-offset-1" data-id="{{ $platform->slug }}">
                            <h3 class="text-center">
                              <span class="icon fa fa-{!! $platform->icon->name !!}"></span>
                              {!! $platform->name !!}
                            </h3>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  </div>
                  <div class="text-center">
                    <button class="btn-choose">ELEGIR</button>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </section>
        <!--<section>
          <div class="col-md-6 col-xs-12 calculator calculator-2">
            
          </div>
        </section>-->
      </div>
    </div>
  </div>
</section>
<section>
  <div id="packages" class="col-xs-12 app-packages-container no-side-padding">
    <div class="col-xs-12 title-container">
      <h2 class="title text-center ">PAQUETES</h2>
    </div>
    <div class="col-xs-12 packages-table">
      <div class="col-sm-4 col-xs-12">
        <article>
          <div class="col-xs-12 package no-side-padding">
            <header>
              <div class="col-xs-12 header">
                <h3 class="text-center title">WEB Básico</h3>
                <h4 class="text-center description">Ideal para<br/> Emprendedores</h4>
              </div>
            </header>
            <div class="col-xs-12 content">
              <div class="price-container text-center">
                <span class="price">5,500 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#contact" class="btn-chose">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    <b>Diseño personalizado sobre plantilla premium</b>
                  </li>
                  <li>
                    Servidor y dominio conjunto.
                  </li>
                  <li class="fc-faded">
                    *Este plan muestra banners de publicidad
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </article>
      </div>
      <div class="col-sm-4">
        <article>
          <div class="col-xs-12 package no-side-padding">
            <header>
              <div class="col-xs-12 header">
                <h3 class="text-center title">BRANDING</h3>
                <h4 class="text-center description">Emprendedores y Freelancers</h4>
              </div>
            </header>
            <div class="col-xs-12 content">
              <div class="price-container text-center">
                <span class="price">8,000 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#contact" class="btn-chose">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    <b>3 diseños de logotipo</b>
                  </li>
                  <li>
                    <b>Manual de identidad (Logotipo, paletas de color, mockups de papelería)</b>
                  </li>
                  <li>
                    Aplicaciones de papelería con archivos para imprimir
                  </li>
                  <li>
                    Archivo de logotipo (.ai, .eps, .jpg, .png)
                  </li>
                  <li>
                    Tipografías corporativas listas para instalar en PC / Mac
                  </li>
                  <li>
                    Desarrollo de naming con disponibilidad en IMPI
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </article>
      </div>
      <div class="col-sm-4">
        <article>
          <div class="col-xs-12 package offer no-side-padding">
            <header>
              <div class="col-xs-12 header">
                <div class="offer-notice">
                  <h5 class="title text-center">30% MENOS</h5>
                </div>
                <h3 class="text-center title">PYME WEB</h3>
                <h4 class="text-center description">Planes Desde*<br/>&nbsp;</h4>
              </div>
            </header>
            <div class="col-xs-12 content">
              <div class="price-container text-center">
                <span class="price">12,000 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#contact" class="btn-chose offer">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    <b>Diseño de página web personalizado y codificación HTML desde cero</b>
                  </li>
                  <li>
                    <b>5 screenings de diseño responsivo</b>
                  </li>
                  <li>
                    <b>3 diseños de logotipo</b>
                  </li>
                  <li>
                    <b>Manual de identidad (Logotipo, paletas de color, mockups de papelería)</b>
                  </li>
                  <li>
                    <b>Aplicaciones de papelería con archivos para imprimir</b>
                  </li>
                  <li>
                    Servidor y dominio conjunto
                  </li>
                  <li>
                    Archivo de logotipo (.ai, .eps, .jpg, .png)
                  </li>
                  <li>
                    Tipografías corporativas listas para instalar en PC / Mac
                  </li>
                  <li>
                    Desarrollo de naming con disponibilidad en IMPI
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
  <div class="col-xs-12 app-premium-services-container">
    <div class="col-xs-12">
      <h3 class="text-center title">Los paquetes premium incluyen</h3>
    </div>
    <div class="col-lg-8 col-lg-offset-2">
      <div class="col-sm-3 col-xs-6 text-center premium-service">
        <img src="{!! asset('public/assets/img/v2/img-service-premium-1.svg') !!}" alt="Dominio" title="Dominio" class="img-premium-service-1">
        <h4 class="title title-1">Dominio</h4>
      </div>
      <div class="col-sm-3 col-xs-6 text-center premium-service">
        <img src="{!! asset('public/assets/img/v2/img-service-premium-2.svg') !!}" alt="Hosting" title="Hosting" class="img-premium-service-2">
        <h4 class="title title-2">Hosting</h4>
      </div>
      <div class="col-sm-3 col-xs-6 text-center premium-service">
        <img src="{!! asset('public/assets/img/v2/img-service-premium-3.svg') !!}" alt="Google Analytics" title="Google Analytics" class="img-premium-service-3">
        <h4 class="title title-3">Google Analytics</h4>
      </div>
      <div class="col-sm-3 col-xs-6 text-center premium-service">
        <img src="{!! asset('public/assets/img/v2/img-service-premium-4.svg') !!}" alt="Soporte" title="Soporte" class="img-premium-service-4">
        <h4 class="title title-4">Soporte</h4>
      </div>
    </div>
  </div>
</section>
<section>
  <div id="contact" class="col-xs-12 app-contact-form-container">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
      <div class="col-xs-12">
        <h2 class="text-center title">CONTACTO</h2>
      </div>
      <div class="col-xs-12 contact-form">
        {!! Form::open(['route' => 'site.contact.send', 'id' => 'form-contact', 'method' => 'POST']) !!}
          <div class="form-group">
            {!! Form::label('contact[name]', 'Nombre / Empresa *') !!}
            {!! Form::text('contact[name]', null, ['class' => 'form-control', 'maxlength' => 60, 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('contact[email]', 'eMail *') !!}
            {!! Form::email('contact[email]', null, ['class' => 'form-control', 'maxlength' => 250, 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('contact[phone]', 'Teléfono') !!}
            {!! Form::text('contact[phone]', null, ['class' => 'form-control', 'pattern' => '^[0-9]{10,10}$', 'required' => 'required']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('contact[msg]', 'Cuéntanos más de tu proyecto') !!}
            {!! Form::textarea('contact[msg]', null, ['class' => 'form-control', 'maxlength' => 512, 'rows' => 3]) !!}
          </div>
				<div class="form-group">
                  {!! Form::radio('contact[KIT]', null, ['class' => 'form-control col-sm-3 col-xs-12']) !!}
				  {!! Form::label('contact[KIT]', 'WEB BÁSICO') !!}
                  {!! Form::radio('contact[KIT]', null, ['class' => 'form-control col-sm-3 col-xs-12']) !!}
				  {!! Form::label('contact[KIT]', 'BRANDING') !!}
                  {!! Form::radio('contact[KIT]', null, ['class' => 'form-control col-sm-3 col-xs-12']) !!}
				  {!! Form::label('contact[KIT]', 'PYME WEB') !!}
                </div>
          <div class="form-group text-center">
            <button class="btn-send-contact">
              ENVIAR
            </button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript" src="{!! asset('public/assets/js/app/welcome/index.js') !!}"></script>
@endsection