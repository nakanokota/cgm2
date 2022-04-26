@extends('layouts.app')
@section('content')
    <div class="card-body">
        <div class="card-body">
            <!-- 作品詳細 -->
            <div class="form-group">
                <div> <img src="../upload/img_{{$item->id}}.jpg" width="500"></div><!-- 画像 -->
            </div>
            <div class="form-group">
                <table class="table table-striped task-table">
                <td class="table-text">作品名:{{$item->item_name}}</td> <!-- 作品名 -->
                    <td class="table-text">投稿者:{{$user->name}}</td> <!-- 投稿者 -->
                    <td class="table-text">投稿日:{{$item->created_at}}</td> <!-- 投稿日 -->
                </table>
            </div>
        </div>
    </div>
@endsection