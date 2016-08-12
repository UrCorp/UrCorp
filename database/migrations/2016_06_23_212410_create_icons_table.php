<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIconsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('icons', function(Blueprint $table) {
      /**
       * Icons - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->string('name', 45);
      $table->string('slug')->nullable();
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
    Schema::drop('icons');
  }
}
