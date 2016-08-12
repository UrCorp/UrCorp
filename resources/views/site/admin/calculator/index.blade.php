@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Cotizadores')
@section('panel-top-button')
<div class="pull-right">
  <a href="{{ route('site.admin.panel.calculator.create') }}" class="btn btn-info">Registrar nuevo cotizador</a>
</div>
@endsection
@section('content')
<table class="table table-striped table-condensed">
  <thead>
    <tr>
      <th># ID</th>
      <th class="text-center">Nombre</th>
      <th class="text-center"># Secciones</th>
      <th class="text-center"># Plataformas</th>
      <th class="text-center"># Artículos</th>
      <th class="text-center">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($calculators as $calculator)
      <tr>
        <th scope="row">{{ $calculator->id }}</th>
        <td class="text-center">
          <a href="{{ route('site.admin.panel.calculator.show', $calculator->slug) }}">
            {{ $calculator->name }}
          </a>
        </td>
        <td class="text-center">
          {{ $calculator->sections->count() }}
        </td>
        <td class="text-center">
          {{ $calculator->platforms->count() }}
        </td>
        <td class="text-center">
          {{ $calculator->items->count() }}
        </td>
        <td class="text-center">
          <a href="{{ route('site.admin.panel.calculator.show', $calculator->slug) }}" class="btn btn-primary">
            <span class="fa fa-eye"></span>
          </a>
          <a href="{{ route('site.admin.panel.calculator.edit', $calculator->slug) }}" class="btn btn-warning">
            <span class="fa fa-pencil"></span>
          </a>
          <a href="{{ route('site.admin.panel.calculator.destroy', $calculator->slug) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
            <span class="fa fa-trash"></span>
          </a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6">
          <p class="text-center">No hay cotizadores</p>
        </td>
      </tr>
    @endforelse 
  </tbody>
</table>
@endsection