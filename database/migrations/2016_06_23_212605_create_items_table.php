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
      $table->string('name', 45);
      $table->string('slug')->nullable();
      $table->string('short_description');
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

    /**
     * Item/Platform - Seeders
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
  public function down()
  {
    Schema::drop('item_platform');
    Schema::drop('items');
  }
}
