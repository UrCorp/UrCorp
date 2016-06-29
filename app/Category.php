<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'categories';

  protected $fillable = [
    'name',
    'slug',
    'calculator_id'
  ];

  public function calculator() {
    return $this->belongsTo('App\Calculator');
  }

  public function items() {
    return $this->hasMany('App\Item');
  }

  /**
   * Category - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = cstrtolower($value);
  }
}
