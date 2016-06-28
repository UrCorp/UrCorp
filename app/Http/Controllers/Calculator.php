<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use Route;

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

  public function index() {
    $this->params['controller'] = appGetController(Route::current());
    $this->params['view']       = appGetView(Route::current());
    
    return view('site.calculator.index')->with($this->params);
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

    return view('site.emails.calculator')->with(['q' => $quotation]);

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
