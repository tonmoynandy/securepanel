<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model
{
    use SoftDeletes;
    protected $table = 'countries';
    public function flagImage()
    {
        return $this->hasOne('App\Media', 'element_id')->where('type','7');
    }

    public function local()
    {
        return $this->hasMany('App\TranslateCountry', 'country_id');
    }

    public function states()
    {
        return $this->hasMany('App\State', 'country_id');
    }

    public function cities()
    {
        return $this->hasMany('App\City', 'country_id');
    }
}
