<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//使うClassを宣言:自分で追加
use App\Item;   //Itemモデルを使えるようにする
use App\User;
use App\Comment;
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する

class PublicController extends Controller
{
    //全作品ダッシュボード表示
    public function index(){
        $items = Item::orderBy('created_at', 'desc')->paginate(10);
        return view('public_view', [
            'items' => $items
        ]);
    }

    //詳細画面
    public function detail($item_id){
        $items = Item::find($item_id);
        $users = User::find($items->user_id);
        $comments = Comment::where("item_id", $items->id)->orderBy('created_at', 'desc')->paginate(20);
        return view('items_detail', [
            'item' => $items,
            "user" => $users,
            "comments" => $comments,
        ]);
    }

    //error
    public function error(){
        return redirect("/error");
    }
}
