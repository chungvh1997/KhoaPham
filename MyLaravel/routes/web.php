<?php

use Illuminate\Support\Facades\View;
use App\Http\Controllers\MyController;


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


Route::prefix("Tesst")->group(function(){  

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