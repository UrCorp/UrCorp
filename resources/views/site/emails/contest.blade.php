<?php
  /*
  $contact['name']="Eduardo Vera - Web Developer";
  $contact['phone']="442·377·35·81";
  $contact['email']="eduardo.vera.pineda@gmail.com";
  */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Solicitud de KIT</title>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,400italic,300italic' rel='stylesheet' type='text/css'>
</head>
<body style="font-family: 'Open sans',helvetica, arial, sans-serif;margin:0;background-color: #F5F5F5; color: #79888e">
<div style="display:block;margin:auto;width:640px;background-color:#FFFFFF;">
  <div style="width:92%;display:block;margin:auto;padding:60px 25px;">
    <div style="width:100%;display:inline-block;margin:auto;text-align:center;">
      <h1 style="font-weight:bold;margin-bottom:30px;">¡Se ha registrado un nuevo concursante!</h1>
    </div>
    <div style="width:100%;display:inline-block;margin:auto;font-weight:400;font-size:18px;text-align:center;">
      <hr style="width: 50%; margin-top: 4%">
      <div style="margin-top: 4%">
        <table width="60%" style="margin:auto">
          <tr>
            <th style="border-bottom: 2px solid; text-align: left; color:#a7a6a6; font-weight:100">Nombre</th>
            <th style="border-bottom: 2px solid; text-align: left; color:#a7a6a6; font-weight:100">Telefono</th>
          </tr>
          <tr>
            <td style="text-align:left;">{{ $contact['name'] }}</td>
            <td style="text-align:left;">{{ $contact['phone'] }}</td>
          </tr>
            <tr style="padding-top: 210px">
              <th style="border-bottom: 2px solid; text-align: left; color:#a7a6a6; font-weight:100">Correo</th>
            </tr>
            <tr>
              <td style="text-align:left;">{{ $contact['email'] }}</td>
            </tr>
        </table>
      </div>
      <hr style="width: 50%; margin-top: 4%">
      <div style="text-align:left;padding-left:20%">
        <h4>Excelente ahora es momento de...</h4>
        <p>1.- Registrarlo en una base de datos análoga <br> 2.- Agregarlo a una lista de mailing
          <br>3.- Perfilarlo a partir de su perfil de facebook.
        </p>
      </div>
      <div style="width:100%;display:inline-block;margin-top:1%">
        <center>
          <h2 style="color:#79888e">¡Esperemos más registros!</h2>
        </center>
      </div>
    </div>
  <div style="width:80%;display:inline-block;margin:auto;min-height:110px;color: gray;padding: 20px 20px 20px 10%;border-radius:3px;font-family:helvetica,arial,sans-serif;font-size:16px;">
    Este correo electrónico y cualquiera de sus anexos podrían contener información confidencial. Si usted no es el destinatario, por el presente se le notifica que cualquier difusión y copiado de este correo electrónico y cualquiera de sus anexos o uso de su contenido por cualquier medio está estrictamente prohibido. Si usted recibió este correo electrónico equivocadamente o por error, por favor notifíquelo al remitente inmediatamente y cancele este correo electrónico y todos sus anexos de su ordenador (computadora).
  </div>
  <div style="width:100%;display:inline-block;margin:auto;text-align:center;">
    <img src="{{ asset('public/assets/img/urcorp-gris.png') }}" alt="UrCorp" title="UrCorp" style="display:inline-block;width:300px;margin-bottom:30px;" />
  </div>
  </div>
</div>
</body>
</html>
