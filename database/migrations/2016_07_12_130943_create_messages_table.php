<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('messages', function(Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->text('content');
      $table->integer('message_id')->unsigned();
      $table->string('messsage_type');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('messages');
  }
}
