<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::group(['as' => 'site.'], function () {

  Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {

    Route::get('/login', [
      'uses' => 'Auth\AuthController@getLogin',
      'as' => 'login'
    ]);

    Route::post('/login', [
      'uses' => 'Auth\AuthController@postLogin',
      'as' => 'login'
    ]);

    Route::get('/logout', [
      'uses' => 'Auth\AuthController@logout',
      'as' => 'logout'
    ]);

    Route::group(['middleware' => ['admin']], function() {

      Route::group(['prefix' => 'panel', 'as' => 'panel.'], function() {

        Route::get('/', [
          'uses'  => 'Admin\Panel@index',
          'as'    => 'index'
        ]);

        Route::group(['prefix' => 'calculator', 'as' => 'calculator.'], function() {
          
          Route::get('/', [
            'uses'  => 'Admin\CalculatorManagement@index',
            'as'    => 'index'
          ]);

          Route::get('/create', [
            'uses'  => 'Admin\CalculatorManagement@create',
            'as'    => 'create'
          ]);

          Route::post('/', [
            'uses'  => 'Admin\CalculatorManagement@store',
            'as'    => 'store'
          ]);

          Route::get('/{calculator}', [
            'uses'  => 'Admin\CalculatorManagement@show',
            'as'    => 'show'
          ]);

          Route::get('/{calculator}/edit', [
            'uses'  => 'Admin\CalculatorManagement@edit',
            'as'    => 'edit'
          ]);

          Route::put('/{calculator}', [
            'uses'  => 'Admin\CalculatorManagement@update',
            'as'    => 'update'
          ]);

          Route::get('/{calculator}/destroy', [
            'uses'  => 'Admin\CalculatorManagement@destroy',
            'as'    => 'destroy'
          ]);

          Route::group(['prefix' => '{calculator}/sections', 'as' => 'sections.'], function() {

            Route::get('/create', [
              'uses' => 'Admin\Sections@create',
              'as' => 'create'
            ]);

            Route::post('/', [
              'uses'  => 'Admin\Sections@store',
              'as'    => 'store'
            ]);

            Route::get('/{section}/edit', [
              'uses'  => 'Admin\Sections@edit',
              'as'    => 'edit'
            ]);

            Route::put('/{section}', [
              'uses'  => 'Admin\Sections@update',
              'as'    => 'update'
            ]);

            Route::get('/{section}/destroy', [
              'uses'  => 'Admin\Sections@destroy',
              'as'    => 'destroy'
            ]);
          });

          Route::group(['prefix' => '{calculator}/platforms', 'as' => 'platforms.'], function() {

            Route::get('/create', [
              'uses'  => 'Admin\Platforms@create',
              'as'    => 'create'
            ]);

            Route::post('/', [
              'uses'  => 'Admin\Platforms@store',
              'as'    => 'store'
            ]);

            Route::get('/{platform}/edit', [
              'uses'  => 'Admin\Platforms@edit',
              'as'    => 'edit'
            ]);

            Route::put('/{platforms}', [
              'uses'  => 'Admin\Platforms@update',
              'as'    => 'update'
            ]);

            Route::get('/{platform}/destroy', [
              'uses'  => 'Admin\Platforms@destroy',
              'as'    => 'destroy'
            ]);
          });

          Route::group(['prefix' => '{calculator}/items', 'as' => 'items.'], function() {

            Route::get('/create', [
              'uses'  => 'Admin\Items@create',
              'as'    => 'create'
            ]);

            Route::post('/', [
              'uses'  => 'Admin\Items@store',
              'as'    => 'store'
            ]);

            Route::get('/{item}/edit', [
              'uses'  => 'Admin\Items@edit',
              'as'    => 'edit'
            ]);

            Route::put('/{item}', [
              'uses'  => 'Admin\Items@update',
              'as'    => 'update'
            ]);

            Route::get('/{item}/destroy', [
              'uses'  => 'Admin\Items@destroy',
              'as'    => 'destroy'
            ]);
          });
        });

        Route::group(['prefix' => 'promotions', 'as' => 'promotions.'], function() {

          Route::get('/', [
            'uses'  => 'Admin\Promotions@index',
            'as'    => 'index'
          ]);

          Route::get('/create', [
            'uses'  => 'Admin\Promotions@create',
            'as'    => 'create'
          ]);

          Route::post('/', [
            'uses'  => 'Admin\Promotions@store',
            'as'    => 'store'
          ]);

          Route::get('{promotionCode}/edit', [
            'uses'  => 'Admin\Promotions@edit',
            'as'    => 'edit'
          ]);

          Route::put('{promotionCode}/update', [
            'uses'  => 'Admin\Promotions@update',
            'as'    => 'update'
          ]);

          Route::get('{promotionsCode}/destroy', [
            'uses'  => 'Admin\Promotions@destroy',
            'as'    => 'destroy'
          ]);
        });
      });
    });
  });

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
  });

  Route::group(['prefix' => 'api', 'as' => 'api.'], function () {

    Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {

      Route::group(['prefix' => 'calculator', 'as' => 'calculator.'], function () {

        Route::get('{calculator}/prices', [
          'uses'  => 'Calculator@prices',
          'as'    => 'prices'
        ]);

        Route::post('{calculator}/sendByEmail', [
          'uses'  => 'Calculator@sendByEmail',
          'as'    => 'sendByEmail'
        ]);
      
        Route::group(['prefix' => '{calculator}', 'as' => 'item.'], function () {

          Route::get('{item}/price', [
            'uses'  => 'Calculator@itemPriceByPlatform',
            'as'    => 'getPriceByPlatforms'
          ]);
        });
      });
    });
  });
});