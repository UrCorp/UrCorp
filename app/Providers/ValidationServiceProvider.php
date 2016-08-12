<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidationServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
    Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
      return preg_match("/^[0-9]{10,15}$/", $value);
    });
  }

  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    
  }
}
