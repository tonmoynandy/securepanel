<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }
    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }
    public function local()
    {
        return $this->hasMany('App\TranslateCity', 'city_id');
    }
}
