<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['as' => 'site.'], function () {

  Route::group(['as' => 'welcome.'], function () {

    Route::get('/', [
      'uses'  => 'Welcome@index',
      'as'    => 'index'
    ]);

  });

  Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {

    Route::post('/send', [
      'uses'  => 'Contact@send',
      'as'    => 'send'
    ]);

    Route::post('/save', [
      'uses'  => 'Contact@save',
      'as'    => 'save'
    ]);

  });

  Route::group(['prefix' => 'calculator', 'as' => 'calculator.'], function () {

    Route::get('/', [
      'uses'  => 'Calculator@index',
      'as'    => 'index'
    ]);

    Route::get('/index', [
      'uses'  => 'Calculator@index',
      'as'    => 'index'
    ]);

    Route::post('/features', [
      'uses'  => 'Calculator@features',
      'as'    => 'features'
    ]);

    Route::post('/send', [
      'uses'  => 'Calculator@send',
      'as'    => 'send'
    ]);

  });

});
