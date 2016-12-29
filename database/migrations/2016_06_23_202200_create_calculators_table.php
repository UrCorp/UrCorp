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
      * Calculators - Fields
      * ============================================================= //
      */
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name', 25)->nullable();
      $table->string('slug', 20)->nullable();
      $table->timestamps();
    });
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
