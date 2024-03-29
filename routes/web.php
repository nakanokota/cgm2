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

//ItemsController
//作品ダッシュボード表示
Route::get('/', "ItemsController@index");

//作品を追加
Route::post("/items", "ItemsController@create");

//詳細画面
Route::post('items_detail/{items}', "ItemsController@detail");

//更新画面
Route::post('/items_edit/{items}', "ItemsController@edit");

//更新処理
Route::post('/items/update', "ItemsController@update");

//作品を削除
Route::delete("/item/{item}", "ItemsController@destroy");

//Auth
Auth::routes();
Route::get('/home', 'ItemsController@index')->name('home');


//PublicController
//全作品ダッシュボード表示
Route::get("/public", "PublicController@index");

//詳細画面
Route::match(['get', 'post'],'public_items_detail/{items}', "PublicController@detail");


//CommentsController
//コメントを追加
Route::match(['get', 'post'], "comments/{items}", "CommentsController@create");


//error
//Route::get("/error", "PublicController@error");