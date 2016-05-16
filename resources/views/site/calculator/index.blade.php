@extends('site.layouts.calculator')
@section('content')
<section>
  <article>
    <div class="container">
      <div class="row margin-bottom-30px">
        <div class="col-xs-12">
          <hgroup>
            <h1 class="text-center"> Cotiza tu idea </h1>
            <h2 class="text-center margin-bottom-20px"> 
              Elija la(s) plataforma(s) para lanzar su aplicación: 
            </h2>
          </hgroup>
        </div>
        <div class="col-xs-12 not-padding-side">
          <hgroup id="app-platforms"></hgroup>
          {!! Form::open(['url' => '/calculator/features', 'id' => 'app-calc-form']) !!}
          {!! Form::close() !!}
        </div>
        <div class="col-xs-12 not-padding-side text-center">
          <button class="btn-calc-submit btn btn-primary btn-calc-next">
            Continuar 
            <span class="fa fa-angle-right"></span>
          </button>
        </div>
      </div>
    </div>
  </article>
</section>
@endsection