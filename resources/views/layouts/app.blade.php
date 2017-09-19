<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">

    <title>旅行の記録</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!--<link href="css/style.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

    <!--駅名予測入力用-->
    <!--<link class="css" rel="stylesheet" type="text/css" href="js/expCss/expGuiStation.css">-->

    <style>
        body {
            /*font-family: 'Lato';*/
            font-family: 'helvetica', 'Noto Sans Japanese';
            padding-top: 70px;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    旅行の記録
                </a>
                <a  id = "search" class="navbar-brand link">
                    @if (!Auth::guest())
                    <!--検索ボタン-->
                    <i class="material-icons icon" aria-hidden="true">search</i>
                    <!--<i class="glyphicon glyphicon-search icon" aria-hidden="true"></i>Search-->
                    @endif
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <!--@if (!Auth::guest())-->
                    <!--検索ボタン-->
                    <!--<li id = "search" class = "link"><a><i class="glyphicon glyphicon-search icon" aria-hidden="true"></i>Search</a></li>-->
                    <!--@endif-->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!--モーダル-->
    <div class="modal fade" id="modal_search">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modal-label">他の旅行を検索</h4>
                </div>

                <div class="box_inner">
                    <!--検索用フォーム-->
                    <form action="{{ url('result') }}" method="POST" class="search_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="free">フリーワード</label>
                            <input type="text" name="free" id="free" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="word">地名・交通手段など</label>
                            <input type="text" name="word" id="word" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="s_dep_date">出発日</label>
                            <input type="date" name="dep_date" id="s_dep_date" class="form-control">
                        </div>
                        <!--<div class="select">-->
                        <div class="form-group">
                            <label for="s_length">長さ</label>
                            <select name="length" id="s_length" class="form-control">
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
                            <label for="s_cost">総予算</label>
                            <select name="cost" id="s_cost" class="form-control">
                                <option value=""></option>
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
                                <div class="radio">
                                    <label for="s_none">
                                        <input type="radio" name="traffic" id="s_none" value="" checked>指定しない
                                    </label>
                                </div>
                            </div>
                            <div class="radio-wrap">
                                <div class="radio">
                                    <label for="s_train">
                                        <input type="radio" name="traffic" id="s_train" value="鉄道">鉄道
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="s_bus">
                                        <input type="radio" name="traffic" id="s_bus" value="バス">バス
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="s_plain">
                                        <input type="radio" name="traffic" id="s_plain" value="飛行機">飛行機
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="s_ship">
                                        <input type="radio" name="traffic" id="s_ship" value="船舶">船舶
                                    </label>
                                </div>
                            </div>
                            <div class="radio-wrap">
                                <div class="radio">
                                    <label for="s_car">
                                        <input type="radio" name="traffic" id="s_car" value="自動車">自動車
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="s_bicycle">
                                        <input type="radio" name="traffic" id="s_bicycle" value="自転車">自転車
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="s_foot">
                                        <input type="radio" name="traffic" id="s_foot" value="徒歩">徒歩
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!--<div class="form-group">-->
                            <div class="submit_btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus glyphicon glyphicon-search"></i> search
                                </button>
                            </div>
                        <!--</div>-->
                        
                    </form>
                    <!--</div>-->
                    <!--<p class="text-center"><a class="btn btn-primary" data-dismiss="modal" href="#">閉じる</a></p>-->
                </div>
            </div>
        </div>
    </div>




    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <!--jqueryui-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
    <!--exResize-->
    <!--<script type="text/javascript" src="jquery.exresize.js"></script>-->
    <!--自作jsファイル-->
    <!--<script type="text/javascript" src="js/script.js"></script>-->
    <script src="{{ asset('/js/script.js') }}"></script>
    <!--駅名入力補助用-->
    <!--<script type="text/javascript" src="js/expGuiStation.js?key=LE_hJATfqeEhynen" charset="UTF-8"></script>-->

</body>
</html>
