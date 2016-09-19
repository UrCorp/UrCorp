@extends('site.layouts.calculator')
@section('content')
<section>
  <article>
    <div class="container">
      <div class="row navbar-margin">
        <div class="app-calculator col-xs-12 no-padding">
          <div id="items-container" class="items-container col-sm-9 no-padding">
            {!! Form::open(['method' => 'GET', 'id' => 'web-calculator']) !!}
              <select id="items-selector" name="i[]" class="hidden" multiple>
                @foreach ($calculator->items as $item)
                  <option id="item-{{ $item->slug }}" value="{{ $item->slug }}">{{ $item->name }}</option>
                @endforeach
              </select>
              <select id="platforms-selector" name="p[]" class="hidden" multiple>
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
                @foreach ($calculator->items()->where(['items.section_id' => $section->id])->get() as $item)
                  <div class="col-xs-3 no-side-padding">
                    <div class="item animated bounce col-xs-10 col-xs-offset-1" data-id="{{ $item->slug }}">
                      <h3 class="text-center">
                        <span class="icon fa fa-{!! $item->icon->name !!}"></span>
                        {!! $item->name !!}
                      </h3>
                    </div>
                  </div>
                @endforeach
              </div>
            @endforeach
          </div>
          <div class="col-sm-3 no-side-padding">
            <div id="platforms-container" class="platforms-container col-xs-12 no-side-padding">
              @foreach ($calculator->platforms as $platform)
                <div class="col-xs-4 no-side-padding">
                  <div class="platform animated {!! in_array($platform->slug, $p) ? 'bounceIn active' : 'bounce' !!} col-xs-10 col-xs-offset-1" data-id="{{ $platform->slug }}">
                    <h3 class="text-center">
                      <span class="icon fa fa-{!! $platform->icon->name !!}"></span>
                      {!! $platform->name !!}
                    </h3>
                  </div>
                </div>
              @endforeach
            </div>
            <div class="col-xs-12 no-side-padding">
              <div id="shoppingCart" class="col-xs-12 well">
               
              </div>
            </div>
            <div class="col-xs-12 no-side-padding">
              <div id="total" class="col-xs-12">
                <div class="col-xs-6">
                  <h4 class="lbl">Total</h4>
                </div>
                <div class="col-xs-6">
                  <h4 class="amount pull-right">$0.00</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</section>
@endsection
@section('scripts')
<script type="text/javascript" src="{!! asset('public/assets/js/app/calculator/index.js') !!}"></script>
@endsection