<?php

namespace App\Http\Controllers;

use Route;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\Item;
use App\Platform;

class Calculator extends Controller
{
  private $params = [];
  private $contact = null;

  public function __construct() {

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

  public function index(Request $request) {
    $this->params['controller'] = appGetController(Route::current());
    $this->params['view']       = appGetView(Route::current());
    $this->params['calculator'] = \App\Calculator::findBySlug('web');
    $this->params['p']  = $request->input('p');

    return view('site.calculator.index')->with($this->params);
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

    $quote = $request->input('quote');


    $validation = Validator::make($quote, [
      'email'       => 'required|email|max:250',
      'platforms'   => 'required|array',
      'items'       => 'required|array'
    ]);

    if ($validation->fails()) {
      $resp['status'] = 'VALIDATION_ERROR';
      $resp['msg'] = 'Debe seleccionar al menos un servicio y un plataforma (Android, iPhone, PhoneGap, etc) para poder generar la cotización.';
    } else {
      if (isset($quote['items']) and count($quote['items']) > 0 and
          isset($quote['platforms']) and count($quote['platforms']) > 0) {
        $items = $quote['items'];
        $platforms = $quote['platforms'];

        $mail_sent = true; // recordar borrar

        $price = 0.0;
        $resp['shoppingCart']['items'] = [];
        $resp['shoppingCart']['platforms'] = [];

        foreach ($items as $itemSlug) {
          $price = 0.0;
          $item = Item::findBySlug($itemSlug);

          foreach ($platforms as $platformSlug) {
            $platform = $item->platforms()->where(['platforms.slug' => $platformSlug])->first();
            $price += $platform->pivot->price;
          }

          array_push($resp['shoppingCart']['items'], [
            'name'        => $item->name,
            'description' => $item->short_description,
            'price'       => $price
          ]);
        }

        foreach ($platforms as $platformSlug) {
          $platform = Platform::findBySlug($platformSlug);

          array_push($resp['shoppingCart']['platforms'], $platform->name);
        }

        /* 
        $mail_sent = Mail::send('site.emails.calculator.sendByEmail', ['quote' => $quote], function ($m) use ($quote) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo($contact['email'], $contact['name']);
          $m->to('contacto@urcorp.mx', 'Contacto UrCorp');
          $m->subject('[contacto] '.$contact['name'].' | UrCorp');
        });*/

        if ($mail_sent) {
          $resp['status'] = 'SUCCESS';
          $resp['msg'] = '¡La cotización ha sido enviada exitosamente!';
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
