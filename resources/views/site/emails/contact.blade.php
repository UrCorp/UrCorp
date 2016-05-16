<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>[UrCorp] Mensaje de contacto | {{ $contact['name'] }}</title>
</head>
<body style="background-color: #F5F5F5;">
  <div style="display:block;width:80%;margin:auto;margin-top:50px;margin-bottom:15px;background-color:white;padding:15px;border-radius:3px;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">
    <div style="display:block;margin:auto;">
      <div style="width:92%; display:block; margin: 25px auto 15px auto;">
        <img src="{{ asset('public/assets/img/logo.png') }}" title="UrCorp - Logo" style="display:inline-block;width:180px;height:66px;background-position:center center;background-size:contain;background-repeat:no-repeat;display:inline-block;vertical-align: middle;margin-left:20px;" /> 
      </div> 
      <div style="width:92%; display:block; margin: auto auto 15px auto;">
        <h1 style="color: #333;font-family: helvetica, arial, sans-serif;font-size:22px;text-align:center;"> 
          MENSAJE DE CONTACTO
        </h1>
      </div>
    </div>
    <div style="width:92%;display:block;margin:auto;margin: auto;">
      <div style="font-family:helvetica,arial,sans-serif;color:#333;font-size:16px;padding:15px;">
        <h3 style="font-weight:lighter;margin: 0 0 15px 0;"> Te informamos que el cliente {{ cucwords($contact['name']) }} te ha escrito: </h3>
        <h4 style="font-weight:lighter;margin:0;"> 
          Correo electrónico:
          <a href="mailto:{{ $contact['email'] }}" style="color: #333;">
            {{ $contact['email'] }}
          </a>
        </h4>
        <p style="text-align: justify;margin-bottom: 15px;">{!! nl2br($contact['comment']) !!}</p>
      </div>
    </div>
    <div style="width:92%;display:block;margin: auto auto 25px auto;">
      <div style="background-color:#FFAE3F;padding:15px;border-radius:3px;font-family:helvetica,arial,sans-serif;color:#F1F1F1;font-size:16px;">
        Haz recibido este correo desde el formulario de contacto con origen
        <a href="{{ URL::to('/') }}" style="font-weight:bold;color:#F1F1F1;">{{ URL::to('/') }}</a> | <b> Importante:</b> 
        La fuente de este correo es totalmente segura así como su contenido, 
        denunciar este correo evitaría la obtención de mensajes a futuro.
      </div>
    </div>
  </div>
</body>
</html>