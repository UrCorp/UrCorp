<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quote extends Model {
  
  protected $table = 'quotes';

  protected $fillable = [
    'customer_name',
    'email',
    'subtotal',
    'apply_discount',
    'promotion_code',
    'discount_percentage',
    'discount_amount',
    'total',
    'operation_id',
    'operation_code',
    'comments'
  ];

  public function __construct($attributes = []) {
    parent::__construct($attributes);

    $this->attributes['operation_id']   = $this->getNewOperationID();
    $this->attributes['operation_code'] = $this->getNewOperationCode();
  }

  public function platforms() {
    return $this->belongsToMany('App\Platform', 'quotes_platforms')->withTimestamps();
  }

  public function items() {
    return $this->belongsToMany('App\Item', 'quotes_items')->withTimestamps();
  }

  public function promotionCodes() {
    return $this->belongsToMany('App\PromotionCode', 'quotes_promotion_codes')->withTimestamps();
  }

  /**
   * Quote - Static Functions
   */

  protected function getNewOperationID() {
    if (function_exists('generateRandomStringNumberString')) {
      $dt = Carbon::now();

      return "UR" . $dt->format('ymd') . generateRandomStringNumberString(3);
    }
    return null;
  }

  protected function getNewOperationCode() {
    if (function_exists('str_random')) {
      return str_random(8);
    }
    return null;
  }
}