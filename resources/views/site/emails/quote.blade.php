<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Cotización</title>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800,400italic,300italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="{!! asset('public/assets/css/font-awesome.min.css?v='.time()) !!}">
</head>
<body style="font-family: 'Open sans',helvetica, arial, sans-serif;margin:0;background-color: #F5F5F5;">
<div style="display:block;margin:auto;width:768px;background-color:#FFFFFF;">
  <div style="width:100%;display:block;margin:auto;">
    <div style="width:92%;display:block;margin:auto;text-align:left;">
      <img src="{!! asset('public/assets/img/logourcorp.png') !!}" alt="UrCorp" title="UrCorp" style="display:inline-block;width:252px;height:94px;margin:45px auto 30px auto;" />
    </div>
    <div style="width:92%;display:block;margin:auto;font-weight:400;font-size:16px;text-align:justify; ">
      <p>Gracias por darnos la oportunidad de ayudar a crecer tu negocio en la era digital. Recibimos tu solicitud, adjunta viene un resumen de nuestra propuesta. </p>
      @if (isset($email_data['new_promotion_code']) && !empty($email_data['new_promotion_code']))
        <p>Queremos también compartirte un código de promoción del 10% de descuento para futuras cotizaciones con UrCorp que podrás compartir con tus amigos:</p>
        <p>Código: <b>{{ $email_data['new_promotion_code'] }}</b></p>
      @endif
    </div>
    <br/>
    <div style="width:92%; margin:auto; font-size:16px; border-top: 1px solid #000;padding-top: 15px;">
      <table style="width: 100%">
        <tbody>
          <tr>
            <td>DETALLES DE LA COTIZACIÓN</td>
            <?php
              $dt = \Carbon\Carbon::parse($email_data['quote']->created_at);
            ?>
            <td style="text-align: right;">FECHA: {{ $dt->format('d/m/Y') }}</td>
          </tr>
          <tr>
            <td></td>
            <td style="text-align: right;">ID DE OPERACIÓN: {{ $email_data['quote']->operation_id }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="width:90%; margin:30px auto 30px auto; font-weight:200; font-size:16px;">
      <table style="border-collapse: separate; border-spacing: 0;">
        <tr>
          <td colspan="2" style="text-align: left; border-collapse: collapse; border-bottom: 1px solid black;font-weight:400;">DESCRIPCIÓN</td>
          <td style="text-align: center; border-bottom: 1px solid black;font-weight:400;">PRECIO</td>
        </tr>
        @foreach ($email_data['quote']->items as $item)
          <tr>
            <td style="width:96px;font-weight: 500; font-size: 40px;padding:15px 0 25px 0;">
              <div style="width:100%;text-align:center;">
                <span class="fa" style="font-size:32px;width:64px;height:64px;">{{ '&#x'.$item->icon->unicode.';' }}</span>
              </div>
            </td>
            <td style="width:560px;font-weight: 400;padding:15px 15px 25px 15px;">
              <span style="font-size:18px;">{{ $item->name }}</span><br/>
              <p style="margin-top:4px;font-size:14px;text-align:justify;">{{ $item->short_description }}</p>
            </td>
            <?php
              $price = 0.00;

              foreach ($email_data['quote']->platforms as $platform) {
               $pivot = $item->platforms()->where(['platforms.id' => $platform->id])->get()->first()->pivot;
               
               $price += ((double) $pivot->price);
              }
            ?>
            <td style="width:200px;padding:15px 5px 25px 5px;font-weight: 400;">
              <div style="width:100%;text-align:center;">
                <span style="font-size:16px;">{{ '$'.number_format($price, 2, '.', ',').' MXN' }}</span>
              </div>
            </td>
          </tr>
        @endforeach
        <tr>
          <td colspan="2" style="padding:4px;"></td>
          <td style="padding:4px;"></td>
        </tr>
        <tr>
          <td colspan="2" style="padding: 8px;text-align: right; border-top: 1px solid #000;font-weight:500;">Subtotal:</td>
          <td style="padding: 8px;text-align: right; border-top: 1px solid #000;font-weight: 400;">
            <span>{{ '$'.number_format($email_data['quote']->subtotal, 2, '.', ',').' MXN' }}</span>
          </td>
        </tr>
        <tr style="padding-top: 20px;">
          <td colspan="2" style="padding: 8px;text-align: right;font-weight:500;">
            <span>Descuento ({{ $email_data['quote']->discount_percentage.'%' }}):</span>
          </td>
          <td style="padding: 8px;text-align: right;font-weight: 400;">
            <span>{{ '$'.number_format($email_data['quote']->discount_amount, 2, '.', ',').' MXN' }}</span>
          </td>
        </tr>
        <tr style="padding-top: 20px;">
          <td colspan="2" style="padding: 8px;text-align: right; border-top: 1px solid #000;"><b>TOTAL:</b></td>
          <td colspan="2" style="padding: 8px;text-align: right; border-top: 1px solid #000;"><b>{{ '$'.number_format($email_data['quote']->total, 2, '.', ',').' MXN' }}</b></td>
        </tr>
      </table>
    </div>
    @if (isset($email_data['quote']->apply_discount) && isset($email_data['quote']->promotion_code) && !empty($email_data['quote']->promotion_code))
      <div style="width:92%;display:block;margin:auto;">
        <p style="font-size:14px;">*** Utilizaste el código de promoción: <b>{{ $email_data['quote']->promotion_code }}</b></p>
      </div>
    @endif
    <div style="width:92%;display:block;margin:30px auto 0 auto;">
      <p><b>Atentanmente</b><br/>
      <a href="mailto:ventas@urcorp.mx">ventas@urcorp.mx</a><br/>
      Teléfono: <a href="tel:+524422175369" style="color:#000;text-decoration:none;">+52 (1) 442 217 5369</a><br/></p>
    </div>
    <br/>
    <!--hr style="width: 95%; height: 2pt; background-color: black;"-->
    <div style="width:100%;display:block;margin:auto;min-height:110px;background-color: #111111;font-family:helvetica,arial,sans-serif;color:#F1F1F1;font-size:16px;padding:45px 0 30px 0;">
      <p style="width:92%;display:block;margin:auto;text-align:justify;">
        Este correo electrónico y cualquiera de sus anexos podrían contener información confidencial. Si usted no es el destinatario, por el presente se le notifica que cualquier difusión y copiado de este correo electrónico y cualquiera de sus anexos o uso de su contenido por cualquier medio está estrictamente prohibido. Si usted recibió este correo electrónico equivocadamente o por error, por favor notifíquelo al remitente inmediatamente y cancele este correo electrónico y todos sus anexos de su ordenador (computadora).
      </p>
      <div style="width:92%;display:block;margin:auto;">
        <img src="{!! asset('public/assets/img/v2/urcorp-logo.svg') !!}" style="width:168px;height:40px;display:block;margin: 20px 0 0 auto;" />
      </div>
    </div>
  </div>
</div>
</body>
</html>