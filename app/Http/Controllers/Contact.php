<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Mail;

class Contact extends Controller
{
  public function send(Request $request) {

    $contact = $request->input('contact');

    if (isset($contact) and !empty($contact)) {

      $validation = Validator::make($contact, [
        'name'    => 'required|max:60',
        'email'   => 'required|email|max:250',
        'phone'   => 'required|phone'
      ]);

      if (!$validation->fails()) {
        
      } else {

      } 
    } 

    echo json_encode($response);
  }

  public function save(Request $request) {

    $client = $request->input('client');

    if (!empty($client)) {

      $validation = Validator::make($client, [
        'name'  => 'required|max:45',
        'email' => 'required|email|max:250'
      ]);

      if ($validation->fails()) {
        return redirect()
                ->route('site.welcome.index')
                ->withErrors($validation)
                ->withInput();
      } else {

        $exists_contact = \App\Contact::whereEmail($client['email']);

        if ($exists_contact->count() > 0) {

          $contact = $exists_contact->first();

          $contactCookie = json_decode(\Cookie::get('contact'), true);

          if ($contact->id_session != $contactCookie["id_session"]) {

            $contactCookie["id_session"] = $contact->id_session;
          }

          $contactCookie = \Cookie::forever("contact", json_encode($contactCookie));

        } else {

          $id_session = generateKey();

          $contact = new \App\Contact();
          $contact->fill($client);
          $contact->id_session = $id_session;
          $contact->save();

          $contactCookie = \Cookie::forever('contact', json_encode([
            'id_session' => $contact->id_session
          ]));
        }

        return redirect()
                ->route('site.calculator.index')
                ->withCookie($contactCookie);
      }
    }
  }
}
