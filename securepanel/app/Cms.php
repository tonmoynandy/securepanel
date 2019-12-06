<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
	//********** hasMany relation with translate cms table ************//
    public function translateCms()
    {
        return $this->hasMany('App\TranslateCms', 'page_id');
    }
}
