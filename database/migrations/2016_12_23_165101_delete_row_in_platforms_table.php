<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Platform;

class DeleteRowInPlatformsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    $platformSlugs = [
      'ipad',
      'android-tablet',
      'phonegap'
    ];

    foreach ($platformSlugs as $platformSlug) {
      $platform = Platform::findBySlug($platformSlug);
      $platform->delete();
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    $platforms = [
      [
        'name'          => 'iPad',
        'calculator_id' => 1,
        'icon_id'       => 389
      ],
      [
        'name'          => 'Android Tablet', 
        'calculator_id' => 1, 
        'icon_id'       => 391
      ],
      [
        'name'          => 'Phonegap',
        'calculator_id' => 1,
        'icon_id'       => 269
      ]
    ];

    foreach ($platforms as $platformData) {
      $platform = new Platform($platformData);
      $platform->save();
    }
  }
}
