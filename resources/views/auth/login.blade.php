@extends('site.admin.layouts.app')
@section('title', 'Acceder')
@section('panel-container', 'col-md-8 col-md-offset-2')
@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
  {{ csrf_field() }}
  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">Correo electrónico</label>
    <div class="col-md-6">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

      @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 control-label">Contraseña</label>
    <div class="col-md-6">
      <input id="password" type="password" class="form-control" name="password">

      @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="remember"> Recordar
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-4">
      <button type="submit" class="btn btn-primary">
        <i class="fa fa-btn fa-sign-in"></i> Acceder
      </button>
      <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidaste tu contraseña?</a>
    </div>
  </div>
</form>
@endsection
