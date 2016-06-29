{!! Form::open(['route' => isset($calculator) ? ['site.admin.panel.calculator.update', $calculator->slug] : 'site.admin.panel.calculator.store','method' => isset($calculator) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::text('name', isset($calculator) ? $calculator->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group text-center">
    <button class="btn btn-primary">
      {!! isset($calculator) ? 'Actualizar' : 'Guardar' !!}
      <span class="fa fa-paper-plane"></span>
    </button>
  </div>
{!! Form::close() !!}