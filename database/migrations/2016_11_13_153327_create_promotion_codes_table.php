<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionCodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('promotion_codes', function(Blueprint $table) {
      /**
       * PromotionCodes - Fields
       * ============================================================= //
       */
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('code', 8);
      $table->decimal('percentage', 17, 4);
      $table->timestamps();
    });

    /**
     * PromotionCodes/ReferringUsers - Relationship
     * ============================================================= //
     */
    Schema::create('promotion_codes_referring_users', function(Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->integer('promotion_code_id')->unsigned();
      $table->integer('referring_user_id')->unsigned();
      $table->timestamps();

      /**
       * PromotionCodes/ReferringUsers - Foreign Keys
       * ============================================================= //
       */
      $table->foreign('promotion_code_id')
            ->references('id')->on('promotion_codes')
            ->onDelete('cascade');

      $table->foreign('referring_user_id')
            ->references('id')->on('referring_users')
            ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('promotion_codes_referring_users');
    Schema::drop('promotion_codes');
  }
}
