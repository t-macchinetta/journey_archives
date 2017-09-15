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
                        <div>検索結果一覧</div>
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
                                    
                                    <p>旅行者 ： {{ $article->name }} さん</p>
                                    <p>出発日 ： {{ $article->dep_date }} ({{ $article->length }})</p>
                                    <p>総予算 ： {{ $article->cost }}</p>
                                    <p>主な交通 ： {{ $article->traffic }}</p>
                                </div>
                                <div class = "flex">
                                    <!--<div class = "buttons">-->
                                    <!--    <form action="{{ url('detail') }}" method="POST">-->
                                    <!--        {{ csrf_field() }}-->
                                    <!--        <input type="hidden" name="u_id" value="{{ $article->u_id }}" />-->
                                    <!--        <input type="hidden" name="email" value="{{ $article->email }}" />-->
                                    <!--        <button id="view" type="submit" class="btn btn-primary show_detail">-->
                                                <!--表示-->
                                    <!--            <i class="glyphicon glyphicon-play"></i>-->
                                    <!--        </button>-->
                                    <!--    </form>-->
                                    <!--</div>-->
                                    <div class = "buttons">
                                        <!--記録者のみ編集と削除のボタン表示-->
                                    @if($article->email == \Auth::user()->email)
                                        <!--<div class = "edit"> -->
                                            <!--<form action="{{ url('articlesedit/'.$article->id) }}" method="POST">-->
                                            <!--    {{ csrf_field() }}-->
                                            <!--    <button type="submit" class="btn j_btn">-->
                                                    <!--更新-->
                                            <!--        <i class="material-icons">edit</i>-->
                                            <!--    </button>-->
                                            <!--</form>-->
                                        <!--</div>-->
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
                    <div>該当する結果がありません．</div>
                    <div>再度条件を設定して検索してください．</div>
                </div>
            </div>
        </div>
        @endif
@endsection
