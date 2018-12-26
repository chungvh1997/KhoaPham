<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;


class MyController extends Controller
{
    //
    function index(){
        if(Auth::check()){
            return view('pages.index');
        }
        else{
            return redirect()->route('login')->with('error','You must login!');
        }
        
    }
    function getLogin(){
        return view('pages.login');
    }
    function postLogin(Request $req){
        //validation
        $data = [
            'email'=>$req->email,
            'password'=>$req->password
        ];
        if(Auth::attempt($data)){ // boolean
            // dd(Auth::user()); // User::get();
            return redirect()->route('home');
            // return redirect('/');
        }
        else{
            return redirect()->back()->with('error','Email or password invalid!');
        }
    }
    function getRegister(){
        return view('pages.register');
    }
    function postRegister(Request $request){
        $rules = [
            'username' => 'required|string|min:6|max:25|unique:users,username',
            'fullname' => 'required|regex:/\s/',
            'birthdate' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:25|not_regex:/\s/',
            'confirmation_password' => 'required|same:password'
        ];
        
        $message = [
            'email.required'=>':attribute không được rỗng',
            'username.min' => 'username ít nhất :min kí tự'
            
        ];
        $validator = Validator::make($request->all(),$rules,$message); 
        
        if ($validator->fails()) {
            
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput($request->all());
        }
        
        $user = new \App\User; 
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->birthdate = date('Y-m-d',strtotime($request->birthdate));
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->with('success','You login succes');
    }
}
