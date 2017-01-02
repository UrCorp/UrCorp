<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Package extends Model implements SluggableInterface {
  use SluggableTrait;

  protected $sluggable = [
    'max_length'  => 15,
    'build_from'  => 'name',
    'save_to'     => 'slug',
    'on_update'   => true
  ];

  protected $table = 'packages';

  protected $fillable = [
    'name',
    'slug',
    'short_description',
    'priority',
    'section_id',
    'icon_id'
  ];

  protected $hidden = [
    'id'
  ];

  public function section() {
    return $this->belongsTo('App\Section');
  }

  public function icon() {
    return $this->belongsTo('App\Icon');
  }

  public function items() {
    return $this->belongsToMany('App\Item', 'packages_items')->withTimestamps();
  }
}
