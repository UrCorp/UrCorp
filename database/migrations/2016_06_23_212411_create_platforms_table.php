<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('platforms', function(Blueprint $table) {
      /**
       * Platforms - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->string('name', 45);
      $table->string('slug')->nullable();
      $table->integer('calculator_id')->unsigned();
      $table->integer('icon_id')->unsigned();
      $table->timestamps();
      /**
       * Platforms - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('calculator_id')
            ->references('id')->on('calculators')
            ->onDelete('cascade');

      $table->foreign('icon_id')
            ->references('id')->on('icons')
            ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('platforms');
  }
}
