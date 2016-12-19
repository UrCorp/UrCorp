<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model {
  
  protected $table = 'quotes';

  protected $fillable = [
    'subtotal',
    'total',
    'operation_id',
    'operation_code'
  ];

  public function platforms() {
    return $this->belongsToMany('App\Platform', 'quotes_platforms')->withTimestamps();
  }

  public function items() {
    return $this->belongsToMany('App\Item', 'quotes_items')->withTimestamps();
  }

  public function promotionCodes() {
    return $this->belongsToMany('App\PromotionCode', 'quotes_promotion_codes')->withTimestamps();
  }
}
