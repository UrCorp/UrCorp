<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Mail;

class Contact extends Controller
{
  public function send(Request $request) {
    $response = ['status' => 'FAILED'];

    $contact = $request->input('contact');

    if (!empty($contact)) {

      $validation = Validator::make($contact, [
        'name'    => 'required|max:45',
        'email'   => 'required|email|max:250',
        'comment' => 'required|max:250'
      ]);

      if ($validation->fails()) {
        $arrMessages = $validation->errors()->getMessages();
        $response['status'] = 'VALIDATION_ERROR';
        $response['form_error'] = [];

        foreach ($arrMessages as $input => $message) {
          $response['form_error']['contact-' . $input] = current($message);
        }
      } else {
        $contact['name'] = cucwords($contact['name']);
        $contact['comment'] = nl2br($contact['comment']);

        $email_sent = Mail::send('site.emails.contact', ['contact' => $contact], function ($m) use ($contact) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo('contacto@urcorp.mx', 'Contacto UrCorp');

          $m->to('contacto@urcorp.mx', 'Contacto UrCorp')
            ->subject('[UrCorp] Mensaje de contacto | ' . $contact['name']);
        });

        if ($email_sent) {
          $response['status']       =   'SUCCESS';
          $response['msg_server']   =   '¡Tu mensaje ha sido enviado exitosamente!';
        } else {
          $response['status']       =   'ERROR_CONNECTION';
          $response['msg_server']   =   'Existe un error en la conexión <br/>¡Por favor, intente más tarde!';
        }
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
