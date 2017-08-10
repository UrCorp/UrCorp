<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Mail;

class Contest extends Controller
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
        'phone'   => 'required|regex:/^[0-9]{10,10}$/'
      ]);

      if ($validation->fails()) {
        $res['status'] = 'VALIDATION_ERROR';
        $res['msg'] = 'Error de validación<br/>¡Los datos introducidos son incorrectos!';
      } else {
        $mail_sent = Mail::send('site.emails.contest', ['contact' => $contact], function ($m) use ($contact) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo($contact['email'], $contact['name']);
          $m->to('mbringas@urcorp.mx', 'Contacto UrCorp');
          $m->subject('Concurso | UrCorp');
        });

        $mail_sent_client = Mail::send('site.emails.contest-client', ['contact' => $contact], function ($m) use ($contact) {
          $m->from('urcorp@urcorp.mx', 'UrCorp Server');
          $m->replyTo('mbringas@urcorp.mx', 'Info UrCorp');
          $m->to($contact['email'], $contact['name']);
          $m->subject('Concurso UrCorp');
        });

        if ($mail_sent) {
          $res['status'] = 'SUCCESS';
          $res['msg'] = '¡Mensaje enviado!';
        }
      }
    }
    echo json_encode($res);
  }
}
