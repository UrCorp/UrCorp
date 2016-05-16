<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $table = "contacts";

  protected $fillable = [
    'id_session',
    'name',
    'email',
    'quotation'
  ];

}
