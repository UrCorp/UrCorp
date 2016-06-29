<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([
      'first_name'  => 'Michael Brandon',
      'last_name'   => 'Serrato Guerrero',
      'email'       => 'web@urcorp.mx',
      'password'    => bcrypt('xHTtPRqstjQry195brc')
    ]);
  }
}
