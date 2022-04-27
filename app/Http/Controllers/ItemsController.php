<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


//使うClassを宣言:自分で追加
use App\Item;   //Itemモデルを使えるようにする
use App\User;
use App\Comment;
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する


class ItemsController extends Controller
{
    //コンストラクタ （このクラスが呼ばれたら最初に処理をする）
    public function __construct()
    {
        $this->middleware('auth');
    }

    //作品ダッシュボード表示
    public function index(){
        $items = Item::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('items', [
            'items' => $items
        ]);
    }

    //詳細画面
    public function detail($item_id){
        $items = Item::find($item_id);
        $users = User::find($items->user_id);
        return view('items_detail', [
            'item' => $items,
            "user" => $users
        ]);
    }

    //更新画面
    public function edit($item_id){
        $items = Item::where('user_id',Auth::user()->id)->find($item_id);
        return view('items_edit', ['item' => $items]);
    }

    //更新
    public function update(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
        ]); 
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        // データ更新
        $items = Item::where('user_id',Auth::user()->id)->find($request->id);
        $items->item_name   = $request->item_name;
        $items->save();
        return redirect('/');
    }

    //登録
    public function create(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
                'item_name' => 'required|min:3|max:255',
                "item_img" => "required|image|max:3000",
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        // Eloquentモデル（登録処理）
        $items = new Item;
        $items->user_id  = Auth::user()->id; //追加のコード
        $items->item_name = $request->item_name;
        $items->save();

        $file = $request->file('item_img'); //file取得
        $filename = "img_".$items->id.".jpg";   //ファイル名
        $move = $file->move('./upload/',$filename);
        return redirect('/')->with('message', '投稿が完了しました');
    }

    //削除
    public function destroy(Item $item){
        if(file_exists(public_path('./upload/img_'.$item->id.'.jpg'))){
            unlink(public_path('./upload/img_'.$item->id.'.jpg'));
        }
        $item->delete();
        return redirect('/');
    }
}
