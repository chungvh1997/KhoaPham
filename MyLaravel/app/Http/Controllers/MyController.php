<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{   
    public function XacNhan(){
        return view("testForm");
       
    }
    public function postForm(Request  $reg){
       return $reg->username;
       
    }
    public function getUploadfile(){
        return view('upload');
    }
    public function postUploadfile(Request $request){
        if ($request->file('myFile')) {
            $file = $request->file('myFile');
            $name = $file->getClientOriginalName();
            $size = $file->getClientSize();
            $ext = $file->getClientOriginalExtension();
            $mimeType = $file->getClientMimeType();
            //dd($file);
            //return $file = $request->myFile;
            
            $tmp = $file->path();
            move_uploaded_file($tmp,"avatar/$name");
            echo "thanh cong";
            
            
        }else{
            return redirect()->route("upload")->with('error','Please choose file');
        }
        
    }
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
