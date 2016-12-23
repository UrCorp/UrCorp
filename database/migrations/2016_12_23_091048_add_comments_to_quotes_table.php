<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsToQuotesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('quotes', function(Blueprint $table) {
      $table->addColumn('text', 'comments', [
        'length' => 250
      ]);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('quotes', function(Blueprint $table) {
      $table->dropColumn('comments');
    });
  }
}
