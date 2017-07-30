@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('articles/update') }}" method="POST">
            <div class="form-group">
                <label for="title">タイトル*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{$article->title}}">
            </div>
            <div class="form-group">
                <label for="dep_date">出発日*</label>
                <input type="date" id="dep_date" name="dep_date" class="form-control" value="{{$article->dep_date}}">
            </div>
            <div class="form-group">
                <label for="length">長さ*</label>
                <input type="text" id="length" name="length" class="form-control" value="{{$article->length}}">
            </div>
            <div class="form-group">
                <label for="cost">総予算</label>
                <input type="number" id="cost" name="cost" class="form-control" value="{{$article->cost}}">
            </div>
            <div class="form-group">
                <label for="traffic">主な交通</label>
                <input type="text" id="traffic" name="traffic" class="form-control" value="{{$article->traffic}}">
            </div>
            <!-- Saveボタン/Backボタン -->
            <div class="well well-sm">
                <a class="btn btn-link pull-right" href="{{ url('/') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$article->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection