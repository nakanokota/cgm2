<?php

use App\Item;
use Illuminate\Http\Request;

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
    return view('items');
});

//作品を追加
Route::post("/items", function(Request $request){
    //
});

//作品を削除
Route::delete("/item/{item}", function(Item $item){
    //
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');