<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Platform extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'max_length'  => 15,
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'platforms';

  protected $fillable = [
    'name',
    'slug',
    'calculator_id',
    'icon_id'
  ];

  public function calculator() {
    return $this->belongsTo('App\Calculator');
  }

  public function items() {
    return $this->belongsToMany('App\Item', 'item_platform')->withPivot(['price'])->withTimestamps();
  }

  public function icon() {
    return $this->belongsTo('App\Icon');
  }

  public function quotes() {
    return $this->belongsToMany('App\Quote', 'quotes_platforms')->withTimestamps();
  }

  /**
   * Platform - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = $value;
  }
}
