<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Mail;

class Contact extends Controller
{
  public function send(Request $request) {
    $res = [
      'status' => 'ERROR_CONNECTION',
      'msg'    => 'Existe un error en la conexión <br/>¡Por favor, intente más tarde!'
    ];

    $contact = $request->input('contact');

    if (isset($contact) and !empty($contact)) {

      $validation = Validator::make($contact, [
        'name'    => 'required|max:60',
        'email'   => 'required|email|max:250',
        'phone'   => 'required|regex:/^[0-9]{10,10}$/',
        'msg'     => 'max:512'
      ]);

      if ($validation->fails()) {
        $res['status'] = 'VALIDATION_ERROR';
        $res['msg'] = 'Error de validación<br/>¡Los datos introducidos son incorrectos!';
      } else {
        $mail_sent = Mail::send('site.emails.contact', ['contact' => $contact], function ($m) use ($contact) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo($contact['email'], $contact['name']);
          $m->to('mbringas@urcorp.mx', 'Contacto UrCorp');
          $m->subject('Cotización Kit:'.$contact['kit'].' | UrCorp');
        });

        $mail_sent_client = Mail::send('site.emails.contact_client', ['contact' => $contact], function ($m) use ($contact) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo('ventas@urcorp.mx', 'Ventas UrCorp');
          $m->to($contact['email'], $contact['name']);
          $m->subject('Cotización UrCorp');
        });

        if ($mail_sent) {
          $res['status'] = 'SUCCESS';
          $res['msg'] = '¡Mensaje enviado!';
        }
      }
    }
    echo json_encode($res);
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
