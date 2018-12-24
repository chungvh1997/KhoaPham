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
          //c1 C:1 select lien ket 3 bang n-n
          $data = \App\Bill::with('product')->limit(3)->get();
          foreach($data as $b){
              echo "<h5>BillID: ".$b->id."</h5>";
              foreach($b->product as $p){
                  echo "<li>".$p->name."</li>";
              }
          }
          echo "<hr>";
          //c2 C:2 select lien ket 3 bang n-n
          $bill = \App\Bill::with('billDetail.product')->limit(3)->get();
          foreach($bill as $b){
              echo "<h5>BillID:".$b->id."</h5>";
              foreach($b->billDetail as $detail){
                  echo '<li>'.$detail->product->name.'</li>';
              }            
          }
          // dd($bill);
       
        // $data = Bill::with('product')->limit(3)->get();
        // dd($data);
        /* select 1-n
        $p = Products::with('pageUrl')->where('id','<','10')->get();
        foreach($p as $item){
            echo $item->name."--".$item->pageUrl->url."<br>";
        }
        dd($p);
        */
        /* select 
        $p = Products::with('categories')->whereIn('id',[2,5])->get();
        foreach($p as $item){
            echo $item->name."--".$item->name."<br>";
        }
        dd($p);
        */
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
