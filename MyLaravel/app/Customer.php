<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
 
    function billDetail(){
        return $this->hasManyThrough('App\Bill_detail','App\Bill','id_customer','id_bill');
    }
}
