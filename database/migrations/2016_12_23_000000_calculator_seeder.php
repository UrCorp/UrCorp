<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Calculator;
use App\Section;
use App\Platform;
use App\Icon;
use App\Item;

class CalculatorSeeder extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    /**
      * Calculators - Seeder
      * ============================================================= //
      */
     $calculators = config('init.calculators');

     foreach ($calculators as $calculator) {
       Calculator::create($calculator);
    }

    /**
     * Sections - Seeder
     * ============================================================= //
     */
    $sections = config('init.sections');

    foreach ($sections as $section) {
      Section::create($section);
    }
    
    /**
     * Icons - Seeder
     * ============================================================= //
     */
    $icons = config('init.icons');

    foreach ($icons as $icon) {
      Icon::create($icon);
    }

    /**
      * Platforms - Seeder
      * ============================================================= //
      */
    $platforms = config('init.platforms');

    foreach ($platforms as $platform) {
      Platform::create($platform);
    }

    /**
     * Item/Platform - Seeder
     * ============================================================= //
     */
    $items = config('init.items');

    foreach($items as $item) {
      $item_platform = null;

      if (isset($item['item_platform']) and !empty($item['item_platform'])) {
        $item_platform = $item['item_platform'];
        unset($item['item_platform']);
      }

      $tmp_item = Item::create($item);

      if (!is_null($item_platform)) {
        for ($i = 0; $i < count($item_platform); ++$i) {
          $tmp_item->platforms()->attach($item_platform[$i]['platform_id'], $item_platform[$i]['additional']);
        }
      }
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    // here nothing...
  }
}
