<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = "products";
    //otherkey
    function pageUrl(){
        return $this->belongsTo('App\PageUrl','id_url','id');
    }
    function categories(){
        return $this->belongsTo('App\Categories','id_type','id');
    }
}
