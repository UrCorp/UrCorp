<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Route;
use App\Calculator;
use App\Section;
use App\Platform;
use App\Item;

class Welcome extends Controller
{
  private $params = [];

  public function index(Request $request) {

    $this->params = [
      'controller'      => appGetController(Route::current()),
      'view'            => appGetView(Route::current()),
      'exists_contact'  => false
    ];

    $cookieContact = \Cookie::get('contact');

    if (!is_null($cookieContact)) {
      
      $contact = null;
      $cookieContact = json_decode($cookieContact, true);

      $results = \App\Contact::whereIdSession($cookieContact["id_session"])->get();

      if ($results->count() > 0) {
        $contact = $results->first();
      }

      $this->params['exists_contact'] = true;
    }

    $this->params['quote_sent'] = false;

    $this->params['calculator'] = Calculator::findBySlug('web');

    return view('site.welcome.index')->with($this->params);
  }

  public function mail(Request $request) {

    $quote = [
      'subtotal'        => 92400,
      'total'           => 92400,
      'apply_discount'  => false,
      'operation_id'    => 'UR1612001',
      'operation_code'  => 'ab05bcdf',
    ];

    $quote = new \App\Quote($quote);
    $quote->save();

    $platforms = [
      'android-phone',
      'web'
    ];

    $items = [
      'perfiles',
      'geolocalizacion-y-brujula-con-api-google-maps',
      'sistema-de-administracion-de-pagos-cuentas'
    ];

    for ($i = 0; $i < count($platforms); ++$i) {
      $platform = \App\Platform::findBySlug($platforms[$i]);

      $quote->platforms()->attach($platform->id);
    }

     for ($i = 0; $i < count($items); ++$i) {
      $item = \App\Item::findBySlug($items[$i]);

      $quote->items()->attach($item->id);
    }

    $new_promotion_code = 'gHTr06Xc';

    return view('site.emails.quote')->with([
      'quote'               => $quote,
      'new_promotion_code'  => $new_promotion_code
    ]);
  }
}
