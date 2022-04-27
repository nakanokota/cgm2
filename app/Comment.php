<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    Public function user()
    {
        //Userモデルのデータを取得する
        return $this->belongsTo('App\User');
    }

    public function getData()
    {
        return $this->user->name;
    }
}
