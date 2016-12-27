{!! Form::open(['route' => isset($section) ? ['site.admin.panel.calculator.sections.update', $calculator->slug, $section->slug] : ['site.admin.panel.calculator.sections.store', $calculator->slug],'method' => isset($section) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::text('name', isset($section) ? $section->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('priority', 'Orden', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::number('priority', isset($section) ? $section->priority : 0, ['class' => 'col-md-8 form-control text-right', 'step' => '1', 'min' => '0', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group text-center">
    <button class="btn btn-primary">
      {!! isset($section) ? 'Actualizar' : 'Guardar' !!}
      <span class="fa fa-paper-plane"></span>
    </button>
  </div>
{!! Form::close() !!}