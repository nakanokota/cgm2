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

                <!-- 作品登録フォーム -->
                <form enctype="multipart/form-data" action="{{ url('items') }}"method="POST" class="form-horizontal">
                    @csrf

                    <!-- 作品のタイトル -->
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label for="published" class="col-sm-3 control-label">コメント</label>
                            <textarea type="text" name="content" class="form-control" rows="3" style="resize: none"></textarea>
                        </div>
                    </div>

                    <!-- 作品 登録ボタン -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">
                                投稿
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

        @endguest
        <!-- コメント欄ボードビュー -->
        @if (count($comments) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>コメント一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <!-- 投稿者、コメント内容 -->
                                <td class="table-text">
                                    <div>{{ $comment->getData() }}さん</div>
                                    <div> {{ $comment->content }}</div>
                                </td>

                                <!-- 投稿日時 -->
                                <td class="table-text"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    @endif
    </div>
@endsection