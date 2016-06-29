{!! Form::open(['route' => isset($category) ? ['site.admin.panel.calculator.categories.update', $calculator->slug, $category->slug] : ['site.admin.panel.calculator.categories.store', $calculator->slug],'method' => isset($category) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
      {!! Form::text('name', isset($category) ? $category->name : null, ['class' => 'col-md-8 form-control', 'required' => 'required']) !!}
    </div>
  </div>
  <div class="form-group text-center">
    <button class="btn btn-primary">
      {!! isset($category) ? 'Actualizar' : 'Guardar' !!}
      <span class="fa fa-paper-plane"></span>
    </button>
  </div>
{!! Form::close() !!}