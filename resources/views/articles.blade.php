<!--layouts/app.blade.phpと同じ意味-->
@extends('layouts.app')
<!--section内の内容をcontentで規定する，後で呼び出せる-->
@section('content')

    <!-- Bootstrap の定形コード... -->

    <div class="panel-body">
        <!--バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!--バリデーションエラーの表示に使用-->
        
        <!--記録一覧-->
        @if (count($articles) > 0)
            <div class="panel panel-default">
                <div class="panel-heading"> 
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                    <!--テーブルヘッダ-->
                        <thead>
                            <th>旅行一覧</th>
                            <th>&nbsp;</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                         @foreach ($articles as $article)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $article->title }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $article->dep_date }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $article->length }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $article->cost }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $article->traffic }}</div>
                                </td>
                                <!--<td class="table-text">-->
                                <!--    <div>{{ $article->u_id }}</div>-->
                                <!--</td>-->
                                <!--詳細ボタン-->
                                <td>
                                    <!--.$article->u_id)-->
                                    <form action="{{ url('detail') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="u_id" value="{{ $article->u_id }}" />
                                        <input type="hidden" name="email" value="{{ $article->email }}" />
                                        <button type="submit" class="btn btn-primary show_detail">
                                            <!--表示-->
                                            <i class="glyphicon glyphicon-play"></i>
                                        </button>
                                    </form>
                                </td>
                                <!--本更新ボタン-->
                                <td>
                                    <form action="{{ url('articlesedit/'.$article->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            <!--更新-->
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                    </form>
                                </td>
                                <!-- 本: 削除ボタン -->
                                <td>
                                    <form action="{{ url('article/'.$article->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <!--bootstrapのcomponentsの値をクラスに追加する-->
                                        <button type="submit" class="btn btn-danger delete">
                                            <!--削除-->
                                            <i class="fa fa-trash glyphicon glyphicon-trash"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    <!--  ook: 既に登録されてる本 リスト -->

        <!-- 本登録フォーム -->
        <!--urlをつけると自動的にドメインを追加してくれる-->
        <form action="{{ url('articles') }}" method="POST" class="form-horizontal">
            <!--↓phpのsession的なチェックをする，セキュリティ的に使用すると良い-->
            {{ csrf_field() }}
            <!--{{ Auth::user()->name }}-->
        <!-- 本のタイトル -->
            <div class="form-group">
                <label for="title" class="col-sm-4 control-label">タイトル*</label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <label for="dep_date" class="col-sm-4 control-label">出発日*</label>
                <div class="col-sm-6">
                    <input type="date" name="dep_date" id="dep_date" class="form-control">
                </div>
                <label for="length" class="col-sm-4 control-label">長さ*</label>
                <div class="col-sm-6">
                    <!--<input type="text" name="length" id="length" class="form-control">-->
                <select name="length" id="length" class="form-control">
                        <option value="1日">1日</option>
                        <option value="2日">2日</option>
                        <option value="3日">3日</option>
                        <option value="4日">4日</option>
                        <option value="5日">5日</option>
                        <option value="6日">6日</option>
                        <option value="7日">7日</option>
                </select>
                </div>
                <label for="cost" class="col-sm-4 control-label">総予算*</label>
                <div class="col-sm-6">
                    <!--<input type="number" name="cost" id="cost" class="form-control">-->
                    <select name="cost" id="cost" class="form-control">
                        <option value="\1-\10,000">\1-\10,000</option>
                        <option value="\10,001-\20,000">\10,001-\20,000</option>
                        <option value="\20,001-\30,000">\20,001-\30,000</option>
                        <option value="\30,001-\40,000">\30,001-\40,000</option>
                        <option value="\40,001-\50,000">\40,001-\50,000</option>
                        <option value="\50,001-\60,000">\50,001-\60,000</option>
                    </select>
                </div>
                <label for="traffic" class="col-sm-4 control-label">主な交通*</label>
                <div class="col-sm-6">
                    <!--↓項目を追加する，時間とか価格とか-->
                    <!--<input type="text" name="traffic" id="traffic" class="form-control">-->
                    <label for="train" class="control-label">鉄道</label>
                    <input type="checkbox" name="traffic[]" id="train" class="form-control" value="鉄道">
                    <label for="bus" class="control-label">バス</label>
                    <input type="checkbox" name="traffic[]" id="bus" class="form-control" value="バス">
                    <label for="plain" class="control-label">飛行機</label>
                    <input type="checkbox" name="traffic[]" id="plain" class="form-control" value="飛行機">
                    <label for="ship" class="control-label">船舶</label>
                    <input type="checkbox" name="traffic[]" id="ship" class="form-control" value="船舶">
                    <label for="car" class="control-label">自動車</label>
                    <input type="checkbox" name="traffic[]" id="car" class="form-control" value="自動車">
                    <label for="bicycle" class="control-label">自転車</label>
                    <input type="checkbox" name="traffic[]" id="bicycle" class="form-control" value="自転車">
                    <label for="foot" class="control-label">徒歩</label>
                    <input type="checkbox" name="traffic[]" id="foot" class="form-control" value="徒歩">
                </div>
            </div>
            
            <!-- 本登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus glyphicon glyphicon-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>
        


    </div>
@endsection
