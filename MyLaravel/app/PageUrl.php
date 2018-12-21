<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageUrl extends Model
{
    //
    protected $table = "page_url";
    // localkey
    function product(){
        return $this->hasOne('App\PageUrl','id_url','id');
    }
}
