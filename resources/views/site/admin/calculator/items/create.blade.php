@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Agregar artículo')
@section('content')
<div class="col-md-8 col-md-offset-1">
  @include('site.admin.calculator.items._form')
</div>
@endsection