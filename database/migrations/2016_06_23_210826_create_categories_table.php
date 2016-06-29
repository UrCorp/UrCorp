<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function(Blueprint $table) {
      /**
       * Categories - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->string('name', 45)->nullable();
      $table->string('slug')->nullable();
      $table->integer('calculator_id')->unsigned();
      $table->timestamps();

      /**
       * Categories - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('calculator_id')
            ->references('id')->on('calculators')
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
    Schema::drop('categories');
  }
}
