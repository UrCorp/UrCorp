<?php

use Illuminate\Database\Seeder;

class IconsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $tmp_date = date('Y-m-d H:i:s');
    DB::table('icons')->insert([
      'name'        => 'NONE',
      'created_at'  => $tmp_date,
      'updated_at'  => $tmp_date
    ]);

    $iconlist = File::get('database/seeds/datafiles/icon-list.json');
    $iconlist = json_decode($iconlist);

    for ($i = 0; $i < count($iconlist->icons); ++$i) {
      $tmp_date = date('Y-m-d H:i:s');

      DB::table('icons')->insert([
        'name'        => $iconlist->icons[$i],
        'created_at'  => $tmp_date,
        'updated_at'  => $tmp_date
      ]);
    }
  }
}
