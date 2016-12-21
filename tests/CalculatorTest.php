<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalculatorTest extends TestCase {
  /**
   * A basic test example.
   *
   * @return void
   */
  public function testExample() {
    $resp = $this->call('POST', '/api/v1/calculator/web/sendByEmail', [
      'quote' => [
        'email'     => 'mikebsg01@gmail.com',
        'platforms' => [
          'android-phone',
          'web'
        ],
        'items'     => [
          'perfiles',
          'geolocalizacion-y-brujula-con-api-google-maps',
          'sistema-de-administracion-de-pagos-cuentas'
        ]
      ]
    ]);
    
    echo $resp;
  }
}