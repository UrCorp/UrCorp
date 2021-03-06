<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Section extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'sections';

  protected $fillable = [
    'name',
    'slug',
    'priority',
    'calculator_id'
  ];

  public function calculator() {
    return $this->belongsTo('App\Calculator');
  }

  public function packages() {
    return $this->hasMany('App\Package');
  }

  public function items() {
    return $this->hasMany('App\Item');
  }

  /**
   * Category - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = $value;
  }
}
