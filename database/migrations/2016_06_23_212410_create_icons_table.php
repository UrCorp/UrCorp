<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Icon;

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
    
    /**
     * Icons - Seeders
     * ============================================================= //
     */
    $icons = config('init.icons');

    foreach ($icons as $icon) {
      Icon::create($icon);
    }
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
