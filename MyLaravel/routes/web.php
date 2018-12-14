<?php

use Illuminate\Support\Facades\View;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Actions Handled By Resource Controller
Route::resource('photos', 'PhotoController')->only([
    'index', 'show'
]);

Route::resource('photos', 'PhotoController')->except([
    'create', 'store', 'update', 'destroy'
]);

Route::resource('photos', 'PhotoController')->names([
    'create' => 'photos.build'
]);


Route::prefix("Tesst")->group(function(){  
    // blade templa
    Route::get('home', "MyController@Trangchu");
    Route::get('login', "MyController@Login");
    Route::post('login', "MyController@postLogin");
    // route form login send
    Route::get("viewform","MyController@XacNhan");
    Route::post("viewform","MyController@postForm");
    // route upload
    Route::get('upload', "MyController@getUploadfile")->name("getuploadfile");
    Route::post('upload', "MyController@postUploadfile")->name("uploadfile");
    //route session
    Route::get('getSession',"MyController@testSession");

    Route::get('KhoaHoc', function () {
        return "Khoa hoc laravel";
    })->name('myroute');

    /*Goi Controller
    Route::get('GoiController','MyController@XinChao');*/

    // Truyen tham so cho Controller
     Route::get('GoiController/{ten}','MyController@KhoaHoc');

    // goi View
    Route::get("view01","MyController@myView");

    // Truyen tham so View
    View::share("MonHoc","Angular");
    Route::get("myView/{tenkhoahoc}","MyController@myViewTen");
    // Route Url request
    Route::get("MyRequest","MyController@GetUrl");

    Route::get("user/{id}/{username}",function($id,$username ){
        return [
            'id'=>$id,
            'user'=>$username
        ];
       
    })->name('userinfo')->where([
        'id'=>'[0-9]+',
        'user'=>'[a-zA-Z]+'
        ]);
    
    Route::get('test-redirect', function () {
        return redirect()->route('userinfo',['id'=>12,
                                            'user'=>'cus']);
    });
    

});