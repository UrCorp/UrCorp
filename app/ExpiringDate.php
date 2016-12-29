<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpiringDate extends Model
{
  protected $fillable = [
    'start_date',
    'expiry_date'
  ];

  public function promotionCodes() {
    return $this->belongsToMany('App\PromotionCode', 'promotion_codes_expiring_dates')->withTimestamps();
  }
}
