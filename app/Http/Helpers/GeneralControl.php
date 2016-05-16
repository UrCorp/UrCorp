<?php 
  // Archivo: GeneralControl.php
  // Ubicación: App/Helpers/GeneralControl.php
  // Descripción: Implementa una gran variedad de
  // funciones útiles para el desarrollo de
  // la aplicación.

  function cstrtolower($str) {

    return mb_strtolower($str, 'UTF-8');
  }

  function cstrtoupper($str) {

    return mb_strtoupper($str, 'UTF-8');
  }

  function cucfirst($str) {

    $fc         = cstrtoupper(mb_substr($str, 0, 1));
    $final_str  = $fc.mb_substr($str, 1);
    return $final_str;
  }

  function cucwords($str) {

    $str_lower = mb_strtolower($str, "UTF-8");
    $str_ucwords = mb_convert_case($str_lower , MB_CASE_TITLE, "UTF-8");
    return $str_ucwords;
  }

  function generateRandomString($length = 13) {
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $n_str = strlen($str);
    $random_str = '';
    for ($i = 0; $i < $length; $i++) {
        $random_str .= $str[rand(0, $n_str - 1)];
    }
    return $random_str;
  }

  function generateKey($length = null) {
    
    if (is_null($length)) {
      $length = 13;
    }

    $random_str = generateRandomString($length);

    return Crypt::encrypt($random_str);
  }