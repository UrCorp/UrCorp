@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Agregar Sección')
@section('content')
<div class="col-md-8 col-md-offset-2">
  @include('site.admin.calculator.sections._form')
</div>
@endsection