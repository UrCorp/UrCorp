<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      /**
       * Users - Fields
       * ============================================================= //
       */
      $table->increments('id');
      $table->string('first_name', 45);
      $table->string('last_name', 45);
      $table->string('email')->unique();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });
    
    /**
     * Users - Seeders
     * ============================================================= //
     */
    User::create([
      'first_name'  => 'Michael Brandon',
      'last_name'   => 'Serrato Guerrero',
      'email'       => 'web@urcorp.mx',
      'password'    => bcrypt('xHTtPRqstjQry195brc')
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('users');
  }
}
