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
                        <div class = "exp">
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
                                            <!--記録者のみ☓ボタン表示-->
                                            @if($journey->email == \Auth::user()->email)
                                            <div class = "delete_btn">
                                                <form action="{{ url('journey/'.$journey->id) }}" method="POST">
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
                                        <div class = "flex">
                                        @if($email == \Auth::user()->email)
                                        <span class = "flex">
                                        @endif
                                        <div class = "blank">
                                            @if($email == \Auth::user()->email)
                                            <!--動かせます的なアイコン-->
                                            <i class="material-icons">view_headline</i>
                                            @endif
                                        </div>
                                        @if($email == \Auth::user()->email)
                                        </span>
                                        @endif
                                        <div class = "info">
                                            <div class = "info2">
                                                <div class = "route">
                                                    {{ $journey->route }}
                                                    @if($journey->comment != "")
                                                    <i class="material-icons icon show_comment">chat</i>
                                                    @endif
                                                </div>
                                                @if($journey->email == \Auth::user()->email)
                                                <div class = "buttons">
                                                    <!--記録者のみ編集のボタン表示-->
                                                    <div class = "edit"> 
                                                        <form action="{{ url('journeysedit/'.$journey->id) }}" method="POST">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn j_btn">
                                                                <!--更新-->
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <!--コメントと写真アイコンは初期非表示-->
                                            <div class = "comment_pics" hidden>
                                                @if($journey->comment != "")
                                                    <div class = "comment">{{ $journey->comment }}</div>
                                                @endif
                                                @if(isset($journey->img1))
                                                    <a href = "{{ $journey->img1 }}" target="_blank"><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img2))
                                                    <a href = "{{ $journey->img2 }}" target="_blank"><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img3))
                                                    <a href = "{{ $journey->img3 }}" target="_blank"><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img4))
                                                    <a href="{{ $journey->img4 }}" target="_blank"><i class="glyphicon glyphicon-picture"></i></a>
                                                @endif
                                                @if(isset($journey->img5))
                                                    <a href="{{ $journey->img5 }}" target="_blank"><i class="glyphicon glyphicon-picture"></i></a>
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
                         <div class = "foot"></div>
                        </div>
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
        
        <!--登録した本人の場合は追加ボタンを表示-->
        @if($email == \Auth::user()->email)
        <a id = "add_record", class="fab" href="#">
          <i class="material-icons md-24">add</i>
          <!--<i class="glyphicon glyphicon-plus"></i>-->
        </a>

        <!--モーダル-->
        <div class="modal fade" id="modal_add_record">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="modal-label">新しくルートを追加</h4>
                    </div>
    
                    <div class="box_inner">
                        <form action="{{ url('journeys') }}" method="POST" class="search_form" enctype="multipart/form-data" accept="image/*">
                            <!--↓phpのsession的なチェックをする，セキュリティ的に使用すると良い-->
                            {{ csrf_field() }}
                            <!--{{ $unique }}-->
                            <!--{{ $num }}-->
                            <!--{{ $email }}-->
                            <input type="hidden" name="u_id" id="u_id" value="{{$unique}}">
                            <!--<div id="station0"></div>-->
                            <!--<input type="hidden" name="u_id" id="u_id" value="1">-->

                            <div class="form-group">
                                <label for="dep_time">出発時間*</label>
                                <input type="time" name="dep_time" id="dep_time" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="departure">出発地*</label>
                                <input type="text" name="departure" id="departure" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="route">経路*</label>
                                <input type="text" name="route" id="route" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="des_time">到着時間*</label>
                                <input type="time" name="des_time" id="des_time" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="destination">目的地*</label>
                                <input type="text" name="destination" id="destination" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="comment">コメント</label>
                                <textarea name="comment" id="comment" rows=3 class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="img1">写真</label>
                                <input type="file" name="img1" id="img1" class="form-control">
                                <input type="file" name="img2" id="img2" class="form-control">
                                <input type="file" name="img3" id="img3" class="form-control">
                                <input type="file" name="img4" id="img4" class="form-control">
                                <input type="file" name="img5" id="img5" class="form-control">
                            </div>
                            <div class="submit_btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus glyphicon glyphicon-plus"></i> ルートを追加
                                </button>
                            </div>

                        </form>
    

                    </div>
                </div>
            </div>
        </div>
        @endif
    <!--</div>-->
@endsection




