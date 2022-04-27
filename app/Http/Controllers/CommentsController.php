<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//使うClassを宣言:自分で追加
use App\Item;   //Itemモデルを使えるようにする
use App\User;
use App\Comment;
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する

class CommentsController extends Controller
{
    //
}
