<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Platform;

class ModifyRowsInPlatformsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    $platformSlugs = [
      'iphone'        => [
        'name'  => 'iOS'
      ],
      'android-phone' => [
        'name'  => 'Android'
      ]
    ];

    foreach ($platformSlugs as $platformSlug => $new_data) {
      $platform = Platform::findBySlug($platformSlug);
      
      $platform->fill($new_data);
      $platform->update();
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    $platformSlugs = [
      'iOS'        => [
        'name'  => 'iPhone'
      ],
      'android' => [
        'name'  => 'Android Phone'
      ]
    ];

    foreach ($platformSlugs as $platformSlug => $new_data) {
      $platform = Platform::findBySlug($platformSlug);
      
      $platform->fill($new_data);
      $platform->update();
    }
  }
}
