@extends('site.admin.layouts.app')
@section('title', 'Códigos de promoción')
@section('panel-top-button')
<div class="pull-right">
  <a href="{{ route('site.admin.panel.promotions.create') }}" class="btn btn-info">Generar código</a>
</div>
@endsection
@section('content')
<table class="table table-striped table-condensed">
  <thead>
    <tr>
      <th class="text-center">Código</th>
      <th class="text-center">Porcentaje (%)</th>
      <th class="text-center">Nombre (Referente)</th>
      <th class="text-center">E-mail (Referente)</th>
      <th class="text-center">Opciones</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($promotionCodes as $promotionCode)
      <tr>
        <th class="text-center">{{ $promotionCode->code }}</th>
        <td class="text-center">{{ number_format($promotionCode->percentage, 2,'.', '') }}</td>
        @if ($promotionCode->referringUsers->count() > 0)
          <?php $tmpReferringUser = $promotionCode->referringUsers->first(); ?>
          <td class="text-center">{{ $tmpReferringUser->full_name }}</td>
          <td class="text-center"><a href="mailto:{{ $tmpReferringUser->email }}">{{ $tmpReferringUser->email }}</a></td>
        @else 
          <td class="text-center"> - - - </td>
          <td class="text-center"> - - - </td>
        @endif
        <td class="text-center">
          <a href="{{ route('site.admin.panel.promotions.edit', $promotionCode->code) }}" class="btn btn-warning">
            <span class="fa fa-pencil"></span>
          </a>
          <a href="{{ route('site.admin.panel.promotions.destroy', $promotionCode->code) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
            <span class="fa fa-trash"></span>
          </a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6">
          <p class="text-center">No hay códigos registrados</p>
        </td>
      </tr>
    @endforelse 
  </tbody>
</table>
@endsection