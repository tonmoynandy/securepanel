<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function cities()
    {
        return $this->hasMany('App\City', 'country_id');
    }
    
    public function local()
    {
        return $this->hasMany('App\TranslateState', 'state_id');
    }
}
