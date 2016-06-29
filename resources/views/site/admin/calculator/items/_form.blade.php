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
    {!! Form::label('name', 'Categoría', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::select('category_id', $calculator->categories->lists('name', 'id'),  isset($item) ? $item->category_id : null, ['class' => 'col-md-8 form-control', 'required' => 'required', 'placeholder' => 'Seleccionar...']) !!}
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
          {!! Form::number('platforms['.$platform->slug.']', isset($item) ? $item->name : null, ['class' => 'col-md-8 form-control text-right', 'required' => 'required', 'step' => 'any', 'min' => '0.00']) !!}
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