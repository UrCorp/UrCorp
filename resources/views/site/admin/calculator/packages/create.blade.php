@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Agregar paquete')
@section('content')
<div class="col-md-8 col-md-offset-2">
  @include('site.admin.calculator.packages._form')
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{!! asset('public/assets/js/app/admin/calculator.packages.js') !!}"></script>
@endsection