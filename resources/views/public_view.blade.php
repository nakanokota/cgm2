@extends('layouts.app')
@section('content')

 <!-- item: 既に登録されてる作品のリスト -->
    <!-- 現在の作品 -->
    @if (count($items) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>作品一覧</th>
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
                                    <form action="{{ url('public_items_detail/'.$item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            詳細
                                        </button>
                                    </form>
                                </td>

                                <!-- 投稿日 -->
                                <td>
                                    <div>投稿日:{{ $item->created_at }}</div>
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