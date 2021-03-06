<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Route;
use App\Calculator;
use App\Section;
use App\Platform;
use App\Item;
use App\Quote;
use App\PromotionCode;

class Welcome extends Controller {
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
}