{!! Form::open(['route' => isset($promotionCode) ? ['site.admin.panel.promotions.update', $promotionCode->code] : 'site.admin.panel.promotions.store','method' => isset($promotionCode) ? 'PUT' : 'POST', 'class' => 'form-horizontal']) !!}
  <div class="form-group">
    <div class="col-md-12">
      <h2>
        <small>Promoción</small>
      </h2>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('promotionCode[percentage]', 'Descuento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      <div class="input-group">
        {!! Form::number('promotionCode[percentage]', isset($promotionCode) ? number_format($promotionCode->percentage, 2,'.', '') : '0.00', ['class' => 'col-md-8 form-control text-right', 'step' => 'any', 'min' => '0.00', 'required' => 'required']) !!}
        <span class="input-group-addon"><b>%</b></span>
      </div>
    </div>
  </div>

  <!-- -->
  <div class="form-group">
    <div class="col-md-12">
      <div class="pull-right">
        <label for="add_expiring_date">
          ¿Desea añadir vigencia al cupón?
          <?php
            $addExpiringDate = null;
            if (isset($promotionCode)) { 
              $addExpiringDate = true;
            }
          ?>
          {!! Form::checkbox('promotionCode[add_expiring_date]', 'true', !is_null($addExpiringDate) ? $addExpiringDate : false, ['id' => 'add_expiring_date', 'style' => 'width:22px;height:22px;vertical-align:middle;margin-left:8px;']) !!}
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
      <h2>
        <small>Vigencia</small>
      </h2>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('promotionCode[start_date]', 'Fecha de Inicio', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::text('promotionCode[start_date]', !is_null($addExpiringDate) ? $promotionCode->start_date : null, ['class' => 'col-md-8 form-control referringUserField', 'required' => 'required', 'disabled' => 'disabled']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('promotionCode[expiry_date]', 'Fecha de expiración', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::text('promotionCode[expiry_date]', !is_null($addExpiringDate) ? $promotionCode->expiry_date : null, ['class' => 'col-md-8 form-control referringUserField', 'required' => 'required', 'disabled' => 'disabled']) !!}
    </div>
  </div>
  
  <!-- -->
  <div class="form-group">
    <div class="col-md-12">
      <div class="pull-right">
        <label for="add_referring_user">
          ¿Desea añadir un referente?
          <?php
            $addReferringUser = null;
            if (isset($promotionCode) and $promotionCode->referringUsers->count() > 0) {
              $addReferringUser = true;

              $referringUser = $promotionCode->referringUsers->first();
            }
          ?>
          {!! Form::checkbox('promotionCode[add_referring_user]', 'true', !is_null($addReferringUser) ? $addReferringUser : false, ['id' => 'add_referring_user', 'style' => 'width:22px;height:22px;vertical-align:middle;margin-left:8px;']) !!}
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-12">
      <h2>
        <small>Referente</small>
      </h2>
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('promotionCode[referring_user][first_name]', 'Nombre(s)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::text('promotionCode[referring_user][first_name]', !is_null($addReferringUser) ? $referringUser->first_name : null, ['class' => 'col-md-8 form-control referringUserField', 'required' => 'required', 'disabled' => 'disabled']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('referring_user[last_name]', 'Apellido(s)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::text('promotionCode[referring_user][last_name]', !is_null($addReferringUser) ? $referringUser->last_name : null, ['class' => 'col-md-8 form-control referringUserField', 'required' => 'required', 'disabled' => 'disabled']) !!}
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('promotionCode[referring_user][email]', 'E-mail', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
      {!! Form::email('promotionCode[referring_user][email]', !is_null($addReferringUser) ? $referringUser->email : null, ['class' => 'col-md-8 form-control referringUserField', 'required' => 'required', 'disabled' => 'disabled']) !!}
    </div>
  </div>
  <div class="form-group text-center">
    <div class="col-md-8 col-md-offset-4">
      <button class="btn btn-primary">
        {!! isset($promotionCode) ? 'Actualizar' : 'Generar' !!}
        <span class="fa fa-paper-plane"></span>
      </button>
    </div>
  </div>
{!! Form::close() !!}