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

        @guest
            <!-- コメント投稿スペース非表示 -->
            <div class="card-body">
                コメントを投稿するにはログインしてください
            </div>
        @else
            <!-- コメント投稿スペース表示 -->  <!-- 処理未設定 -->
            <!-- Bootstrapの定形コード… -->
            <div class="card-body">
                <div class="card-title">
                    コメントの投稿
                </div>
                
                <!-- バリデーションエラーの表示に使用-->
                @include('common.errors')
                <!-- バリデーションエラーの表示に使用-->

                <!-- コメント投稿フォーム -->
                <form action="{{ url('comments/'.$item->id) }}"method="POST" class="form-horizontal">
                    @csrf

                    <!-- 作品のタイトル -->
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="published" class="col-sm-3 control-label">コメント</label>
                            <textarea type="text" name="content" class="form-control" rows="3" style="resize: none"></textarea>
                        </div>
                    </div>

                    <!-- コメント投稿ボタン -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                投稿
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- 成功メッセージ -->
            @include('common.success')
            <!-- 成功メッセージ -->

        @endguest
        <!-- コメント欄ボードビュー -->
        @if (count($comments) > 0)
            <div class="card-body">
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- テーブルヘッダ -->
                        <thead>
                            <th>コメント一覧</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td class="table-text" style="width: 100%">
                                        <div style=" display: flex">
                                            <!-- 投稿者 -->
                                            <div style="width: 50%">{{ $comment->getData() }}さん</div>
                                            <!-- 投稿日時 -->
                                            <div style="width: 50%">{{ $comment->created_at }}</div>
                                        </div>
                                        <!-- 投稿内容 -->
                                        <div> {{ $comment->content }}</div>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    {{ $comments->links()}}
                </div>
            </div>
        @endif
    </div>
@endsection