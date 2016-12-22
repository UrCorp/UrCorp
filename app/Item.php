<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Item extends Model implements SluggableInterface
{
  use SluggableTrait;

  protected $sluggable = [
    'max_length'  => 15,
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'items';

  protected $fillable = [
    'name',
    'slug',
    'short_description',
    'section_id',
    'icon_id'
  ];

  public function section() {
    return $this->belongsTo('App\Section');
  }

  public function platforms() {
    return $this->belongsToMany('App\Platform', 'item_platform')->withPivot(['price'])->withTimestamps();
  }

  public function icon() {
    return $this->belongsTo('App\Icon');
  }

  public function quotes() {
    return $this->belongsToMany('App\Quote', 'quotes_items')->withTimestamps();
  }

  /**
   * Item - Mutators
   * ============================================================= //
   */
  public function setNameAttribute($value) {
    $this->attributes['name'] = $value;
  }
}
