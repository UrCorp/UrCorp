<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute() {
        $first_name = current(explode(" ", $this->first_name));
        $last_name = current(explode(" ", $this->last_name));
        $full_name = cucfirst($first_name).' '.cucfirst($last_name);
        
        return $full_name;
    }
}
