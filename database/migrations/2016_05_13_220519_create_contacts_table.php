<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contacts', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('id_session');
      $table->string('name', 60);
      $table->string('email', 250);
      $table->string('phone', 15);
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
    Schema::drop('contacts');
  }
}
