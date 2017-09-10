<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>旅行の記録</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/earlyaccess/sawarabigothic.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    
    <!--駅名予測入力用-->
    <!--<link class="css" rel="stylesheet" type="text/css" href="js/expCss/expGuiStation.css">-->

    <style>
        body {
            /*font-family: 'Lato';*/
            font-family: 'Noto Sans Japanese';
            /*font-family: 'Rounded Mplus 1c';*/
            /*font-family: 'Sawarabi Gothic';*/
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
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li id = "search" class = "link"><a><i class="glyphicon glyphicon-search icon" aria-hidden="true"></i>Search</a></li>
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
                    <form action="{{ url('result') }}" method="POST" class="form-horizontal search_form ">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="free" class="col-sm-4 control-label">フリーワード</label>
                            <div class="col-sm-6">
                                <input type="text" name="free" id="free" class="form-control">
                            </div>
                            <label for="word" class="col-sm-4 control-label">地名・交通手段など</label>
                            <div class="col-sm-6">
                                <input type="text" name="word" id="word" class="form-control">
                            </div>
                            <label for="s_dep_date" class="col-sm-4 control-label">出発日</label>
                            <div class="col-sm-6">
                                <input type="date" name="dep_date" id="s_dep_date" class="form-control">
                            </div>
                            <label for="s_length" class="col-sm-4 control-label">長さ</label>
                            <div class="col-sm-6">
                                <!--<input type="text" name="length" id="length" class="form-control">-->
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
                            <label for="s_cost" class="col-sm-4 control-label">総予算</label>
                            <div class="col-sm-6">
                                <!--<input type="number" name="cost" id="cost" class="form-control">-->
                                <select name="cost" id="s_cost" class="form-control">
                                    <option value=""></option>
                                    <option value="\1-\10,000">\1-\10,000</option>
                                    <option value="\10,001-\20,000">\10,001-\20,000</option>
                                    <option value="\20,001-\30,000">\20,001-\30,000</option>
                                    <option value="\30,001-\40,000">\30,001-\40,000</option>
                                    <option value="\40,001-\50,000">\40,001-\50,000</option>
                                    <option value="\50,001-\60,000">\50,001-\60,000</option>
                                </select>
                            </div>
                            <label for="s_traffic" class="col-sm-4 control-label">主な交通</label>
                            <div class="col-sm-6">
                                <!--↓項目を追加する，時間とか価格とか-->
                                <!--<input type="text" name="traffic" id="traffic" class="form-control">-->
                                <label for="s_none" class="control-label">指定しない</label>
                                <input type="radio" name="traffic" id="s_none" class="form-control" value="" checked>
                                <label for="s_train" class="control-label">鉄道</label>
                                <input type="radio" name="traffic" id="s_train" class="form-control" value="鉄道">
                                <label for="s_bus" class="control-label">バス</label>
                                <input type="radio" name="traffic" id="s_bus" class="form-control" value="バス">
                                <label for="s_plain" class="control-label">飛行機</label>
                                <input type="radio" name="traffic" id="s_plain" class="form-control" value="飛行機">
                                <label for="s_ship" class="control-label">船舶</label>
                                <input type="radio" name="traffic" id="s_ship" class="form-control" value="船舶">
                                <label for="s_car" class="control-label">自動車</label>
                                <input type="radio" name="traffic" id="s_car" class="form-control" value="自動車">
                                <label for="s_bicycle" class="control-label">自転車</label>
                                <input type="radio" name="traffic" id="s_bicycle" class="form-control" value="自転車">
                                <label for="s_foot" class="control-label">徒歩</label>
                                <input type="radio" name="traffic" id="s_foot" class="form-control" value="徒歩">
                            </div>
            
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus glyphicon glyphicon-plus"></i> search
                                </button>
                            </div>
                        </div>
                        
                    </form>
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
    <script type="text/javascript" src="js/script.js"></script>
    <!--駅名入力補助用-->
    <!--<script type="text/javascript" src="js/expGuiStation.js?key=LE_hJATfqeEhynen" charset="UTF-8"></script>-->

</body>
</html>
