<!--layouts/app.blade.phpと同じ意味-->
@extends('layouts.app')
<!--section内の内容をcontentで規定する，後で呼び出せる-->
@section('content')

    <!-- Bootstrap の定形コード... -->

    <!--<div class="panel-body">-->
        <!--バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!--バリデーションエラーの表示に使用-->

        <!--記録一覧-->
        @if (count($journeys) > 0)
            <!--処理に必要なデータ(非表示)-->
            <div id="std_id" hidden>{{$num}}</div>
                <form action="{{ url('sort') }}" method="POST" id="sort">
                    {{ csrf_field() }}
                    <input type="hidden" id="now_num" name="now_num"/>
                    <input type="hidden" id="new_num" name="new_num"/>
                        <!--<input type="hidden" id="email" name="email" value="{{ Session::get('email') }}"/>-->
                </form>
                <div class = "flex-row">
                    <div class = "main">
                        <div>
                            <div>レコード一覧</div>
                        </div>
                        <!-- リスト本体，レコードがあるときのみ表示 -->
                        @if($email == \Auth::user()->email)
                        <div id = "sortable" class = "list">
                        @else
                        <div>
                        @endif
                         @foreach ($journeys as $journey)
                                <div class="record">
                                    <div class = "j_id" hidden>{{ $journey->numbers }}</div>
                                    <!--ログインしたユーザーが記録したもののみソート可能にする-->
                                    @if($email == \Auth::user()->email)
                                    <span class = "flex">
                                    @endif
                                    @if($email == \Auth::user()->email)
                                    </span>
                                    @endif
                                    <div class = "detail">
                                        <div class = "time">
                                        @if($email == \Auth::user()->email)
                                        <span class = "flex">
                                        @endif
                                            <div class = "dep_t">{{ $journey->dep_time }}</div>
                                        @if($email == \Auth::user()->email)
                                        </span>
                                        @endif
                                            <div class = "dep_p">{{ $journey->departure }}</div>
                                        </div>
                                        <div class = "flex">
                                        @if($email == \Auth::user()->email)
                                        <span class = "flex">
                                        @endif
                                        <div class = "blank"></div>
                                        @if($email == \Auth::user()->email)
                                        </span>
                                        @endif
                                        <div class = "info">
                                            <div class = "info2">
                                                <div class = "route">
                                                    {{ $journey->route }}
                                                    <i class = "glyphicon glyphicon-comment show_commnet"></i>
                                                </div>
                                                <div class = "buttons">
                                                    <!--記録者のみ編集と削除のボタン表示-->
                                                    @if($journey->email == \Auth::user()->email)
                                                    <div class = "edit"> 
                                                        <form action="{{ url('journeysedit/'.$journey->id) }}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-primary j_btn">
                                                                <!--更新-->
                                                                <i class="glyphicon glyphicon-pencil"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class = "delete">
                                                        <form action="{{ url('journey/'.$journey->id) }}" method="POST">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <!--bootstrapのcomponentsの値をクラスに追加する-->
                                                            <button type="submit" class="btn btn-danger delete j_btn">
                                                                <!--削除-->
                                                                <i class="fa fa-trash glyphicon glyphicon-trash"></i> 
                                                            </button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--コメントと写真アイコンは初期非表示-->
                                            <div class = "comment_pics" hidden>
                                                @if(isset($journey->comment))
                                                    <div class = "comment">{{ $journey->comment }}</div>
                                                @endif
                                                @if(isset($journey->img1))
                                                    <a href = "{{ $journey->img1 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img2))
                                                    <a href = "{{ $journey->img2 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img3))
                                                    <a href = "{{ $journey->img3 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img4))
                                                    <a href="{{ $journey->img4 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img5))
                                                    <a href="{{ $journey->img5 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                        <div class = "time">
                                            @if($email == \Auth::user()->email)
                                            <span class = "flex">
                                            @endif
                                            <div class = "des_t">{{ $journey->des_time }}</div>
                                            @if($email == \Auth::user()->email)
                                            </span>
                                            @endif
                                            <div class = "des_p">{{ $journey->destination }}</div>
                                        </div>
                                    </div>
                                </div>
                         @endforeach
                        </div>
                    </div>
                </div>
        @else
            <div>まだデータがありません．追加ボタンを押して記録しましょう．</div>
        @endif
    <!--  ook: 既に登録されてる本 リスト -->
        <!-- 本登録フォーム -->
        @if($email == \Auth::user()->email)
        <!--urlをつけると自動的にドメインを追加してくれる-->
        <form action="{{ url('journeys') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" accept="image/*">
            <!--↓phpのsession的なチェックをする，セキュリティ的に使用すると良い-->
            {{ csrf_field() }}
            <!--{{ $unique }}-->
            <!--{{ $num }}-->
            <!--{{ $email }}-->
            <input type="hidden" name="u_id" id="u_id" value="{{$unique}}">
            <!--<div id="station0"></div>-->
            <!--<input type="hidden" name="u_id" id="u_id" value="1">-->
            <!-- 本のタイトル -->
            <div class="form-group">
                <!--出発関連-->
                <label for="dep_time" class="col-sm-4 control-label">出発時間*</label>
                <div class="col-sm-6">
                    <input type="time" name="dep_time" id="dep_time" class="form-control">
                </div>
                <label for="departure" class="col-sm-4 control-label">出発地*</label>
                <div class="col-sm-6">
                    <!--↓項目を追加する，時間とか価格とか-->
                    <!--<div id="station0" class="form-control"></div>-->
                    <input type="text" name="departure" id="departure" value="" class="form-control">
                </div>
                <!--経路関連-->
                <label for="route" class="col-sm-4 control-label">経路*</label>
                <div class="col-sm-6">
                    <input type="text" name="route" id="route" class="form-control">
                </div>
                <!--目的地関連-->
                <label for="des_time" class="col-sm-4 control-label">到着時間*</label>
                <div class="col-sm-6">
                    <input type="time" name="des_time" id="des_time" class="form-control">
                </div>
                <label for="destination" class="col-sm-4 control-label">目的地*</label>
                <div class="col-sm-6">
                    <!--↓項目を追加する，時間とか価格とか-->
                    <!--<div id="station1" class="form-control"></div>-->
                    <input type="text" name="destination" id="destination" value="" class="form-control">
                </div>
                <!--コメント-->
                <label for="comment" class="col-sm-4 control-label">コメント</label>
                <div class="col-sm-6">
                    <input type="text" name="comment" id="comment" class="form-control">
                </div>
                <!--写真-->
                <label for="img1" class="col-sm-4 control-label">写真</label>
                <div class="col-sm-6">
                    <input type="file" name="img1" id="img1" class="form-control">
                    <input type="file" name="img2" id="img2" class="form-control">
                    <input type="file" name="img3" id="img3" class="form-control">
                    <input type="file" name="img4" id="img4" class="form-control">
                    <input type="file" name="img5" id="img5" class="form-control">
                </div>
            </div>
            
            <!-- 本登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default" id="submit">
                        <i class="fa fa-plus glyphicon glyphicon-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>
        @endif
    <!--</div>-->
@endsection




