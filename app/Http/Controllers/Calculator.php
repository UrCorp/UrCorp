<?php

namespace App\Http\Controllers;

use Route;
use Validator;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Item;
use App\Platform;
use App\PromotionCode;
use App\ReferringUser;
use App\Quote;

class Calculator extends Controller
{
  private $params = [];
  private $contact = null;

  public function __construct() {
    /* Not remove */
    $this->params['controller'] = appGetController(Route::current());
    $this->params['view']       = appGetView(Route::current());
    /* Not remove */

    $cookieContact = \Cookie::get('contact');

    if (is_null($cookieContact)) {
      return redirect()->route('site.welcome.index');  
    }

    $cookieContact = json_decode($cookieContact, true);

    $results = \App\Contact::whereIdSession($cookieContact["id_session"])->get();

    if ($results->count() != 1 ) {
      return redirect()->route('site.welcome.index');
    }

    $this->contact = $results->first();
  }

  public function index(Request $request, $operationCode = null) {
    $calculator       = \App\Calculator::findBySlug('web');
    $item_params      = $request->input('i') ?: [];
    $platform_params  = $request->input('p') ?: [];
    $quote            = null;

    if (!is_null($operationCode)) {
      $quote = Quote::whereOperationCode($operationCode);

      if ($quote->count() == 1) {
        $quote            = $quote->first();
        $item_params      = [];
        $platform_params  = [];

        foreach ($quote->platforms as $platform) {
          array_push($platform_params, $platform->slug);
        }

        foreach ($quote->items as $item) {
          array_push($item_params, $item->slug);
        }
      }
    }

    return view('site.calculator.index')->with([
      'controller'      => $this->params['controller'],
      'view'            => $this->params['view'],
      'calculator'      => $calculator,
      'p'               => $platform_params,
      'i'               => $item_params,
      'quote'           => $quote
    ]);
  }

  public function prices($calculatorSlug) {
    $resp = [
      'status' => 'ERROR_CONNECTION',
      'msg'    => 'Existe un error en la conexión <br/>¡Por favor, intente más tarde!'
    ];

    $calculator = \App\Calculator::findBySlug($calculatorSlug);

    if ($calculator) {
      $resp['data']['itemNames'] = [];
      $resp['data']['prices'] = [];

      foreach ($calculator->items as $item) {
        $prices = [];

        foreach ($item->platforms as $platform) {
          $prices[$platform->slug] = (double) $platform->pivot->price;
        }

        $resp['data']['itemNames'][$item->slug] = $item->name;
        $resp['data']['prices'][$item->slug] = $prices;
      }

      $resp['status'] = 'SUCCESS';
      $resp['msg'] = 'Datos obtenidos de forma exitosa.';
    } else {
      $resp['status'] = 'VALIDATION_ERROR';
      $resp['msg'] = 'Error de validación<br/>¡Los datos obtenidos son incorrectos!';
    }

    return response()->json($resp);
  }

  public function sendByEmail(Request $request) {
    $resp = [
      'status' => 'ERROR_CONNECTION',
      'msg'    => 'Existe un error en la conexión ¡Por favor, intente más tarde!'
    ];

    $quote_params = $request->input('quote');

    $validation = Validator::make($quote_params, [
      'customer-name' => 'required|max:60',
      'email'         => 'required|email|max:250',
      'platforms'     => 'required|array',
      'items'         => 'required|array'
    ]);

    if ($validation->fails()) {
      $resp['status'] = 'VALIDATION_ERROR';
      $resp['msg'] = 'Debe seleccionar al menos un servicio y un plataforma (Android, iPhone, PhoneGap, etc) para poder generar la cotización.';
    } else {
      if (isset($quote_params['items']) and count($quote_params['items']) > 0 and
          isset($quote_params['platforms']) and count($quote_params['platforms']) > 0) {

        $resp['shoppingCart']['items'] = [];
        $resp['shoppingCart']['platforms'] = [];
        $quote_data = [
          'customer_name'       => null,
          'email'               => null,
          'subtotal'            => 0.0,
          'apply_discount'      => false,
          'promotion_code'      => null,
          'discount_percentage' => 0.0,
          'discount_amount'     => 0.0,
          'total'               => 0.0,
          'operation_id'        => null,
          'operation_code'      => null,
          'comments'            => null
        ];
        $email_data = [
          'quote'               => null,
          'new_promotion_code'  => null
        ];

        $quote_data['customer_name']  = $quote_params['customer-name'];
        $quote_data['email']          = $quote_params['email'];
        $quote_data['comments']       = $quote_params['comments'];

        $price = 0.00;
        foreach ($quote_params['items'] as $itemSlug) {
          $price = 0.0;
          $item = Item::findBySlug($itemSlug);

          foreach ($quote_params['platforms'] as $platformSlug) {
            $platform = $item->platforms()->where(['platforms.slug' => $platformSlug])->first();
            $price += ((double) $platform->pivot->price);
          }

          $quote_data['subtotal'] += $price; 

          array_push($resp['shoppingCart']['items'], [
            'name'        => $item->name,
            'description' => $item->short_description,
            'price'       => $price
          ]);
        }

        foreach ($quote_params['platforms'] as $platformSlug) {
          $platform = Platform::findBySlug($platformSlug);

          array_push($resp['shoppingCart']['platforms'], $platform->name);
        }

        $quote_data['total'] = $quote_data['subtotal'];

        if (isset($quote_params['code']) && !empty($quote_params['code'])) {
          $code = $quote_params['code'];
          $promotionCode = PromotionCode::whereCode($code);

          if ($promotionCode->count() == 1) {
            $promotionCode = $promotionCode->first();

            $quote_data['apply_discount'] = true;
            $quote_data['promotion_code'] = $code;
            $quote_data['discount_percentage'] = (double) $promotionCode->percentage;
            $quote_data['discount_amount'] = (double) ($quote_data['subtotal'] * $quote_data['discount_percentage']) / 100;
            $quote_data['total'] -= $quote_data['discount_amount'];
          }
        }

        $quote = new Quote($quote_data);
        $quote->save();

        for ($i = 0; $i < count($quote_params['platforms']); ++$i) {
          $platform = Platform::findBySlug($quote_params['platforms'][$i]);

          $quote->platforms()->attach($platform->id);
        }

         for ($i = 0; $i < count($quote_params['items']); ++$i) {
          $item = Item::findBySlug($quote_params['items'][$i]);

          $quote->items()->attach($item->id);
        }

        $referringUser = ReferringUser::whereEmail($quote_params['email']);

        if ($referringUser->count() == 0) {
          $referringUser = new ReferringUser([
            'first_name'  => $quote_params['customer-name'],
            'email'       => $quote_params['email']
          ]);
          $referringUser->save();
        } else if ($referringUser->count() == 1) {
          $referringUser = $referringUser->first();
        }

        $promotionCode = new PromotionCode([
          'code'        => str_random(8),
          'percentage'  => 10.00
        ]);
        $promotionCode->save();

        $referringUser->promotionCodes()->attach($promotionCode);

        $email_data['quote']              = $quote;
        $email_data['new_promotion_code'] = $promotionCode->code;

        $mail_sent = [];
        $mail_sent[0] = Mail::send('site.emails.quote', ['email_data' => $email_data], function ($m) use ($quote) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo('ventas@urcorp.mx', 'UrCorp Ventas');
          $m->to($quote->email, $quote->customer_name);
          $m->subject('Cotización UrCorp | ID de Operación: '. $quote->operation_id);
        });

        $promotion_code = null;
        $referring_user = null;

        if ($quote->apply_discount) {
          $promotion_code = PromotionCode::whereCode($email_data['quote']->promotion_code);

          if ($promotion_code->count() == 1) {
            $promotion_code  = $promotion_code->first();

            if ($promotion_code->referringUsers->count() == 1) {
              $referring_user = $promotion_code->referringUsers->first();

              $email_data['referring_user'] = $referring_user;
            }
          }
        }

        unset($email_data['new_promotion_code']);

        $mail_sent[1] = Mail::send('site.emails.sales', ['email_data' => $email_data], function ($m) use ($quote) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo('no-reply@urcorp.mx', 'UrCorp No Reply');
          $m->to('ventas@urcorp.mx', 'UrCorp Ventas');
          $m->subject('Nueva Cotización UrCorp | ID de Operación: '. $quote->operation_id);
        });

        if ($quote->apply_discount) {
          $email_data['promotion_code'] = $promotion_code;

          $mail_sent[2] = Mail::send('site.emails.promotion', ['email_data' => $email_data], function ($m) use ($quote, $referring_user) {
            $m->from('urcorp@urcorp.mx', 'UrCorp Server');
            $m->replyTo('ventas@urcorp.mx', 'UrCorp Ventas');
            $m->to($referring_user->email, $referring_user->full_name);
            $m->subject('Cotización Recibida | ID de Operación: '. $quote->operation_id);
          });
        }

        if ((!$quote->apply_discount && $mail_sent[0] && $mail_sent[1]) ||
            ($quote->apply_discount && $mail_sent[0] && $mail_sent[1] && $mail_sent[2])) {
          $resp['status'] = 'SUCCESS';
          $resp['msg'] = '¡La cotización ha sido enviada exitosamente!';
          $resp['data']['quotation_link'] = secure_url('/calculator/' . $quote->operation_code);
        } else {
          $resp['status'] = 'ERROR_CONNECTION';
          $resp['msg']    = 'Existe un error en la conexión ¡Por favor, intente más tarde!';
        }
      } else {
        $resp['status'] = 'VALIDATION_ERROR';
        $resp['msg'] = 'Debe seleccionar al menos un servicio y una plataforma (Android, iPhone, PhoneGap, etc) para poder generar la cotización.';
      }
    }

    return response()->json($resp);
  }

  public function itemPriceByPlatform($calculatorSlug, $itemSlug, Request $request) {
    
    $data = [];
    $calculator = \App\Calculator::findBySlug($calculatorSlug);
    $results = $calculator->items()->where(['items.slug' => $itemSlug]);
    $platformSlugs = $request->input('p');

    if ($results->count() == 1) {
      $item = $results->first();

      $data['price'] = 0.0;
      foreach ($platformSlugs as $platformSlug) {
        $platform = $item->platforms()->where(['platforms.slug' => $platformSlug])->first();
        $data['price'] += $platform->pivot->price;
      }
    }
    return response()->json($data);
  }

  public function features() {
    $this->params['controller'] = appGetController(Route::current());
    $this->params['view']       = appGetView(Route::current());

    return view('site.calculator.features')->with($this->params);
  }

  public function send(Request $request) {
    $this->params['controller'] = appGetController(Route::current());
    $this->params['view']       = appGetView(Route::current());

    $total = 0.00;
    $platforms      = $request->input('p');
    $features       = $request->input('f');
    $adminFeatures  = $request->input('af');

    $jsonCalculator = \File::get('public/assets/js/app/calculator.json');
    $arrCalculator  = json_decode($jsonCalculator, true);

    $featuresType = [
      [
        'items' => $features, 
        'name' => 'platform_features'
      ],
      [
        'items' => $adminFeatures, 
        'name' => 'admin_features'
      ]
    ];

    $l = count($featuresType);

    $list_features = [];

    for ($k = 0; $k < $l; ++$k) {

      $tmpFeatures = $featuresType[$k]['items'];
      $n = count($tmpFeatures);   
      $arrFeatures = $arrCalculator[$featuresType[$k]['name']];

      for ($i = 0; $i < $n; ++$i) {
        $f = $tmpFeatures[$i];

        $objFeature = array_where($arrFeatures, function ($key, $value) use ($f) {
            return $value["id"] == $f;
        });

        $name = "";

        foreach ($objFeature as $key => $val) {
          $m = count($platforms);
          $tmpPriceByItem = 0;

          for($j = 0; $j < $m; ++$j) {
            $tmpPriceByItem += $objFeature[$key]["price"][$platforms[$j]];
          }

          $total += $tmpPriceByItem;

          array_push($list_features, [
            'name'  => $objFeature[$key]["text"],
            'price' => $tmpPriceByItem
          ]);
        }
      }
    }

    $arrPlatformTypes = $arrCalculator['platform_types'];

    $n_platforms = count($platforms);

    $list_platforms = [];

    for ($i = 0; $i < $n_platforms; ++$i) {
      $p = $platforms[$i];
      $objPlatform = array_where($arrPlatformTypes, function ($key, $value) use ($p) {
          return $value["id"] == $p;
      });

      foreach ($objPlatform as $key => $value) {
        
        array_push($list_platforms, $objPlatform[$key]['text']);
      }
    }

    $quotation = [
      'platforms' => $list_platforms,
      'list'      => $list_features,
      'total'     => $total,
      'contact'   => array_only($this->contact->toArray(), ['name', 'email'])
    ];

    if ($this->contact->quotation == "") {

      $tmpQuotation = [];
      
    } else {

      $tmpQuotation = json_decode($this->contact->quotation);     
    }

    array_push($tmpQuotation, $quotation);
    $this->contact->quotation = json_encode($tmpQuotation);

    $this->contact->update();
    
    $email_sent = \Mail::send('site.emails.calculator', ['q' => $quotation], function ($m) use ($quotation) {
      $m->from('urcorp@urcorp.mx', 'UrCorp Server');
      $m->replyTo('contacto@urcorp.mx', 'Contacto UrCorp');

      $m->to($quotation['contact']['email'], $quotation['contact']['name'])
        ->cc('contacto@urcorp.mx', 'Contacto UrCorp');
        
      $m->subject('Cotización de Aplicaciones | UrCorp');
    });

    Flash::overlay('Su cotización ha sido enviada a su correo electrónico de forma exitosa!', 'Cotización enviada');

    return redirect()->route('site.welcome.index');
  }
}
