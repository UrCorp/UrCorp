@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Agregar plataforma')
@section('content')
<div class="col-md-8 col-md-offset-2">
  @include('site.admin.calculator.platforms._form')
</div>
@endsection