<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Products;
use App\Categories;

class MyController extends Controller
{
    //
    function modelExample(){
        // $p = Products::with('pageUrl')->where('id','<','10')->get();
        // foreach($p as $item){
        //     echo $item->name."--".$item->pageUrl->url."<br>";
        // }
        // dd($p);
        $p = Products::with('categories')->whereIn('id',[2,5])->get();
        foreach($p as $item){
            echo $item->name."--".$item->name."<br>";
        }
        dd($p);
        /* insert
        $bill = new Bill;
        $bill->id_customer = 34;
        $bill->date_order = date('Y-m-d H:i:s',time());
        $bill->total = 1234;
        $bill->save();
        */
        //update
        $bill = Bill::where('id',21)->first();
        if($bill){
            //$bill->id_customer = 34;
            $bill->date_order = date('Y-m-d H:i:s',time());
            $bill->total = 4321;
            $bill->save();
        }else{
            echo "ko tim thay";
        }
        /* delete
        $bill = Bill::where('id',27)->first();
        if($bill){
            $bill->delete();
            // $bill->id_customer = 34;
            // $bill->date_order = date('Y-m-d H:i:s',time());
            // $bill->total = 1234;
            // $bill->save();
        }else{
            echo "ko tim thay";
        }
        */
        
        /* select
        $bills = Bill::where('id','>','10')->orderBy('total','DESC')->get();
        //dd($bills);
        foreach($bills as $b){
            echo $b->total."<br>";
        }
        */
    }
    function index(Request $request){

    }
}
