@extends('site.layouts.calculator')

@section('content')
<div  class="container calculator-container">
  <div class="row navbar-margin">
    <div id="calculator" class="app-calculator col-xs-12 no-side-padding">
      <div id="items-container" class="items-container col-md-8 col-sm-8 no-padding">
        {!! Form::open(['method' => 'POST', 'id' => 'form-web-calculator', 'class' => 'calculator-form']) !!}
          <select id="items-selector" name="quote[items][]" class="calculator-select-items hidden" multiple>
            @foreach ($calculator->items as $item)
              <option id="item-{{ $item->slug }}" value="{{ $item->slug }}">{{ $item->name }}</option>
            @endforeach
          </select>
          <select id="platforms-selector" name="quote[platforms][]" class="calculator-select-platforms hidden" multiple>
            @foreach ($calculator->platforms as $platform)
              <option id="platform-{{ $platform->slug }}" value="{{ $platform->slug }}">{{ $platform->name }}</option>
            @endforeach
          </select>
        {!! Form::close() !!}
        @foreach ($calculator->sections as $section)
          <div class="section-name col-xs-12 no-side-padding">
            <h2 class="text-center">{{ $section->name }}</h2>
          </div>
          <div class="col-xs-12 no-side-padding">
            @foreach ($section->items as $item)
              <div class="col-sm-3 col-xs-4 no-side-padding">
                <div class="item animated {!! (isset($i) and is_array($i) and in_array($item->slug, $i)) ? 'bounceIn active': 'bounce' !!} col-xs-10 col-xs-offset-1" data-id="{{ $item->slug }}" data-toggle="tooltip" data-placement="bottom" title="{!! $item->short_description !!}" data-name="{!! $item->name !!}">
                  <div class="name">
                    <h3 class="text-center noselect">
                      <span class="icon fa">{!! '&#x'.$item->icon->unicode.';' !!}</span>
                      {!! str_limit($item->name, 15) !!}
                    </h3>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
      <div class="col-md-3 col-md-offset-1 col-sm-4 col-xs-12">
        <div id="platforms-container" class="platforms-container col-xs-12 no-side-padding">
          @foreach ($calculator->platforms as $platform)
            <div class="col-xs-4 no-side-padding">
              <div class="platform animated {!! (isset($p) and is_array($p) and in_array($platform->slug, $p)) ? 'bounceIn active' : 'bounce' !!} col-xs-10 col-xs-offset-1" data-id="{{ $platform->slug }}">
                <h3 class="text-center">
                  <span class="icon fa fa-{!! $platform->icon->name !!}"></span>
                  {!! $platform->name !!}
                </h3>
              </div>
            </div>
          @endforeach
        </div>
        <div class="col-xs-12 no-side-padding">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="title text-center">Lista de productos</h3>
            </div>
            <div id="shoppingCart" class="calculator-shoppingcart panel-body">
              <!-- any item list -->
            </div>
          </div>
        </div>
        <div id="total" class="calculator-price-container col-xs-12 no-side-padding">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="col-xs-12 no-side-padding">
                {!! Form::open(['method' => 'POST', 'id' => 'form-apply-promotion', 'class' => 'calculator-form-promotion']) !!}
                  {!! Form::hidden('quote[code]', (isset($quote) && isset($quote->promotion_code) && !empty($quote->promotion_code)) ? $quote->promotion_code : null, ['class' => 'calculator-input-applied-promotion-code']) !!}
                  <div class="form-group">
                    <label>Código de promoción</label>
                    <div class="input-group">
                      {!! Form::text('code', null, ['id' => 'promotion-code', 'class' => 'calculator-input-promotion-code form-control', 'placeholder' => 'Ej. xXxXxXxX']) !!}
                      <span class="input-group-btn">
                        <button type="submit" id="btn-apply-promo" class="btnApplyPromo btn btn-warning" type="button">Aplicar</button>
                      </span>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
              <div class="calculator-subtotal-container col-xs-12 no-side-padding">
                <div class="col-xs-6 no-side-padding">
                  <h4 class="lbl">Subtotal</h4>
                </div>
                <div class="col-xs-6 no-side-padding">
                  <h4 class="subtotal pull-right">$0.00</h4>
                </div>
              </div>
              <div class="total-container col-xs-12 no-side-padding">
                <div class="col-xs-6 no-side-padding">
                  <h3 class="lbl">Total</h3>
                </div>
                <div class="col-xs-6 no-side-padding">
                  <h3 class="total pull-right">$0.00</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="share-quote" class="col-xs-12 no-side-padding">
          {!! Form::open(['route' => ['site.api.v1.calculator.sendByEmail', 'web'], 'id' => 'form-send-by-email', 'class' => 'calculator-form-email-send', 'method' => 'POST']) !!}
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="title text-center">Guardar mi cotización</h3>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="text-center">Enviame la cotización por email</label>
                  <label for="quote-customer-name"><sup class="red" style="color:red;">*</sup> Nombre: </label>
                  {!! Form::text('quote[customer-name]', (isset($quote) && isset($quote->customer_name) && !empty($quote->customer_name)) ? $quote->customer_name : null, ['id' => 'quote-customer-name', 'class' => 'form-control', 'placeholder' => 'Ej: Juan Peréz ']) !!}
                </div>
                <div class="form-group">
                  <label for="quote-email"><sup class="red" style="color:red;">*</sup> Correo electrónico: </label>
                  {!! Form::email('quote[email]', (isset($quote) && isset($quote->email) && !empty($quote->email)) ? $quote->email : null, ['id' => 'quote-email', 'class' => 'form-control', 'placeholder' => 'Ej: example@mail.com']) !!}
                </div>
                <div class="form-group">
                  <button type="submit" class="calculator-email-send btn btn-success btn-block">
                    ENVIAR
                  </button>
                </div>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{!! asset('public/assets/js/app/calculator/index.js?v='.time()) !!}"></script>
@endsection