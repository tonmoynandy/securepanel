<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUsers extends Authenticatable
{
    public $timestamps = false;
    public function setPasswordAttribute($pass)
    {
        
        $this->attributes['password'] = \Hash::make($pass);

    }
}
