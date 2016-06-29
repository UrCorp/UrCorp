@extends('site.admin.layouts.app')
@section('title', 'Panel de Control')
@section('content')
<a href="{!! route('site.admin.panel.calculator.index') !!}" class="app-metro-btn col-md-4 btn btn-primary"> 
  <span class="app-metro-icon fa fa-calculator"></span>
  Cotizadores
</a>
@endsection