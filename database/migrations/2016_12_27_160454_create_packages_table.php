<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('packages', function(Blueprint $table) {
      /**
       * Packages - Fields
       * ============================================================= //
       */
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name', 60);
      $table->string('slug', 20)->nullable();
      $table->integer('priority')->unsigned();
      $table->string('short_description', 250);
      $table->integer('section_id')->unsigned();
      $table->integer('icon_id')->unsigned();
      $table->timestamps();

      /**
       * Packages - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('section_id')
            ->references('id')->on('sections')
            ->onDelete('cascade');

      /*$table->foreign('icon_id')
            ->references('id')->on('icons')
            ->onDelete('cascade');*/
    });

    Schema::create('packages_items', function(Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->integer('package_id')->unsigned();
      $table->integer('item_id')->unsigned();
      $table->timestamps();

      /**
       * Packages/Items - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('package_id')
            ->references('id')->on('packages')
            ->onDelete('cascade');

      $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('packages_items');
    Schema::drop('packages');
  }
}
