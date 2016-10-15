<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Section;

class CreateSectionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sections', function(Blueprint $table) {
      /**
       * Categories - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->string('name', 45);
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

    /**
     * Categories - Foreign Keys
     * ============================================================= //
     */
    $sections = config('init.sections');

    foreach ($sections as $section) {
      Section::create($section);
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('sections');
  }
}
