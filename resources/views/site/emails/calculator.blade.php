<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Cotización de Aplicaciones | UrCorp</title>
</head>
<body style="background-color: #F5F5F5;">
  <div style="display:block;width:80%;margin:auto;margin-top:50px;margin-bottom:15px;background-color:white;padding:15px;border-radius:3px;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">
    <div style="display:block;margin:auto;">
      <div style="width:92%; display:block; margin: 25px auto 15px auto;">
        <img src="{{ asset('public/assets/img/logo.png') }}" title="UrCorp - Logo" style="display:inline-block;width:180px;height:66px;background-position:center center;background-size:contain;background-repeat:no-repeat;display:inline-block;vertical-align: middle;margin-left:20px;" /> 
      </div> 
      <div style="width:92%; display:block; margin: auto auto 15px auto;">
        <h1 style="color: #333;font-family: helvetica, arial, sans-serif;font-size:22px;text-align:center;"> 
          COTIZACIÓN DE APLICACIONES
        </h1>
      </div>
    </div>
    <div style="width:92%;display:block;margin:auto;margin: auto;">
      <div style="font-family:helvetica,arial,sans-serif;color:#333;font-size:16px;padding:15px;">
        <h4 style="font-size:18px;font-weight:lighter;margin: 0 0 15px 0;"> Haz cotizado una aplicación con los siguientes requerimientos: </h4>
        <?php 
          $list_platforms   = $q["platforms"];
          $n_list_platforms = count($list_platforms);
          $list_feaatures   = $q["list"];
          $n_list_features  = count($list_feaatures);
        ?>
        <h3 style="font-size:20px;font-weight: lighter;margin: 0 0 15px 0;display:inline-block;">
          Plataformas: &nbsp;
        </h3>
        <p style="text-align: justify;margin-bottom: 15px;display:inline-block;">
          @for ($i = 0; $i < $n_list_platforms; ++$i) 
            @if ($i)
              ,
            @endif
            {{ $list_platforms[$i] }}
          @endfor
        </p>
        <h3 style="font-size:20px;font-weight: lighter;margin: 0 0 15px 0;">
          Características:
        </h3>
        <p style="text-align: justify;margin-bottom: 15px;">
          <ul style="margin-top:30px;">
          @for ($i = 0; $i < $n_list_features; ++$i)
            <li style="font-size: 18px;">
              {{ $list_feaatures[$i]['name'] }}  
              <div style="float:right;display:block;">
                {{ '$'.number_format($list_feaatures[$i]['price'], 2) }}
              </div>
            </li>
            <br/>
          @endfor
            <li style="list-style: none;font-size:22px;font-weight:bold;margin: 20px auto 0 auto;">
              Total:
              <div style="float:right;display:block;">
                {{ '$'.number_format($q["total"], 2) }}
              </div>
            </li>
          </ul>
        </p>
      </div>
    </div>
    <div style="width:92%;display:block;margin:auto;margin: auto;">
      <div style="font-family:helvetica,arial,sans-serif;color:#333;font-size:16px;padding:15px;">
        <h3 style="font-size:20px;font-weight: lighter;margin: 0 0 15px 0;">
          ¿Estas interesado por nuestros servicios? 
        </h3>
        <p style="text-align: justify;margin-bottom: 15px;">
          Por favor, redactanos un correo a <a href="mailto:contacto@urcorp.mx" style="color:#333;">contacto@urcorp.mx</a> con los requerimientos de tu aplicación o bien reenviando este mensaje incluyendo tu número de teléfono o celular para poder comunicarnos contigo. 
        </p>
      </div>
    </div>
    <div style="width:92%;display:block;margin: auto auto 25px auto;text-align:center;">
      <a href="mailto:contacto@urcorp.mx" style="background-color:#5bc0de;padding:15px;border-radius:3px;font-family:helvetica,arial,sans-serif;color:#F1F1F1;font-size:16px;display:inline-block;text-decoration: none;">
        Contactar
      </a>
    </div>
    <div style="width:92%;display:block;margin: auto auto 25px auto;">
      <div style="background-color:#FFAE3F;padding:15px;border-radius:3px;font-family:helvetica,arial,sans-serif;color:#F1F1F1;font-size:16px;">
        Haz recibido este correo desde el formulario de cotización con origen en
        <a href="{{ URL::to('/calculator/index') }}" style="font-weight:bold;color:#F1F1F1;">{{ URL::to('/calculator') }}</a> | <b> Importante:</b> 
        La fuente de este correo es totalmente segura así como su contenido, 
        denunciar este correo bloquearía el recibir mensajes a futuro.
      </div>
    </div>
  </div>
</body>
</html>