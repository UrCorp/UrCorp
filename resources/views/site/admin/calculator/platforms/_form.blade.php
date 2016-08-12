{!! Form::open(['route' => isset($platform) ? ['site.admin.panel.calculator.platforms.update', $calculator->slug, $platform->slug] : ['site.admin.panel.calculator.platforms.store', $calculator->slug],'method' => isset($platform) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::text('name', isset($platform) ? $platform->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('icon_id', 'Icono', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-9">
      {!! Form::select('icon_id', $icons->lists('name', 'id'), isset($platform) ? $platform->icon_id : null, ['id' => 'icon-select', 'class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-md-1 no-side-padding">
      <button id="icon-view" class="btn btn-default btn-icon disabled" disabled="disabled">
        <span class="fa fa-{!! isset($platform) ? $platform->icon->name : 'question' !!}"></span>
      </button>
    </div>
  </div>
  <div class="form-group text-center">
    <button class="btn btn-primary">
      {!! isset($platform) ? 'Actualizar' : 'Guardar' !!}
      <span class="fa fa-paper-plane"></span>
    </button>
  </div>
{!! Form::close() !!}