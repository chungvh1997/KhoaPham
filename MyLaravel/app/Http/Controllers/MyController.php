<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class MyController extends Controller
{   
    public function Trangchu(){
        return view("pages/home");
    }
    public function Login(Request $req){

        return view("pages/login");
    }
    
    public function postLogin(Request $req){
        
        $rules = [
            'fullname' => 'required|min:6|max:25|regex:/\s/',
            'password' => 'required|min:6|max:25|not_regex:/\s/',
            'confirm-password' => 'same:password',
            'age' => 'required|numeric',
            'email' => 'required|email'
        ];
        
        $message = [
            'email.required'=>':attribute không được rỗng',
            'fullname.min' => 'fullname ít nhất :min kí tự'
            
        ];
        $validator = Validator::make($req->all(),$rules,$message); 
        

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($req->all());
        }
        dd($req->all());
        
    }

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
            //C1: 1 file
            // $name = $file->getClientOriginalName();
            // $size = $file->getClientSize();
            // $ext = $file->getClientOriginalExtension();
            // $mimeType = $file->getClientMimeType();
            // $tmp = $file->path();
            // move_uploaded_file($tmp,"avatar/$name");
            // echo "thanh cong";
            //C2: n file
            foreach($file as $img){
                $name = $img->getClientOriginalName();
                $img->move("avatar",$name);
            }
            return redirect()->route("getuploadfile")->with('succes','Upload succes');
        }else{
            return redirect()->route("upload")->with('error','Please choose file');
        }
        
    }
    public function testSession(Request $request){

        if(!$request->has("user")){
            $request->session()->put("user","admin");
        }
        return view("testSession");
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
