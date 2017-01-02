@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Cotizador de '. $calculator->name)
@section('content')
<div class="col-md-12 top-margin">
  <h2>Plataformas</h2>
  <a href="{{ route('site.admin.panel.calculator.platforms.create', $calculator->slug) }}" class="btn btn-info pull-right">
    <span class="fa fa-plus"></span>
    Agregar plataforma
  </a>
  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th># ID</th>
        <th class="text-center">Icono</th>
        <th>Nombre</th>
        <th class="text-center">Orden</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($calculator->platforms()->orderBy('priority', 'ASC')->get() as $platform)
        <tr>
          <th scope="row">
            {{ $platform->id }}
          </th>
          <td class="text-center">
            <span class="fa fa-{{ $platform->icon->name }}"></span>
          </td>
          <td>
            {{ $platform->name }}
          </td>
          <td class="text-center">
            {{ $platform->priority }}
          </td>
          <td class="text-center">
            <a href="{{ route('site.admin.panel.calculator.platforms.edit', [$calculator->slug, $platform->slug]) }}" class="btn btn-warning">
              <span class="fa fa-pencil"></span>
            </a>
            <a href="{{ route('site.admin.panel.calculator.platforms.destroy', [$calculator->slug, $platform->slug]) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
              <span class="fa fa-trash"></span>
            </a>
          </td>
        </tr>
      @empty 
        <tr>
          <td colspan="4">
            <p class="text-center">
              No hay plataformas
            </p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="col-md-12">
  <h2>Secciones</h2>
  <a href="{{ route('site.admin.panel.calculator.sections.create', $calculator->slug) }}" class="btn btn-info pull-right">
    <span class="fa fa-plus"></span>
    Agregar secciones
  </a>
  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th># ID</th>
        <th>Nombre</th>
        <th class="text-center">Orden</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($calculator->sections()->orderBy('priority', 'ASC')->get() as $section)
        <tr>
          <th scope="row">
            {{ $section->id }}
          </th>
          <td>
            {{ $section->name }}
          </td>
          <td class="text-center">
            {{ $section->priority }}
          </td>
          <td class="text-center">
            <a href="{{ route('site.admin.panel.calculator.sections.edit', [$calculator->slug, $section->slug]) }}" class="btn btn-warning">
              <span class="fa fa-pencil"></span>
            </a>
            <a href="{{ route('site.admin.panel.calculator.sections.destroy', [$calculator->slug, $section->slug]) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
              <span class="fa fa-trash"></span>
            </a>
          </td>
        </tr>
      @empty 
        <tr>
          <td colspan="4">
            <p class="text-center">
              No hay secciones
            </p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="col-md-12">
  <h2>Paquetes</h2>
  <a href="{{ route('site.admin.panel.calculator.packages.create', $calculator->slug) }}" class="btn btn-info pull-right">
    <span class="fa fa-plus"></span>
    Agregar paquetes
  </a>
  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th># ID</th>
        <th class="text-center">Icono</th>
        <th>Nombre</th>
        <th class="text-center">Orden</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($calculator->packages()->orderBy('priority', 'ASC')->get() as $package)
        <tr>
          <th scope="row">
            {{ $package->id }}
          </th>
          <td class="text-center">
            <span class="fa fa-{{ $package->icon->slug }}"></span>
          </td>
          <td>
            {{ $package->name }}
          </td>
          <td class="text-center">
            {{ $package->priority }}
          </td>
          <td class="text-center">
            <a href="{{ route('site.admin.panel.calculator.packages.edit', [$calculator->slug, $package->slug]) }}" class="btn btn-warning">
              <span class="fa fa-pencil"></span>
            </a>
            <a href="{{ route('site.admin.panel.calculator.packages.destroy', [$calculator->slug, $package->slug]) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
              <span class="fa fa-trash"></span>
            </a>
          </td>
        </tr>
      @empty 
        <tr>
          <td colspan="4">
            <p class="text-center">
              No hay paquetes
            </p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="col-md-12 top-margin">
  <h2>Artículos</h2>
  <a href="{{ route('site.admin.panel.calculator.items.create', $calculator->slug) }}" class="btn btn-info pull-right">
    <span class="fa fa-plus"></span>
    Agregar artículos
  </a>
  <div class="col-md-12 top-margin no-padding">
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th># ID</th>
          <th class="text-center">Icono</th>
          <th class="text-center">Nombre</th>
          <th class="text-center">Opciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($calculator->items as $item)
          <tr>
            <th scope="row">
              {{ $item->id }}
            </th>
            <td class="text-center">
              <span class="fa fa-{!! $item->icon->name !!}"></span>
            </td>
            <td>
              {{ $item->name }}
            </td>
            <td class="text-center">
              <a href="{{ route('site.admin.panel.calculator.items.edit', [$calculator->slug, $item->slug]) }}" class="btn btn-warning">
                <span class="fa fa-pencil"></span>
              </a>
              <a href="{{ route('site.admin.panel.calculator.items.destroy', [$calculator->slug, $item->slug]) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
                <span class="fa fa-trash"></span>
              </a>
            </td>
          </tr>
        @empty 
          <tr>
            <td colspan="3">
              <p class="text-center">
                No hay artículos
              </p>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
