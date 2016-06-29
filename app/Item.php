<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Item extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'items';

  protected $fillable = [
    'name',
    'slug',
    'category_id'
  ];

  public function category() {
    return $this->belongsTo('App\Category');
  }

  public function platforms() {
    return $this->belongsToMany('App\Platform', 'item_platform')->withPivot(['price'])->withTimestamps();
  }

  /**
   * Item - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = cstrtolower($value);
  }
}
