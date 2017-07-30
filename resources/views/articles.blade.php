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
                                <td class="table-text">
                                    <div>{{ $article->u_id }}</div>
                                </td>
                                <!--詳細ボタン-->
                                <td>
                                    <!--.$article->u_id)-->
                                    <form action="{{ url('detail') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="u_id" value="{{ $article->u_id }}" />
                                        <button type="submit" class="btn btn-primary">
                                            <!--更新-->
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
                                        <button type="submit" class="btn btn-danger">
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
            {{ Auth::user()->name }}
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
                    <input type="text" name="length" id="length" class="form-control">
                </div>
                <label for="cost" class="col-sm-4 control-label">総予算*</label>
                <div class="col-sm-6">
                    <input type="number" name="cost" id="cost" class="form-control">
                </div>
                <label for="traffic" class="col-sm-4 control-label">主な交通*</label>
                <div class="col-sm-6">
                    <!--↓項目を追加する，時間とか価格とか-->
                    <input type="text" name="traffic" id="traffic" class="form-control">
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
