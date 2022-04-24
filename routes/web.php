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
        'item_name' => 'required|max:255|min:3',
        "published" => "required",
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
    $items->published = $request->published;
    $items->save(); 
    return redirect('/');
});

//更新画面
Route::post('/items_edit/{items}', function(Item $items) {
    //{items}id 値を取得 => item $items id 値の1レコード取得
    return view('items_edit', ['item' => $items]);
});

//更新処理
Route::post('/books/update', function(Request $request){
    //バリデーション
    $validator = Validator::make($request->all(), [
        "id" => "required",
        'item_name' => 'required|max:255|min:3',
        "published" => "required",
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
    // Eloquentモデル（登録処理）
    $items = Item::find($request->id);
    $items->item_name = $request->item_name;
    $items->published = $request->published;
    $items->save(); 
    return redirect('/');
});

//作品を削除
Route::delete("/item/{item}", function(Item $item){
    $item->delete();       //追加
    return redirect('/');  //追加
});

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');