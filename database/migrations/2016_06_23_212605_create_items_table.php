<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Item;

class CreateItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('items', function(Blueprint $table) {
      /**
       * Items - Fields
       * ============================================================= //
       */
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name', 60);
      $table->string('slug', 20)->nullable();
      $table->string('short_description', 250);
      $table->integer('section_id')->unsigned();
      $table->integer('icon_id')->unsigned();
      $table->timestamps();
      /**
       * Items - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('section_id')
            ->references('id')->on('sections')
            ->onDelete('cascade');

      $table->foreign('icon_id')
            ->references('id')->on('icons')
            ->onDelete('cascade');
    });

    Schema::create('item_platform', function(Blueprint $table) {
      /**
       * Item/Platform - Fields
       * ============================================================= //
       */
      $table->engine = 'InnoDB';
      $table->integer('item_id')->unsigned();
      $table->integer('platform_id')->unsigned();
      $table->decimal('price', 17, 4);
      $table->timestamps();
      /**
       * Item/Platform - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade');

      $table->foreign('platform_id')
            ->references('id')->on('platforms')
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
    Schema::drop('item_platform');
    Schema::drop('items');
  }
}
