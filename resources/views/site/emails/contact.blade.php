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
			<center>
			<img src="{{ asset('public/assets/img/logourcorp.png') }}" title="UrCorp - Logo" style="display:inline-block;width:252px;height:94px;background-position:center center;background-size:contain;background-repeat:no-repeat;display:inline-block;vertical-align: middle;margin-left:20px;" /> 
			</center>
		</div> 
		<div style="width:92%; display:block; margin: auto auto 15px auto;">
			<h1 style="color: #333;font-family: helvetica, arial, sans-serif;font-size:22px;text-align:center;"> 
			  DATOS DE COTIZACIÓN {{ $contact['kit'] }}
			</h1>
		</div>
    </div>
    <div style="width:92%;display:block;margin:auto;margin: auto;">
		
      <table style="width:100%;display:block;margin:auto;">
        <tbody style="width:100%;">
			<tr style="width:100%">
            <td style="width:480px;text-align:center;padding:15px;font-weight:bold;">NOMBRE: </td>
            <td style="width:480px;text-align:center;padding:15px">{{ cucwords($contact['name']) }}</td>
			</tr >
			<tr style="width:100%">
            <td style="width:480px;text-align:center;padding:15px;font-weight:bold;">Correo electrónico: </td>
            <td style="width:480px;text-align:center;padding:15px">
				<a href="mailto:{{ $contact['email'] }}" style="color: #333;">
				{{ $contact['email'] }}
				</a>
			</td>
			</tr >
			<tr style="width:100%">
            <td style="width:480px;text-align:center;padding:15px;font-weight:bold;">Teléfono: </td>
            <td style="width:480px;text-align:center;padding:15px">{{ $contact['phone'] }}</td>
			</tr >
			<tr style="width=100%">
            <td colspan="2" style="width:480px;text-align:center;padding:15px;font-weight:bold;">EL PROYECTO DEL CLIENTE:</td>
			</tr>
			<tr style="width=100%">
            <td colspan="2" style="width:480px;text-align:center;padding:15px">{!! nl2br($contact['msg']) !!}</td>
			</tr>
		</tbody>
	  </table>
      </div>	  
	<div style="width:100%;display:inline-block;margin:auto;text-align:center;">
	  <p style="font-size: 18px;">Por favor, ponerse en contacto con el cliente para resolver dudas a: <a href="mailto:{{ $contact['email'] }}" style="color: #333;">{{ $contact['email'] }}</a>
	  </p>
	</div>
	<div style="width:92%;display:block;margin: auto auto 25px auto;">
		<div style="background-color:#FFAE3F;padding:15px;border-radius:3px;font-family:helvetica,arial,sans-serif;color:#F1F1F1;font-size:16px;">
			Este correo electrónico y cualquiera de sus anexos podrían contener información confidencial. Si usted no es el destinatario, por el presente se le notifica que cualquier difusión y copiado de este correo electrónico y cualquiera de sus anexos o uso de su contenido por cualquier medio está estrictamente prohibido. Si usted recibió este correo electrónico equivocadamente o por error, por favor notifíquelo al remitente inmediatamente y cancele este correo electrónico y todos sus anexos de su ordenador (computadora).
		</div>
	</div>
    </div>
</body>
</html>