@extends('layouts.app')
@section('content')

<div class = "flex-row">
    <div class = "edit">
    @include('common.errors')
        <form action="{{ url('articles/update') }}" method="POST" class="search_form">
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
                <p class="control-label"><b>主な交通</b></p>
                <!--<input type="text" id="traffic" name="traffic" class="form-control" value="{{$article->traffic}}">-->
                <!--↓各交通が含まれている場合にチェックボックスを初期選択状態にする-->
                <div class="radio-wrap">
                    <div class="checkbox">
                        <label for="train">
                        @if(strpos($article->traffic,'鉄道') !== false)
                            <input type="checkbox" name="traffic[]" id="train" value="鉄道" checked="checked">鉄道
                        @else
                            <input type="checkbox" name="traffic[]" id="train" value="鉄道">鉄道
                        @endif
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="bus">
                        @if(strpos($article->traffic,'バス') !== false)
                            <input type="checkbox" name="traffic[]" id="bus" value="バス" checked="checked">バス
                        @else
                            <input type="checkbox" name="traffic[]" id="bus" value="バス">バス
                        @endif
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="plain">
                        @if(strpos($article->traffic,'飛行機') !== false)
                            <input type="checkbox" name="traffic[]" id="plain" value="飛行機" checked="checked">飛行機
                        @else
                            <input type="checkbox" name="traffic[]" id="plain" value="飛行機">飛行機
                        @endif
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="ship">
                        @if(strpos($article->traffic,'船舶') !== false)
                            <input type="checkbox" name="traffic[]" id="ship" value="船舶" checked="checked">船舶
                        @else
                            <input type="checkbox" name="traffic[]" id="ship" value="船舶">船舶
                        @endif
                        </label>
                    </div>
                </div>
                <div class="radio-wrap">
                    <div class="checkbox">
                        <label for="car">
                        @if(strpos($article->traffic,'自動車') !== false)
                            <input type="checkbox" name="traffic[]" id="car" value="自動車" checked="checked">自動車
                        @else
                            <input type="checkbox" name="traffic[]" id="car" value="自動車">自動車
                        @endif
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="bicycle">
                        @if(strpos($article->traffic,'自転車') !== false)
                            <input type="checkbox" name="traffic[]" id="bicycle" value="自転車" checked="checked">自転車
                        @else
                            <input type="checkbox" name="traffic[]" id="bicycle" value="自転車">自転車
                        @endif
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="bicycle">
                        @if(strpos($article->traffic,'徒歩') !== false)
                            <input type="checkbox" name="traffic[]" id="foot" value="徒歩" checked="checked">徒歩
                        @else
                            <input type="checkbox" name="traffic[]" id="foot" value="徒歩">徒歩
                        @endif
                        </label>
                    </div>
                </div>
            </div>
            <!-- Saveボタン/Backボタン -->
            <div class="well well-sm flex wide">
                <a class="btn btn-link" href="{{ url('/') }}">
                    <i class="glyphicon glyphicon-backward"></i>  Back
                </a>
                <button type="submit" class="btn btn-primary right">Save</button>
            </div>
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$article->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection