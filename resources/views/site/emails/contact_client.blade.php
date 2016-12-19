<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Solicitud de KIT</title>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,400italic,300italic' rel='stylesheet' type='text/css'>
</head>
<body style="font-family: 'Open sans',helvetica, arial, sans-serif;margin:0;background-color: #F5F5F5;">
<div style="display:block;margin:auto;width:996px;background-color:#FFFFFF;">
  <div style="width:92%;display:block;margin:auto;padding:60px 25px;">
    <div style="width:100%;display:inline-block;margin:auto;text-align:center;">
      <img src="{{ asset('public/assets/img/logourcorp.png') }}" alt="UrCorp" title="UrCorp" style="display:inline-block;width:252px;height:94px;margin-bottom:30px;" />
    </div>
    <div style="width:100%;display:inline-block;margin:auto;text-align:center;">
      <h1 style="font-weight:bold;margin-bottom:30px;">COTIZACIÓN DE KIT {{ $contact['kit'] }}</h1>
      <p style="font-size:24px;font-weight:400;">Ha cotizado el <b>KIT</b> con los siguientes beneficios:</p>
    </div>
    <div style="width:100%;display:inline-block;margin:auto;font-weight:400;font-size:18px;text-align:center;">
      <ul style="display:inline-block;margin-left:-180px;margin-bottom:0;">
      @if($contact['kit'] == "WEB BÁSICO")
        <li style="text-align:left;margin-bottom:15px;">Servidos y dominio en conjunto.</li>
        <li style="text-align:left;margin-bottom:15px;">Diseño personalizado sobre plantilla premium</li>
        <li style="text-align:left;margin-bottom:15px;">*Este plan puede contener banners.</li>
      @elseif($contact['kit'] == "BRANDING")
        <li style="text-align:left;margin-bottom:15px;">Manual de identidad (Logotipo, paletas de color, mockups de papelería)</li>
        <li style="text-align:left;margin-bottom:15px;">Aplicaciones de papelería con archivos para imprimir</li>
        <li style="text-align:left;margin-bottom:15px;">Archivo de logotipo (.ai, .eps, .jpg, .png)</li>
        <li style="text-align:left;margin-bottom:15px;">Topografías listas para instalar en PC/Mac</li>
        <li style="text-align:left;margin-bottom:15px;">Desarrollo de naming con dispoibilidad en IMPI</li>
        <li style="text-align:left;margin-bottom:15px;">Servidor y dominio conjunto. *Sujeto a disponibilidad en AKKY</li>
        <li style="text-align:left;margin-bottom:15px;">Cuentas de correo.</li>
        <li style="text-align:left;margin-bottom:15px;">3 diseños de logotipo.</li>
      @else
        <li style="text-align:left;margin-bottom:15px;">Diseño de página web personalizado y codificación desde cero</li>
        <li style="text-align:left;margin-bottom:15px;">Servidos y dominio en conjunto.</li>
        <li style="text-align:left;margin-bottom:15px;">5 screenings de diseño responsivo</li>
        <li style="text-align:left;margin-bottom:15px;">3 diseños de logotipo</li>
        <li style="text-align:left;margin-bottom:15px;">Manual de identidad (Logotipo, paletas de color, mockups de papelería)</li>
        <li style="text-align:left;margin-bottom:15px;">Aplicaciones de papelería con archivos para imprimir</li>
        <li style="text-align:left;margin-bottom:15px;">Archivo de logotipo (.ai, .eps, .jpg, .png)</li>
        <li style="text-align:left;margin-bottom:15px;">Tipografías corporativas listas para instalar en PC/MAC</li>
        <li style="text-align:left;margin-bottom:15px;">Desarrollo de naming con disponibilidad en IMPI</li>
      @endif
      </ul>
    </div>
    <div style="width:100%;display:inline-block;">
      <div style="display:inline-block;font-weight:400;font-size:24px;width:100%;">
        @if($contact['kit'] == "WEB BÁSICO")
          <p style="text-align: center;">Total: <b>$5,500.00 mx + I.V.A.</b></p>
        @elseif($contact['kit'] == "BRANDING")
          <p style="text-align: center;">Total: <b>$8,000.00 mx + I.V.A.</b></p>
        @else
          <p style="text-align: center;">Plan desde: <b>$12,000.00 mx + I.V.A.</b></p>
        @endif
    <p style="text-align: center;">Para un seguimiento inmediato manda un correo a <a href="mailto:ventas@urcorp.mx?subject=Ventas" "email me">ventas@urcorp.mx</a>.</p>

      </div>
    </div>
  <div style="width:100%;display:inline-block;margin:auto;min-height:110px;background-color: gray;border-top:16px solid black;padding:15px;border-radius:3px;font-family:helvetica,arial,sans-serif;color:#F1F1F1;font-size:16px;">
    Este correo electrónico y cualquiera de sus anexos podrían contener información confidencial. Si usted no es el destinatario, por el presente se le notifica que cualquier difusión y copiado de este correo electrónico y cualquiera de sus anexos o uso de su contenido por cualquier medio está estrictamente prohibido. Si usted recibió este correo electrónico equivocadamente o por error, por favor notifíquelo al remitente inmediatamente y cancele este correo electrónico y todos sus anexos de su ordenador (computadora).
  </div>
  </div>
</div>
</body>
</html>