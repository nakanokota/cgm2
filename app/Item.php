<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    Public function user()
    {
        //Userモデルのデータを取得する
        return $this->belongsTo('App\User');
    }
}
