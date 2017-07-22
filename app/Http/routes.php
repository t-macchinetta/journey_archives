<?php
#Routing実行
use App\Journeys; 
// $_GET,$_POST的な作業をするため必要なファイルを読み込む
use Illuminate\Http\Request; 

// 本のダッシュボード表示 
Route::get('/', 'JourneysController@index'); 

// 新「本」を追加
// formの情報を受け取る． $_GET[]$_POST[]とかの意味
Route::post('/journeys', 'JourneysController@store');

Route::post('/journeysedit/{journeys}', 'JourneysController@edit');

Route::post('/journeys/update', 'JourneysController@update');

// 本を削除 
// Booksがテーブル名
Route::delete('/journey/{journey}', 'JourneysController@destroy');


Route::auth();

Route::get('/home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// 変数で渡す
// Route::get('/gs/{x}', function ($a) {
//     return "ジーズアカデミー".$a;
// });

// 複数の値を変数で渡せる
// 変数が異なっても順番で処理される
// Route::get('/gs/{x}/{y}', function ($a,$b) {
//     return "ジーズアカデミー".$a.$b;
// });

