@extends('site.layouts.calculator')
@section('content')
<section>
  <article>
    <div class="container-fluid">
      <div class="row margin-bottom-30px">
        <div class="col-xs-12 not-padding-side">
          <div class="col-xs-12 col-sm-9">
            <div class="col-xs-12 not-padding-side">
              <hgroup>
                <h1 class="text-center"> Cotiza tu idea </h1>
                <h2 class="text-center margin-bottom-20px"> 
                  Elija la(s) características que desea agregar a su aplicación: 
                </h2>
              </hgroup>
            </div>
            <hgroup id="app-features"></hgroup>
            <div class="col-xs-12 not-padding-side text-center">
              <h2 class="text-center margin-bottom-20px">
                ¿Desea agregar características de administrador?
              </h2>
            </div>
            <hgroup id="admin-features"></hgroup>
          </div>
          <div class="col-xs-12 col-sm-3 not-padding-side">
            <div class="col-xs-12 not-padding-side">
              <hgroup id="app-platforms"></hgroup>
            </div>
            <div id="app-calc-list" class="col-xs-12">
              <h3> Lista </h3>
              <div class="well col-xs-12 not-padding-side">
                <div class="col-xs-12 not-padding-side">
                  <div class="calc-list-features col-xs-10 col-xs-offset-1 not-padding-side">
                    
                  </div>
                </div>
              </div>
              <div class="calc-list-total col-xs-12 not-padding-side">
                <h3>
                  <div class="calc-total-label inline-block">
                  Total:
                  </div>
                  <div class="calc-total-cant pull-right inline-block">
                    0
                  </div>
                </h3>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3 not-padding-side">
            <div class="col-xs-12 margin-top-30px well">
              {!! Form::open(['url' => '/calculator/send', 'id' => 'app-calc-form']) !!}
                <div class="form-group">
                  <button id="app-calc-send" class="btn btn-primary btn-block btn-lg">
                    Enviar por correo &nbsp;
                    <span class="fa fa-paper-plane"></span>
                  </button>
                </div>
                <button id="app-calc-reset" class="btn btn-warning btn-block btn-lg">
                  Comenzar de nuevo &nbsp;
                  <span class="fa fa-repeat"></span>
                </button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</section>
@endsection