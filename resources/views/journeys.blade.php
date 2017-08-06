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
        @if (count($journeys) > 0)
            <div class="panel panel-default">
                <div class="panel-heading"> 
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                    <!--テーブルヘッダ-->
                        <thead>
                            <th>レコード一覧</th>
                            <th>&nbsp;</th>
                        </thead>
                        <!-- テーブル本体 -->
                        <tbody>
                         @foreach ($journeys as $journey)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $journey->dep_time }}</div>
                                    <div><i class="fa fa-plus glyphicon glyphicon-menu-down"></i></div>
                                    <div>{{ $journey->des_time }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->departure }}</div>
                                    <div>{{ $journey->route }}</div>
                                    <div>{{ $journey->destination }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->comment }}</div>
                                    <!--写真のアイコン表示-->
                                    <!--<div>{{ $journey->u_id }}</div>-->
                                    <!--@for($i = 1; $i <= 5; $i++)-->
                                    <!--    @if(isset($journey->{'img'.$i}))-->
                                    <!--        <a href="$journey->{'img'.$i}" ><i class="glyphicon glyphicon-picture"></i></a>-->
                                    <!--    @endif-->
                                    <!--@endfor-->
                                    @if(isset($journey->img1))
                                        <a href="{{ $journey->img1 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                    @endif
                                    @if(isset($journey->img2))
                                        <a href="{{ $journey->img2 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                    @endif
                                    @if(isset($journey->img3))
                                        <a href="{{ $journey->img3 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                    @endif
                                    @if(isset($journey->img4))
                                        <a href="{{ $journey->img4 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                    @endif
                                    @if(isset($journey->img5))
                                        <a href="{{ $journey->img5 }}" ><i class="glyphicon glyphicon-picture"></i></a>
                                    @endif
                                </td>
                                <!--本更新ボタン-->
                                <td>
                                @if($journey->email == \Auth::user()->email)
                                    <form action="{{ url('journeysedit/'.$journey->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            <!--更新-->
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                    </form>
                                @endif
                                </td>
                                <!-- 本: 削除ボタン -->
                                <td>
                                @if($journey->email == \Auth::user()->email)
                                    <form action="{{ url('journey/'.$journey->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <!--bootstrapのcomponentsの値をクラスに追加する-->
                                        <button type="submit" class="btn btn-danger">
                                            <!--削除-->
                                            <i class="fa fa-trash glyphicon glyphicon-trash"></i> 
                                        </button>
                                    </form>
                                @endif
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
        <form action="{{ url('journeys') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" accept="image/*">
            <!--↓phpのsession的なチェックをする，セキュリティ的に使用すると良い-->
            {{ csrf_field() }}
            {{ $unique }}
            <input type="hidden" name="u_id" id="u_id" value="{{$unique}}">
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
                    <input type="text" name="departure" id="departure" class="form-control">
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
                    <input type="text" name="destination" id="destination" class="form-control">
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
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus glyphicon glyphicon-plus"></i> Save
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection




