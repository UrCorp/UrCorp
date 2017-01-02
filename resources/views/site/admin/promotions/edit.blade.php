@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Código de Promoción: ' . $promotionCode->code)
@section('content')
<div class="col-md-8 col-md-offset-2">
  @include('site.admin.promotions._form')
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{!! asset('public/assets/js/app/admin/calculator.promotions.js?v='.time()) !!}"></script>
@endsection