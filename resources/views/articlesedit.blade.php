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
                    <!--入力されている値によって初期値を選択する-->
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
                <!--↓コストの値によって初期選択する項目を分岐させる-->
                <select name="cost" id="cost" class="form-control">
                    @if($article->cost == '¥0 - ¥10,000')
                        <option value="¥0 - ¥10,000" selected>¥0 - ¥10,000</option>
                    @else
                        <option value="¥0 - ¥10,000">¥0 - ¥10,000</option>
                    @endif
                    @if($article->cost == '¥10,001 - ¥50,000')
                        <option value="¥10,001 - ¥50,000" selected>¥10,001 - ¥50,000</option>
                    @else
                        <option value="¥10,001 - ¥50,000">¥10,001 - ¥50,000</option>
                    @endif
                    @if($article->cost == '¥50,001 - ¥100,000')
                        <option value="¥50,001 - ¥100,000" selected>¥50,001 - ¥100,000</option>
                    @else
                        <option value="¥50,001 - ¥100,000">¥50,001 - ¥100,000</option>
                    @endif
                    @if($article->cost == '¥100,001 - ¥200,000')
                        <option value="¥100,001 - ¥200,000" selected>¥100,001 - ¥200,000</option>
                    @else
                        <option value="¥100,001 - ¥200,000">¥100,001 - ¥200,000</option>
                    @endif
                    @if($article->cost == '¥200,001 - ¥300,000')
                        <option value="¥200,001 - ¥300,000" selected>¥200,001 - ¥300,000</option>
                    @else
                        <option value="¥200,001 - ¥300,000">¥200,001 - ¥300,000</option>
                    @endif
                    @if($article->cost == '¥300,001 - ¥400,000')
                        <option value="¥300,001 - ¥400,000" selected>¥300,001 - ¥400,000</option>
                    @else
                        <option value="¥300,001 - ¥400,000">¥300,001 - ¥400,000</option>
                    @endif
                    @if($article->cost == '¥400,001 - ¥500,000')
                        <option value="¥400,001 - ¥500,000" selected>¥400,001 - ¥500,000</option>
                    @else
                        <option value="¥400,001 - ¥500,000">¥400,001 - ¥500,000</option>
                    @endif
                    @if($article->cost == '¥500,001 - ¥1,000,000')
                        <option value="¥500,001 - ¥1,000,000" selected>¥500,001 - ¥1,000,000</option>
                    @else
                        <option value="¥500,001 - ¥1,000,000">¥500,001 - ¥1,000,000</option>
                    @endif
                    @if($article->cost == '¥1,000,001以上')
                        <option value="¥1,000,001以上" selected>¥1,000,001以上</option>
                    @else
                        <option value="¥1,000,001以上">¥1,000,001以上</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="traffic">主な交通</label>
                <!--<input type="text" id="traffic" name="traffic" class="form-control" value="{{$article->traffic}}">-->
                <!--↓各交通が含まれている場合にチェックボックスを初期選択状態にする-->
                <label for="train" class="control-label">鉄道</label>
                    @if(strpos($article->traffic,'鉄道') !== false)
                        <input type="checkbox" name="traffic[]" id="train" class="form-control" value="鉄道" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="train" class="form-control" value="鉄道">
                    @endif
                <label for="bus" class="control-label">バス</label>
                    @if(strpos($article->traffic,'バス') !== false)
                        <input type="checkbox" name="traffic[]" id="bus" class="form-control" value="バス" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="bus" class="form-control" value="バス">
                    @endif
                <label for="plain" class="control-label">飛行機</label>
                    @if(strpos($article->traffic,'飛行機') !== false)
                        <input type="checkbox" name="traffic[]" id="plain" class="form-control" value="飛行機" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="plain" class="form-control" value="飛行機">
                    @endif
                <label for="ship" class="control-label">船舶</label>
                    @if(strpos($article->traffic,'船舶') !== false)
                        <input type="checkbox" name="traffic[]" id="ship" class="form-control" value="船舶" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="ship" class="form-control" value="船舶">
                    @endif
                <label for="car" class="control-label">自動車</label>
                    @if(strpos($article->traffic,'自動車') !== false)
                        <input type="checkbox" name="traffic[]" id="car" class="form-control" value="自動車" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="car" class="form-control" value="自動車">
                    @endif
                <label for="bicycle" class="control-label">自転車</label>
                    @if(strpos($article->traffic,'自転車') !== false)
                        <input type="checkbox" name="traffic[]" id="bicycle" class="form-control" value="自転車" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="bicycle" class="form-control" value="自転車">
                    @endif
                <label for="foot" class="control-label">徒歩</label>
                    @if(strpos($article->traffic,'徒歩') !== false)
                        <input type="checkbox" name="traffic[]" id="foot" class="form-control" value="徒歩" checked="checked">
                    @else
                        <input type="checkbox" name="traffic[]" id="foot" class="form-control" value="徒歩">
                    @endif

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