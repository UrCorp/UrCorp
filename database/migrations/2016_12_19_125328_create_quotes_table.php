<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('quotes', function(Blueprint $table) {
      /**
       * Quotes - Fields
       * ============================================================= //
       */
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('customer_name', 60);
      $table->string('email', 250);
      $table->decimal('subtotal', 17, 4);
      $table->boolean('apply_discount');
      $table->string('promotion_code', 8)->nullable();
      $table->decimal('discount_percentage', 17, 4);
      $table->decimal('discount_amount', 17, 4);
      $table->decimal('total', 17, 4);
      $table->string('operation_id', 11);
      $table->string('operation_code', 8);
      $table->timestamps();
    });

    /**
     * Quotes/Platforms - Relationship
     * ============================================================= //
     */
    Schema::create('quotes_platforms', function(Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->integer('quote_id')->unsigned();
      $table->integer('platform_id')->unsigned();
      $table->timestamps();

      /**
       * Quotes/Platforms - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('quote_id')
            ->references('id')->on('quotes')
            ->onDelete('cascade');

      $table->foreign('platform_id')
            ->references('id')->on('platforms');
            /* ->onDelete('cascade'); */
    });

    /**
     * Quotes/Items - Relationship
     * ============================================================= //
     */
    Schema::create('quotes_items', function(Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->integer('quote_id')->unsigned();
      $table->integer('item_id')->unsigned();
      $table->timestamps();

      /**
       * Quotes/Items - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('quote_id')
            ->references('id')->on('quotes')
            ->onDelete('cascade');

      $table->foreign('item_id')
            ->references('id')->on('items');
            /* ->onDelete('cascade'); */
    });

    /**
     * Quotes/PromotionCodes - Relationship
     * ============================================================= //
     */
    Schema::create('quotes_promotion_codes', function(Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->integer('quote_id')->unsigned();
      $table->integer('promotion_code_id')->unsigned();
      $table->timestamps();

      /**
       * Quotes/PromotionCodes - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('quote_id')
            ->references('id')->on('quotes')
            ->onDelete('cascade');

      $table->foreign('promotion_code_id')
            ->references('id')->on('promotion_codes');
            /* ->onDelete('cascade'); */
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('quotes_promotion_codes');
    Schema::drop('quotes_items');
    Schema::drop('quotes_platforms');
    Schema::drop('quotes');
  }
}
