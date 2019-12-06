<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslateCms extends Model
{
    public $timestamps = false;
    //********** hasOne relation with media table ************//
    public function media()
    {
        return $this->hasOne('App\Media', 'element_id')->where('type','1');
    }
}
