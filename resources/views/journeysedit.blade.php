@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('journeys/update') }}" method="POST">
            <input type="hidden" name="u_id" value="{{$journey->u_id}}">
            <!-- 出発地関連 -->
            <div class="form-group">
                <label for="dep_time">出発時間*</label>
                <input type="time" id="dep_time" name="dep_time" class="form-control" value="{{$journey->dep_time}}">
            </div>
            <div class="form-group">
                <label for="departure">出発地*</label>
                <input type="text" id="departure" name="departure" class="form-control" value="{{$journey->departure}}">
            </div>
            <!--/出発地関連-->
            <!-- 経路関連 -->
            <div class="form-group">
                <label for="route">経路*</label>
                <input type="text" id="route" name="route" class="form-control" value="{{$journey->route}}">
            </div>
            <!--/経路関連-->
            <!-- 目的地関連 -->
            <div class="form-group">
                <label for="des_time">到着時間</label>
                <input type="time" id="des_time" name="des_time" class="form-control" value="{{$journey->des_time}}">
            </div>
            <div class="form-group">
                <label for="destination">目的地</label>
                <input type="text" id="destination" name="destination" class="form-control" value="{{$journey->destination}}">
            </div>
            <!--コメント-->
            <div class="form-group">
                <label for="comment">コメント</label>
                <input type="text" id="comment" name="comment" class="form-control" value="{{$journey->comment}}">
            </div>
            <!-- Saveボタン/Backボタン -->
            <div class="well well-sm">
                <a class="btn btn-link pull-right" href="{{ url('/') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$journey->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection