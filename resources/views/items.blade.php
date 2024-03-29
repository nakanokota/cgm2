<!-- resources/views/items.blade.php -->
@extends('layouts.app')
@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            作品の投稿
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
                    <label for="published" class="col-sm-3 control-label">作品のタイトル</label>
                    <input type="text" name="item_name" class="form-control">
                </div>
            </div>

            <!-- file追加 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="published" class="col-sm-3 control-label">作品</label><br>
                    <input type="file" accept=".png, .jpg" name="item_img">
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
            
        <!-- 成功メッセージ -->
        @include('common.success')
        <!-- 成功メッセージ -->

    </div>

    <!-- item: 既に登録されてる作品のリスト -->
    <!-- 現在の作品 -->
    @if (count($items) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>あなたの作品一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <!-- 作品タイトル -->
                                <td class="table-text">
                                    <div>{{ $item->item_name }}</div>
                                    <div> <img src="upload/img_{{$item->id}}.jpg" width="100"></div>
                                </td>

                                <!-- 詳細ボタン -->
                                <td>
                                    <form action="{{ url('items_detail/'.$item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            詳細
                                        </button>
                                    </form>
                                </td>

                                <!-- 本: 編集ボタン -->
                                <td>
                                    <form action="{{ url('items_edit/'.$item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            編集
                                        </button>
                                    </form>
                                </td>

                                <!-- 作品: 削除ボタン -->
                                <td>
                                    <form action="{{ url('item/'.$item->id) }}" method="POST">
                                        @csrf               <!-- CSRFからの保護 -->
                                        @method('DELETE')   <!-- 擬似フォームメソッド -->
                                        
                                        <button type="submit" class="btn btn-danger">
                                            削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                {{ $items->links()}}
            </div>
       </div>
    @endif
@endsection