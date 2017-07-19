<!--layouts/app.blade.phpと同じ意味-->
@extends('layouts.app')
<!--section内の内容をcontentで規定する，後で呼び出せる-->
@section('content')

    <!-- Bootstrap の定形コード... -->

    <div class="panel-body">
        <!--バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!--バリデーションエラーの表示に使用-->

        <!-- 現在 本 -->
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
                                    <div>{{ $journey->departure }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->dep_time }}</div>
                                    <!--<div>{{ $journey->route }}</div>-->
                                    <!--<div>{{ $journey->des_time }}</div>-->
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->dep_comment }}</div>
                                    <!--<div>{{ $journey->r_comment }}</div>-->
                                    <!--<div>{{ $journey->des_comment }}</div>-->
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->route }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->r_comment }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->destination }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->des_time }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $journey->des_comment }}</div>
                                </td>
                                
                                <!--本更新ボタン-->
                                <td>
                                    <form action="{{ url('journeysedit/'.$journey->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary">
                                            <!--更新-->
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                    </form>
                                </td>
                                <!-- 本: 削除ボタン -->
                                <td>
                                    <form action="{{ url('journey/'.$journey->id) }}" method="POST">
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
        <form action="{{ url('journeys') }}" method="POST" class="form-horizontal">
            <!--↓phpのsession的なチェックをする，セキュリティ的に使用すると良い-->
            {{ csrf_field() }}
            
            <!-- 本のタイトル -->
            <div class="form-group">
                <!--出発関連-->
                <label for="departure" class="col-sm-4 control-label">出発地*</label>
                <div class="col-sm-6">
                    <!--↓項目を追加する，時間とか価格とか-->
                    <input type="text" name="departure" id="departure" class="form-control">
                </div>
                <label for="dep_time" class="col-sm-4 control-label">出発時間*</label>
                <div class="col-sm-6">
                    <input type="time" name="dep_time" id="dep_time" class="form-control">
                </div>
                <label for="dep_comment" class="col-sm-4 control-label">コメント</label>
                <div class="col-sm-6">
                    <input type="text" name="dep_comment" id="dep_comment" class="form-control">
                </div>
                <!--/出発関連-->
                <!--経路関連-->
                <label for="route" class="col-sm-4 control-label">経路*</label>
                <div class="col-sm-6">
                    <input type="text" name="route" id="route" class="form-control">
                </div>
                <label for="r_comment" class="col-sm-4 control-label">コメント</label>
                <div class="col-sm-6">
                    <input type="text" name="r_comment" id="r_comment" class="form-control">
                </div>
                <!--/経路関連-->
                <!--目的地関連-->
                <label for="destination" class="col-sm-4 control-label">目的地*</label>
                <div class="col-sm-6">
                    <!--↓項目を追加する，時間とか価格とか-->
                    <input type="text" name="destination" id="destination" class="form-control">
                </div>
                <label for="des_time" class="col-sm-4 control-label">到着時間*</label>
                <div class="col-sm-6">
                    <input type="time" name="des_time" id="des_time" class="form-control">
                </div>
                <label for="des_comment" class="col-sm-4 control-label">コメント</label>
                <div class="col-sm-6">
                    <input type="text" name="des_comment" id="des_comment" class="form-control">
                </div>
                <!--/目的地関連-->
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




