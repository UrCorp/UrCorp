@extends('site.layouts.welcome')
@section('content')
  @include('flash::message')
  <div class="container-fluid">
    <div class="row">
      <header>
        <div class="col-lg-12 app-header">
          <div class="col-lg-3 col-md-3 app-logo-container">
            <img src="{!! asset('public/assets/img/v2/urcorp-logo.svg') !!}" alt="UrCorp logo" class="app-logo" title="UrCorp logo">
          </div> 
          <div class="col-lg-9 col-md-9">
            <nav class="app-nav">
              <ul>
                <li>
                  <a href="#">SERVICIOS</a>
                </li>
                <li>
                  <a href="#">COTIZADOR INTELIGENTE</a>
                </li>
                <li>
                  <a href="#">PAQUETES</a>
                </li>
                <li>
                  <a href="#">CONTACTO</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </header>
      <section>
        <div class="col-lg-12 no-padding app-jumbotron">
          <div class="row app-slogan-container">
            <div class="col-lg-12">
              <img src="{!! asset('public/assets/img/v2/urcorp-slogan.png') !!}" alt="UrCorp eslogan" title="UrCorp eslogan" class="app-slogan" />
            </div>
            <div class="col-lg-12 app-arrow-container">
              <img src="{!! asset('public/assets/img/v2/icon-down-arrow.svg') !!}" alt="Flecha hacia abajo" title="Ir Abajo" />
            </div>
          </div>
          <video autoplay muted loop>
            <source src="{!! asset('public/assets/video/welcome.mp4') !!}" type="video/mp4" >
            <source src="{!! asset('public/assets/video/welcome.ogg') !!}" type="video/ogg" >
            <source src="{!! asset('public/assets/video/welcome.webm') !!}" type="video/webm" >
          </video>
          <div class="col-lg-12 bg-black app-clients-container">
            <div class="col-lg-3">
              <img src="{!! asset('public/assets/img/v2/logo-client-1.svg') !!}" class="logo-client logo-client-1" alt="Pecha Kucha Night" title="Pecha Kucha Night">
            </div>
            <div class="col-lg-3">
              <img src="{!! asset('public/assets/img/v2/logo-client-2.svg') !!}" class="logo-client logo-client-2" alt="EmprendeYA" title="EmprendeYA">
            </div>
            <div class="col-lg-3">
              <img src="{!! asset('public/assets/img/v2/logo-client-3.svg') !!}" class="logo-client logo-client-3" alt="Kanpai" title="Kanpai">
            </div>
            <div class="col-lg-3">
              <img src="{!! asset('public/assets/img/v2/logo-client-4.svg') !!}" class="logo-client logo-client-4" alt="WTC" title="WTC">
            </div>
          </div>
        </div>
      </section>
      <section>
        <article>
          <div class="col-lg-12 app-well no-border app-description-container">
            <div class="col-lg-6 col-lg-offset-3">
              <h1 class="text-center title ">Desarrollamos soluciones dígitales a tu medida</h1>
              <p class="text-center content ">
                Diseñamos marcas y estrategias de posicionamiento que te acercan a tus clientes transformando ideas en aplicaciones y páginas web.<br/>
                En internet no hay fronteras, crecemos tu negocio pensando global.
              </p>
            </div>
          </div>
        </article>
      </section>
      <section>
        <div class="col-lg-12 app-services-container">
          <div class="col-lg-12">
            <h2 class="text-center title ">NUESTROS SERVICIOS</h2>
          </div>
          <div class="col-lg-10 col-lg-offset-1 articles no-side-padding">
            <article>
              <div class="col-lg-4">
                <div class="text-center">
                  <img src="{!! asset('public/assets/img/v2/img-service-1.svg') !!}" alt="Páginas web" title="Páginas web" class="img-service-1" />
                  <h3 class="title title-1 ">PÁGINAS WEB</h3>
                </div>
                <div>
                  <p class="content text-justify">
                    Tú eliges desde una página informativa
                    hasta una plataforma multimedia 
                    interactiva.<br/>
                    Analizamos el objetivo, función y sector
                    de tu empresa para desarrollar el
                    concepto que tus clientes necesitan.
                  </p>
                </div>
              </div>
            </article>
            <article>
              <div class="col-lg-4">
                <div class="text-center">
                  <img src="{!! asset('public/assets/img/v2/img-service-2.svg') !!}" alt="Branding" title="Branding" class="img-service-2" />
                  <h3 class="title title-2">BRANDING</h3>
                </div>
                <div>
                  <p class="content text-justify">
                    Tú eliges desde una página informativa
                    hasta una plataforma multimedia 
                    interactiva.<br/>
                    Analizamos el objetivo, función y sector
                    de tu empresa para desarrollar el
                    concepto que tus clientes necesitan.
                  </p>
                </div>
              </div>
            </article>
            <article>
              <div class="col-lg-4">
                <div class="text-center">
                  <img src="{!! asset('public/assets/img/v2/img-service-3.svg') !!}" alt="Apps" title="Apps" class="img-service-3" />
                  <h3 class="title title-3">APPS</h3>
                </div>
                <div>
                  <p class="content text-justify">
                    Tú eliges desde una página informativa
                    hasta una plataforma multimedia 
                    interactiva.<br/>
                    Analizamos el objetivo, función y sector
                    de tu empresa para desarrollar el
                    concepto que tus clientes necesitan.
                  </p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>
      <section>
        <div class="col-lg-12 app-calculators-container no-side-padding">
          <div class="col-lg-12 title-container">
            <h2 class="title text-center fc-white">COTIZA TU IDEA EN MENOS DE 1 MINUTO</h2>
          </div>
          <div class="col-lg-12 no-side-padding articles">
            <article>
              <div class="col-lg-6">
                <div class="col-lg-10 col-lg-offset-1 content">
                  <p class="text-center description">
                    Cotiza todas las funciones y características de tu página web o aplicación en menos de 1 minuto:
                  </p>
                </div>
              </div>
            </article>
            <article>
              <div class="col-lg-6">
                <div class="col-lg-10 col-lg-offset-1 content">
                  <p class="text-center description">
                    Cotiza la imagen de tu empresa en menos de 1 minuto,<br/> sólo elige lo que necesites:
                  </p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>
      <section>
        <div class="col-lg-12 app-packages-container no-side-padding">
          <div class="col-lg-12 app-well title-container">
            <h2 class="title text-center ">PAQUETES</h2>
          </div>
          <div class="col-lg-12 packages-table">
            <div class="col-lg-3 package">
              <h3 class="text-center title">Diseño WEB</h3>
              <h4 class="text-center description">Ideal para pequeñas empresas</h4>
              <div class="price-container text-center">
                <span class="price">5,500 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#" class="btn-chose">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    <b>Diseño personalizado sobre plantilla premium</b>
                  </li>
                  <li>
                    Incluye 5 screenings.
                  </li>
                  <li>
                    Con servidor y dominio conjunto
                  </li>
                  <li class="fc-faded">
                    *Este plan muestra banners de publicidad
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 package">
              <h3 class="text-center title">Branding</h3>
              <h4 class="text-center description">Ideal para pequeñas empresas</h4>
              <div class="price-container text-center">
                <span class="price">8,000 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#" class="btn-chose">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    3 Propuestas de logotipo
                  </li>
                  <li>
                    Aplicaciones de papelería con archivos para imprimir
                  </li>
                  <li>
                    Archivo de logotipo (.ai, .eps, .jpg y .png)
                  </li>
                  <li>
                    Tipografías corporativas listas para instalar en PC/Mac
                  </li>
                  <li>
                    Desarrollo de naming con disponibilidad en IMPI
                  </li>
                  <li>
                    Manual de identidad (logotipo, paletas de color, mockups de papelería)
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 package">
              <h3 class="text-center title">PyME Básico</h3>
              <h4 class="text-center description">Ideal para pequeñas empresas</h4>
              <div class="price-container text-center">
                <span class="price">10,000 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#" class="btn-chose">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    1 Propuesta de logotipo
                  </li>
                  <li>
                    Diseño personalizado sobre plantilla premium
                  </li>
                  <li>
                    Aplicaciones de papelería con archivos para imprimir
                  </li>
                  <li>
                    Archivo de logotipo (.ai, .eps, .jpg y .png)
                  </li>
                  <li>
                    Manual de identidad (logotipo, papeletas de color, mockups de papelería)
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 package">
              <h3 class="text-center title">PyME Pro</h3>
              <h4 class="text-center description">Ideal para pequeñas empresas</h4>
              <div class="price-container text-center">
                <span class="price">12,000 <sup>00 MXN</sup></span>
              </div>
              <div class="text-center">
                <a href="#" class="btn-chose">Elegir</a>
              </div>
              <div class="features-container">
                <ul class="features-list">
                  <li>
                    3 Propuestas de logotipo
                  </li>
                  <li>
                    Diseño web personalizado y codificación desde cero
                  </li>
                  <li>
                    Aplicaciones de papelería con archivos para imprimir
                  </li>
                  <li>
                    Archivo de logotipo (.ai, .eps, .jpg y .png)
                  </li>
                  <li>
                    Tipografías corporativas listas para instalar en PC/Mac
                  </li>
                  <li>
                    Desarrollo de naming con disponibilidad en IMPI
                  </li>
                  <li>
                    Manual de identidad (logotipo, paletas de color, mockups de papelería)
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-12 app-premium-services-container">
            <div class="col-lg-12">
              <h3 class="text-center title">Los paquetes premium incluyen</h3>
            </div>
            <div class="col-lg-8 col-lg-offset-2">
              <div class="col-lg-3 text-center premium-service">
                <img src="{!! asset('public/assets/img/v2/img-service-premium-1.svg') !!}" alt="Dominio" title="Dominio" class="img-premium-service-1">
                <h4 class="title title-1">Dominio</h4>
              </div>
              <div class="col-lg-3 text-center premium-service">
                <img src="{!! asset('public/assets/img/v2/img-service-premium-2.svg') !!}" alt="Hosting" title="Hosting" class="img-premium-service-2">
                <h4 class="title title-2">Hosting</h4>
              </div>
              <div class="col-lg-3 text-center premium-service">
                <img src="{!! asset('public/assets/img/v2/img-service-premium-3.svg') !!}" alt="Google Analytics" title="Google Analytics" class="img-premium-service-3">
                <h4 class="title title-3">Google Analytics</h4>
              </div>
              <div class="col-lg-3 text-center premium-service">
                <img src="{!! asset('public/assets/img/v2/img-service-premium-4.svg') !!}" alt="Soporte" title="Soporte" class="img-premium-service-4">
                <h4 class="title title-4">Soporte</h4>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="col-lg-12 app-contact-form-container">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="col-lg-12">
              <h2 class="text-center title">CONTACTO</h2>
            </div>
            <div class="col-lg-12 contact-form">
              {!! Form::open(['url' => '/', 'method' => 'POST']) !!}
                <div class="form-group">
                  {!! Form::label('name', 'Nombre / Empresa') !!}
                  {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('name', 'eMail') !!}
                  {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('name', 'Teléfono') !!}
                  {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                  <button class="btn-send-contact">
                    ENVIAR
                  </button>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="col-lg-12 app-footer">
          <div class="col-lg-12">
            <div class="col-lg-3 no-side-padding links-list">
              <h2>AYUDA</h2>
              <h3>Aviso de privacidad</h3>
              <h3>PressKit</h3>
              <h3>Centro de Ayuda</h3>
            </div>
            <div class="col-lg-3 col-lg-offset-6 text-center">
              <img src="{!! asset('public/assets/img/v2/urcorp-logo.svg') !!}" alt="UrCorp logo" class="logo" title="UrCorp logo">
            </div>
          </div>
          <div class="col-lg-12 copyright">
            <h3>TODOS LOS DERECHOS RESERVADOS | URCORP &copy; 2016</h3>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection