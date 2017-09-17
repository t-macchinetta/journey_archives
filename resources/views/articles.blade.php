<!--layouts/app.blade.phpと同じ意味-->
@extends('layouts.app')
<!--section内の内容をcontentで規定する，後で呼び出せる-->
@section('content')

    <!-- Bootstrap の定形コード... -->

        <!--バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!--バリデーションエラーの表示に使用-->
        
        <!--記録一覧-->
        @if (count($articles) > 0)

            <div class = "flex-row">
                <div class = "main">
                    <div class = "exp">
                        <div>旅行一覧</div>
                    </div>
                    @foreach ($articles as $article)
                        <div class = "article">
                            <!--<div class="">-->
                                <div class = "overview">
                                    <div class = "flex">
                                        <form action="{{ url('detail') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="u_id" value="{{ $article->u_id }}" />
                                            <input type="hidden" name="email" value="{{ $article->email }}" />
                                            <button id="view" type="submit" class="btn btn-primary show_detail" hidden>
                                                <!--表示-->
                                                <h4>{{ $article->title }}</h4>
                                            </button>
                                        </form>
                                        @if($article->email == \Auth::user()->email)
                                        <form action="{{ url('articlesedit/'.$article->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn j_btn">
                                                <!--更新-->
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                    <!--<label for="view"><h4>{{ $article->title }}</h4></label>-->
                                    <p>出発日 ： {{ $article->dep_date }} ({{ $article->length }})</p>
                                    <p>総予算 ： {{ $article->cost }}</p>
                                    <p>主な交通 ： {{ $article->traffic }}</p>
                                </div>
                                <div class = "flex">
                                    <div class = "buttons">
                                        <!--記録者のみ編集と削除のボタン表示-->
                                    @if($article->email == \Auth::user()->email)
                                        <div class = "">
                                            <form action="{{ url('article/'.$article->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <!--bootstrapのcomponentsの値をクラスに追加する-->
                                                <button type="submit" class="btn j_btn delete">
                                                <!--削除-->
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            <!--</div>-->
                        </div>
                    @endforeach
                    <div class = "foot"></div>
                </div>
            </div>
        @else
        <div class = "flex-row">
            <div class = "main">
                <div class = "exp">
                    <div>まだ記録がありません．</div>
                </div>
            </div>
        </div>
        @endif
        <!--新規追加用ボタン-->
        <a id = "add_article", class="fab" href="#">
          <i class="material-icons md-24">add</i>
          <!--<i class="glyphicon glyphicon-plus"></i>-->
        </a>


    <!--モーダル-->
    <div class="modal fade" id="modal_add_article">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modal-label">新しい旅行を登録</h4>
                </div>

                <div class="box_inner">

                    <!-- 登録用フォーム -->
                    <!--urlをつけると自動的にドメインを追加してくれる-->
                    <form action="{{ url('articles') }}" method="POST" class="search_form">
                        <!--↓phpのsession的なチェックをする，セキュリティ的に使用すると良い-->
                        {{ csrf_field() }}
                        <!--{{ Auth::user()->name }}-->
                    <!-- タイトル -->
                        <div class="form-group">
                            <label for="title">タイトル*</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dep_date">出発日*</label>
                            <input type="date" name="dep_date" id="dep_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="length">長さ</label>
                            <select name="length" id="length" class="form-control">
                                <option value=""></option>
                                <option value="1日">1日</option>
                                <option value="2日">2日</option>
                                <option value="3日">3日</option>
                                <option value="4日">4日</option>
                                <option value="5日">5日</option>
                                <option value="6日">6日</option>
                                <option value="7日">7日</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cost">総予算</label>
                            <select name="cost" id="cost" class="form-control">
                                <option value="¥0 - ¥10,000">¥0 - ¥10,000</option>
                                <option value="¥10,001 - ¥50,000">¥10,001 - ¥50,000</option>
                                <option value="¥50,001 - ¥100,000">¥50,001 - ¥100,000</option>
                                <option value="¥100,001 - ¥200,000">¥100,001 - ¥200,000</option>
                                <option value="¥200,001 - ¥300,000">¥200,001 - ¥300,000</option>
                                <option value="¥300,001 - ¥400,000">¥300,001 - ¥400,000</option>
                                <option value="¥400,001 - ¥500,000">¥400,001 - ¥500,000</option>
                                <option value="¥500,001 - ¥1,000,000">¥500,001 - ¥1,000,000</option>
                                <option value="¥1,000,001以上">¥1,000,001以上</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="control-label"><b>主な交通</b></p>
                            <div class="radio-wrap">
                                <div class="checkbox">
                                    <label for="train">
                                        <input type="checkbox" name="traffic[]" id="train" value="鉄道">鉄道
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="bus">
                                        <input type="checkbox" name="traffic[]" id="bus" value="バス">バス
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="plain">
                                        <input type="checkbox" name="traffic[]" id="plain" value="飛行機">飛行機
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="ship">
                                        <input type="checkbox" name="traffic[]" id="ship" value="船舶">船舶
                                    </label>
                                </div>
                            </div>
                            <div class="radio-wrap">
                                <div class="checkbox">
                                    <label for="car">
                                        <input type="checkbox" name="traffic[]" id="car" value="自動車">自動車
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="bicycle">
                                        <input type="checkbox" name="traffic[]" id="bicycle" value="自転車">自転車
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label for="foot">
                                        <input type="checkbox" name="traffic[]" id="foot" value="徒歩">徒歩
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus glyphicon glyphicon-plus"></i> add
                            </button>
                        </div>





                        <!--<div class="form-group">-->
                        <!--    <label for="title" class="col-sm-4 control-label">タイトル*</label>-->
                        <!--    <div class="col-sm-6">-->
                        <!--        <input type="text" name="title" id="title" class="form-control">-->
                        <!--    </div>-->
                        <!--    <label for="dep_date" class="col-sm-4 control-label">出発日*</label>-->
                        <!--    <div class="col-sm-6">-->
                        <!--        <input type="date" name="dep_date" id="dep_date" class="form-control">-->
                        <!--    </div>-->
                        <!--    <label for="length" class="col-sm-4 control-label">長さ*</label>-->
                        <!--    <div class="col-sm-6">-->
                                <!--<input type="text" name="length" id="length" class="form-control">-->
                        <!--    <select name="length" id="length" class="form-control">-->
                        <!--            <option value="1日">1日</option>-->
                        <!--            <option value="2日">2日</option>-->
                        <!--            <option value="3日">3日</option>-->
                        <!--            <option value="4日">4日</option>-->
                        <!--            <option value="5日">5日</option>-->
                        <!--            <option value="6日">6日</option>-->
                        <!--            <option value="7日">7日</option>-->
                        <!--    </select>-->
                        <!--    </div>-->
                        <!--    <label for="cost" class="col-sm-4 control-label">総予算*</label>-->
                        <!--    <div class="col-sm-6">-->
                                <!--<input type="number" name="cost" id="cost" class="form-control">-->
                        <!--        <select name="cost" id="cost" class="form-control">-->
                        <!--            <option value="¥0 - ¥10,000">¥0 - ¥10,000</option>-->
                        <!--            <option value="¥10,001 - ¥50,000">¥10,001 - ¥50,000</option>-->
                        <!--            <option value="¥50,001 - ¥100,000">¥50,001 - ¥100,000</option>-->
                        <!--            <option value="¥100,001 - ¥200,000">¥100,001 - ¥200,000</option>-->
                        <!--            <option value="¥200,001 - ¥300,000">¥200,001 - ¥300,000</option>-->
                        <!--            <option value="¥300,001 - ¥400,000">¥300,001 - ¥400,000</option>-->
                        <!--            <option value="¥400,001 - ¥500,000">¥400,001 - ¥500,000</option>-->
                        <!--            <option value="¥500,001 - ¥1,000,000">¥500,001 - ¥1,000,000</option>-->
                        <!--            <option value="¥1,000,001以上">¥1,000,001以上</option>-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--    <label for="traffic" class="col-sm-4 control-label">主な交通*</label>-->
                        <!--    <div class="col-sm-6">-->
                                <!--↓項目を追加する，時間とか価格とか-->
                                <!--<input type="text" name="traffic" id="traffic" class="form-control">-->
                        <!--        <label for="train" class="control-label">鉄道</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="train" class="form-control" value="鉄道">-->
                        <!--        <label for="bus" class="control-label">バス</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="bus" class="form-control" value="バス">-->
                        <!--        <label for="plain" class="control-label">飛行機</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="plain" class="form-control" value="飛行機">-->
                        <!--        <label for="ship" class="control-label">船舶</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="ship" class="form-control" value="船舶">-->
                        <!--        <label for="car" class="control-label">自動車</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="car" class="form-control" value="自動車">-->
                        <!--        <label for="bicycle" class="control-label">自転車</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="bicycle" class="form-control" value="自転車">-->
                        <!--        <label for="foot" class="control-label">徒歩</label>-->
                        <!--        <input type="checkbox" name="traffic[]" id="foot" class="form-control" value="徒歩">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!-- 本登録ボタン -->
                        <!--<div class="form-group">-->
                        <!--    <div class="col-sm-offset-3 col-sm-6">-->
                        <!--        <button type="submit" class="btn btn-default">-->
                        <!--            <i class="fa fa-plus glyphicon glyphicon-plus"></i> Save-->
                        <!--        </button>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection
