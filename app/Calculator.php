<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Section;
use App\Platform;

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

  public function sections() {
    return $this->hasMany('App\Section');
  }

  public function platforms() {
    return $this->hasMany('App\Platform');
  }

  public function packages() {
    return $this->hasManyThrough('App\Package', 'App\Section');
  }

  public function items() {
    return $this->hasManyThrough('App\Item', 'App\Section');
  }

  /**
   * Calculator - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = cstrtolower($value);
  }
}
