<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


//使うClassを宣言:自分で追加
use App\Item;   //Itemモデルを使えるようにする
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する


class ItemsController extends Controller
{
    //作品ダッシュボード表示
    public function index(){
        $items = Item::orderBy('created_at', 'asc')->get();
        return view('items', [
            'items' => $items
        ]);
    }

    //更新画面
    public function edit(Item $items){
        return view('items_edit', ['item' => $items]);
    }

    //更新
    public function update(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'published' => 'required',
        ]); 
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        // データ更新
        $items = Item::find($request->id);
        $items->item_name   = $request->item_name;
        $items->published   = $request->published;
        $items->save();
        return redirect('/');
    }

    //登録
    public function create(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
                'item_name' => 'required|min:3|max:255',
                'published' => 'required',
        ]);
        //バリデーション:エラー 
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
    }

    //削除
    public function destroy(Item $item){
        $item->delete();
        return redirect('/');
    }
}
