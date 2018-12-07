<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function XinChao(){
        echo "thuc cho";
    }
    public function KhoaHoc($ten){
        echo "thuc cho".$ten;
        return redirect()->route('myroute');
    }
    public function myView(){
        if(view()->exists('view01')){
            // $data=[
            //     "iduser"=>$id
            // ];
            $iduser =12;
            return view('view01',compact('iduser'));
        }
    }
    public function myViewTen($tenkhoahoc){
        if(view()->exists("myview")){
            
            return view("myview",["tenkhoahoc"=>$tenkhoahoc]);
        }
    }
    public function GetUrl(Request $request){
        echo $request->path()."<br>";
        echo $request->url();
        
    }
   

}
