<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Calculator;
use App\Platform;
use App\Section;

class AlterCalculatorTables extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {

    $calculator = Calculator::findBySlug('web');

    /**
     * Alter Platforms Table
     */
    Schema::table('platforms', function(Blueprint $table) {
      $table->integer('priority')->unsigned()->after('slug');
    });

    if ($calculator->count() == 1) {

      $platform = $calculator->platforms()->where('slug', '=', 'ios');

      if ($platform->count() == 1) {
        $platform = $platform->first();
        $platform->priority = 2;
        $platform->update();
      }

      $platform = $calculator->platforms()->where('slug', '=', 'android');

      if ($platform->count() == 1) {
        $platform = $platform->first();
        $platform->priority = 3;
        $platform->update();
      }

      $platform = $calculator->platforms()->where('slug', '=', 'web');

      if ($platform->count() == 1) {
        $platform = $platform->first();
        $platform->priority = 1;
        $platform->update();
      }
    }

    /**
     * Alter Sections Table
     */
    Schema::table('sections', function(Blueprint $table) {
      $table->integer('priority')->unsigned()->after('slug');
    });

    if ($calculator->count() == 1) {

      $section = $calculator->sections()->where('slug', '=', 'usuario')->get();

      if ($section->count() == 1) {
        $section = $section->first();
        $section->priority = 2;
        $section->update();
      }

      $section = $calculator->sections()->where('slug', '=', 'administrador')->get();

      if ($section->count() == 1) {
        $section = $section->first();
        $section->priority = 3;
        $section->update();
      }

      $section = new Section([
        'name'          => 'Paquetes',
        'priority'      => 1,
        'calculator_id' =>  $calculator->id
      ]);
      $section->save();
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    /**
     * Restoring Platforms Table
     */
    Schema::table('platforms', function(Blueprint $table) {
      $table->dropColumn('priority');
    });

    /**
     * Restoring Sections Table
     */
    Schema::table('sections', function(Blueprint $table) {
      $table->dropColumn('priority');
    }); 

    $calculator = Calculator::findBySlug('web');

    if ($calculator->count() == 1) {

      $section = $calculator->sections()->where('slug', '=', 'paquetes');

      if ($section->count() == 1) {
        $section = $section->first();
        $section->delete();
      }
    }
  }
}
