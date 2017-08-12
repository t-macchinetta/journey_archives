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
                        <tbody id="sortable">
                         @foreach ($journeys as $journey)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $journey->id }}</div>
                                    <div>{{ $journey->u_id }}</div>
                                </td>
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
                                        <button type="submit" class="btn btn-danger delete">
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

        

    </div>
@endsection




