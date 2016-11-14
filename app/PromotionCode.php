<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
  protected $fillable = [
    'code',
    'percentage'
  ];

  public function referringUsers() {
    return $this->belongsToMany('App\ReferringUser', 'promotion_codes_referring_users')->withTimestamps();
  }
}
