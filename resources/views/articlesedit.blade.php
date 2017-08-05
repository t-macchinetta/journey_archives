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
                <!--<input type="text" id="length" name="length" class="form-control" value="{{$article->length}}">-->
                <select name="length" id="length" class="form-control">
                    @if($article->length == '1日')
                        <option value="1日" selected>1日</option>
                    @else
                        <option value="1日">1日</option>
                    @endif
                    @if($article->length == '2日')
                        <option value="2日" selected>2日</option>
                    @else
                        <option value="2日">2日</option>
                    @endif
                    @if($article->length == '3日')
                        <option value="3日" selected>3日</option>
                    @else
                        <option value="3日">3日</option>
                    @endif
                    @if($article->length == '4日')
                        <option value="4日" selected>4日</option>
                    @else
                        <option value="4日">4日</option>
                    @endif
                    @if($article->length == '5日')
                        <option value="5日" selected>5日</option>
                    @else
                        <option value="5日">5日</option>
                    @endif
                    @if($article->length == '6日')
                        <option value="6日" selected>6日</option>
                    @else
                        <option value="6日">6日</option>
                    @endif
                    @if($article->length == '7日')
                        <option value="7日" selected>7日</option>
                    @else
                        <option value="7日">7日</option>
                    @endif
                    
                </select>

            </div>
            <div class="form-group">
                <label for="cost">総予算</label>
                <!--<input type="number" id="cost" name="cost" class="form-control" value="{{$article->cost}}">-->
                <select name="cost" id="cost" class="form-control">
                    @if($article->cost == '\1-\10,000')
                        <option value="\1-\10,000" selected>\1-\10,000</option>
                    @else
                        <option value="\1-\10,000">\1-\10,000</option>
                    @endif
                    @if($article->cost == '\10,001-\20,000')
                        <option value="\10,001-\20,000" selected>\10,001-\20,000</option>
                    @else
                        <option value="\10,001-\20,000">\10,001-\20,000</option>
                    @endif
                    @if($article->cost == '\20,001-\30,000')
                        <option value="\20,001-\30,000" selected>\20,001-\30,000</option>
                    @else
                        <option value="\20,001-\20,000">\20,001-\30,000</option>
                    @endif
                    @if($article->cost == '\30,001-\40,000')
                        <option value="\30,001-\40,000" selected>\30,001-\40,000</option>
                    @else
                        <option value="\30,001-\40,000">\30,001-\40,000</option>
                    @endif
                    @if($article->cost == '\40,001-\50,000')
                        <option value="\40,001-\50,000" selected>\40,001-\50,000</option>
                    @else
                        <option value="\40,001-\50,000">\40,001-\50,000</option>
                    @endif
                    @if($article->cost == '\50,001-\60,000')
                        <option value="\50,001-\60,000" selected>\50,001-\60,000</option>
                    @else
                        <option value="\50,001-\60,000">\50,001-\60,000</option>
                    @endif
                    
                </select>
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