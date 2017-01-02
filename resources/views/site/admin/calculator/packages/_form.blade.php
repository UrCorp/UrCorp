{!! Form::open(['route' => isset($package) ? ['site.admin.panel.calculator.packages.update', $calculator->slug, $package->slug] : ['site.admin.panel.calculator.packages.store', $calculator->slug],'method' => isset($package) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    <h2><small>Información</small></h2>
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::text('name', isset($package) ? $package->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('short_description', 'Breve descripción', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::text('short_description', isset($package) ? $package->short_description : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('section_id', 'Sección', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::select('section_id', $calculator->sections->lists('name', 'id'),  isset($package) ? $package->section_id : null, ['class' => 'col-md-8 form-control', 'required' => 'required', 'placeholder' => 'Seleccionar...']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('icon', 'Icono', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::select('icon_id', $icons->lists('name', 'id'), isset($package) ? $package->icon_id : null, ['id' => 'icon-select', 'class' => 'col-md-8 form-control', 'required' => 'required', 'placeholder' => 'Seleccionar...']) !!}
    </div>
    <div class="col-md-1 no-side-padding">
      <button id="icon-view" class="btn btn-default btn-icon disabled" disabled="disabled">
        <span class="fa fa-{!! isset($package) ? $package->icon->name : 'question' !!}"></span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-7 col-md-offset-4">
      <span>Revisar el catálogo de iconos en: <a href="http://fontawesome.io/icons/" target="__blank">http://fontawesome.io/icons/</a></span>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('priority', 'Orden', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::number('priority', isset($package) ? $package->priority : 0, ['class' => 'col-md-8 form-control text-right', 'step' => 'any', 'min' => '0', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('items[]', 'Artículos', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::select('items[]', $items->lists('name', 'slug'), isset($package) ? $package->items->lists('slug')->toArray() : null, ['style' => 'height:190px;resize:vertical;', 'class' => 'col-md-8 form-control', 'required' => 'required', 'multiple']) !!}
    </div>
  </div>
  <div class="form-group text-center">
    <div class="col-md-8 col-md-offset-4">
      <button class="btn btn-primary">
        {!! isset($package) ? 'Actualizar' : 'Guardar' !!}
        <span class="fa fa-paper-plane"></span>
      </button>
    </div>
  </div>
{!! Form::close() !!}