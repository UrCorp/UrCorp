<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Calculator;

class CreateCalculatorsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('calculators', function(Blueprint $table) {
      /**
      * Calculators - Seeders
      * ============================================================= //
      */
      $table->increments('id');
      $table->string('name', 45)->nullable();
      $table->string('slug')->nullable();
      $table->timestamps();
    });
    /**
      * Calculators - Seeders
      * ============================================================= //
      */
     $calculators = config('init.calculators');

     foreach ($calculators as $calculator) {
       Calculator::create($calculator);
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('calculators');
  }
}
