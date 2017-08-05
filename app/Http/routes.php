<?php
#Routing実行
use App\Journeys; 
use App\Articles;
// $_GET,$_POST的な作業をするため必要なファイルを読み込む
use Illuminate\Http\Request; 

// 最初のページ
Route::any('/', 'JourneysController@index'); 

// 旅行を登録する
Route::post('/articles', 'JourneysController@create');

// 旅行の概要を更新するページへ遷移する処理
Route::post('/articlesedit/{articles}', 'JourneysController@title_edit');

// 旅行の概要を更新する処置
Route::post('/articles/update', 'JourneysController@title_update');

// 旅行自体を削除する処理
// Booksがテーブル名
Route::delete('/article/{article}', 'JourneysController@delete');

// 詳細表示 /{articles}
Route::any('/detail', 'JourneysController@detail'); 

// 新しい旅行を追加
// formの情報を受け取る． $_GET[]$_POST[]とかの意味
Route::post('/journeys', 'JourneysController@store');

// 旅行の詳細情報を更新するページへ遷移する処理
Route::post('/journeysedit/{journeys}', 'JourneysController@edit');

// 旅行のレコードを更新する処置
Route::post('/journeys/update', 'JourneysController@update');

// レコードを削除する処理
Route::delete('/journey/{journey}', 'JourneysController@destroy');


// ↓ユーザー認証関連
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

