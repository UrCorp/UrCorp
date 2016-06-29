{!! Form::open(['route' => isset($platform) ? ['site.admin.panel.calculator.platforms.update', $calculator->slug, $platform->slug] : ['site.admin.panel.calculator.platforms.store', $calculator->slug],'method' => isset($platform) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::text('name', isset($platform) ? $platform->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group text-center">
    <button class="btn btn-primary">
      {!! isset($platform) ? 'Actualizar' : 'Guardar' !!}
      <span class="fa fa-paper-plane"></span>
    </button>
  </div>
{!! Form::close() !!}