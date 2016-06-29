<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Calculator extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'calculators';

  protected $fillable = [
    'name',
    'slug'
  ];

  public function categories() {
    return $this->hasMany('App\Category');
  }

  public function platforms() {
    return $this->hasMany('App\Platform');
  }

  public function items() {
    return $this->hasManyThrough('App\Item', 'App\Category');
  }

  /**
   * Calculator - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = cstrtolower($value);
  }
}
