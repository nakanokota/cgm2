<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//使うClassを宣言:自分で追加
use App\Item;   //Itemモデルを使えるようにする
use App\User;
use App\Comment;
use Session;
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する

class CommentsController extends Controller
{
    //コンストラクタ （このクラスが呼ばれたら最初に処理をする）
    public function __construct()
    {
        $this->middleware('auth');
    }

    //登録
    public function create(Request $request, $item_id) {
        //バリデーション
        $validator = Validator::make($request->all(), [
                'content' => 'required|max:200',
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        // Eloquentモデル（登録処理）
        $comments = new Comment;
        $comments->item_id = $item_id;
        $comments->user_id  = Auth::user()->id; //追加のコード
        $comments->content = $request->content;
        $comments->save();

        $items = Item::find($item_id);
        $users = User::find($items->user_id);
        $comments = Comment::where("item_id", $items->id)->orderBy('created_at', 'desc')->paginate(20);
        Session::put('message', '投稿が完了しました');
        return view('items_detail', [
            'item' => $items,
            "user" => $users,
            "comments" => $comments,
        ]);
    }
}
