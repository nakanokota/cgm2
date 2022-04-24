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
    $items = Item::orderBy('created_at', 'asc')->get();
    return view('items', [
        'items' => $items
    ]);
});

//作品を追加
Route::post("/items", function(Request $request){
    //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
    // Eloquentモデル（登録処理）
    $items = new Item;
    $items->item_name = $request->item_name;
    $items->published = '2017-03-07 00:00:00';
    $items->save(); 
    return redirect('/');
});

//作品を削除
Route::delete("/item/{item}", function(Item $item){
    //
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');