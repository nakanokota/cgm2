@extends('layouts.app')
@section('content')
<div class="row container">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('items/update') }}" method="POST">

        <!-- item_name -->
        <div class="form-group">
           <label for="item_name">作品名</label>
           <input type="text" name="item_name" class="form-control" value="{{$item->item_name}}">
        </div>
        <!--/ item_name -->
        
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">修正</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                戻る
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
         <!-- id値を送信 -->
         <input type="hidden" name="id" value="{{$item->id}}">
         <!--/ id値を送信 -->
         
         <!-- CSRF -->
         @csrf
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection
