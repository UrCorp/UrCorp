{!! Form::open(['route' => isset($item) ? ['site.admin.panel.calculator.items.update', $calculator->slug, $item->slug] : ['site.admin.panel.calculator.items.store', $calculator->slug],'method' => isset($item) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    <h2><small>Información</small></h2>
  </div>
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::text('name', isset($item) ? $item->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('short_description', 'Breve descripción', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::text('short_description', isset($item) ? $item->short_description : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('section_id', 'Sección', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::select('section_id', $calculator->sections->lists('name', 'id'),  isset($item) ? $item->section_id : null, ['class' => 'col-md-8 form-control', 'required' => 'required', 'placeholder' => 'Seleccionar...']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('icon', 'Icono', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
      {!! Form::select('icon_id', $icons->lists('name', 'id'), isset($item) ? $item->icon_id : null, ['id' => 'icon-select', 'class' => 'col-md-8 form-control', 'required' => 'required', 'placeholder' => 'Seleccionar...']) !!}
    </div>
    <div class="col-md-1 no-side-padding">
      <button id="icon-view" class="btn btn-default btn-icon disabled" disabled="disabled">
        <span class="fa fa-{!! isset($item) ? $item->icon->name : 'question' !!}"></span>
      </button>
    </div>
  </div>
  <div class="form-group" style="margin-bottom:0;">
    <div class="col-md-7 col-md-offset-4">
      <span>Revisar el catálogo de iconos en: <a href="http://fontawesome.io/icons/" target="__blank">http://fontawesome.io/icons/</a></span>
    </div>
  </div>
  <div class="form-group">
    <h2><small>Precios</small></h2>
  </div>
  @foreach ($calculator->platforms as $platform)
    <div class="form-group">
    {!! Form::label('platforms['.$platform->slug.']', cucfirst($platform->name), ['class' => 'col-md-4 control-label']) !!}
      <div class="col-md-8">
        <div class="input-group">
          <span class="input-group-addon">$</span>
          {!! Form::number('platforms['.$platform->slug.']', isset($item) ? number_format($item->platforms()->where('slug', '=', $platform->slug)->first()->pivot->price, 2, '.', '') : null, ['class' => 'col-md-8 form-control text-right', 'required' => 'required', 'step' => 'any', 'min' => '0.00']) !!}
        </div>
      </div>
    </div>
  @endforeach
  <div class="form-group text-center">
    <div class="col-md-8 col-md-offset-4">
      <button class="btn btn-primary">
        {!! isset($item) ? 'Actualizar' : 'Guardar' !!}
        <span class="fa fa-paper-plane"></span>
      </button>
    </div>
  </div>
{!! Form::close() !!}