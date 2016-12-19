<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Platform;

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
      $table->engine = 'InnoDB';
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

    /**
      * Platforms - Seeders
      * ============================================================= //
      */
    $platforms = config('init.platforms');

    foreach ($platforms as $platform) {
      Platform::create($platform);
    }
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
