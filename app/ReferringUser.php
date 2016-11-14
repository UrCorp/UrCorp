<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferringUser extends Model
{
  protected $fillable = [
    'first_name',
    'last_name',
    'email'
  ];

  public function promotionCodes() {
    return $this->belongsToMany('App\PromotionCode', 'promotion_codes_referring_users')->withTimestamps();
  }

  public function getFullNameAttribute() {
    $first_name = current(explode(" ", $this->first_name));
    $last_name = current(explode(" ", $this->last_name));
    $full_name = cucfirst($first_name).' '.cucfirst($last_name);
    
    return $full_name;
  }
}
