<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
  protected $fillable = [
    'code',
    'percentage',
    'start_date',
    'expiry_date'
  ];

  public function referringUsers() {
    return $this->belongsToMany('App\ReferringUser', 'promotion_codes_referring_users')->withTimestamps();
  }

  public function quotes() {
    return $this->belongsToMany('App\Quote', 'quotes_promotion_codes')->withTimestamps();
  }
}
