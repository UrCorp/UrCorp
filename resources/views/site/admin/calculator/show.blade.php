@extends('site.admin.layouts.app')
@include('site.admin.calculator.nav')
@section('title', 'Cotizador de '. $calculator->name)
@section('content')
<div class="col-md-12">
  <h2>Categorías</h2>
  <a href="{{ route('site.admin.panel.calculator.categories.create', $calculator->slug) }}" class="btn btn-info pull-right">
    <span class="fa fa-plus"></span>
    Agregar categoría
  </a>
  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th># ID</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($calculator->categories as $category)
        <tr>
          <th scope="row">
            {{ $category->id }}
          </th>
          <td>
            {{ $category->name }}
          </td>
          <td class="text-center">
            <a href="{{ route('site.admin.panel.calculator.categories.edit', [$calculator->slug, $category->slug]) }}" class="btn btn-warning">
              <span class="fa fa-pencil"></span>
            </a>
            <a href="{{ route('site.admin.panel.calculator.categories.destroy', [$calculator->slug, $category->slug]) }}" class="btn btn-danger" onClick="return confirm('¿Estás seguro de eliminar este elemento?')">
              <span class="fa fa-trash"></span>
            </a>
          </td>
        </tr>
      @empty 
        <tr>
          <td colspan="3">
            <p class="text-center">
              No hay categorías
            </p>
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
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
        <th class="text-center">Nombre</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($calculator->platforms as $platform)
        <tr>
          <th scope="row">
            {{ $platform->id }}
          </th>
          <td>
            {{ $platform->name }}
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
          <td colspan="3">
            <p class="text-center">
              No hay plataformas
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
    @forelse ($calculator->items as $item)
      <div class="col-md-2 no-left-padding">
        <a href="{!! route('site.admin.panel.calculator.index') !!}" class="app-metro-btn-b col-md-12 btn btn-primary"> 
          <span class="app-metro-icon-b fa fa-mobile"></span>
            <p>
              {{ $item->name }}
            </p>
            @foreach ($item->platforms as $platform)
              <!--<p>
                ${{ number_format($item->platforms()->where(['platforms.slug' => $platform->slug])->first()->pivot->price, 2) }}
              </p>-->
            @endforeach
        </a>
      </div>
    @empty

    @endforelse
  </div>
</div>
@endsection
