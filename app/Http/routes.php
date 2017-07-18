<?php
#Routing実行
use App\Journeys; 
// $_GET,$_POST的な作業をするため必要なファイルを読み込む
use Illuminate\Http\Request; 

// 本のダッシュボード表示 
Route::get('/', function () {
    // ↓getをpagenateに変更できる
    $journeys = Journeys::orderBy('created_at', 'asc')->get();
    return view('journeys', ['journeys' => $journeys]);
}); 

// 新「本」を追加
// formの情報を受け取る． $_GET[]$_POST[]とかの意味
Route::post('/journeys', function (Request $request) {
    //バリデーション，取得した内容をall関数で掴む
    $validator = Validator::make($request->all(), [
        // 入力必須，最大最小入力長さを指定している
        'departure' => 'required|min:1|max:255',
        'dep_time' => 'required|min:1|max:255',
        'route' => 'required|min:1|max:255',
        'destination' => 'required|min:1|max:255',
        'des_time' => 'required|min:1|max:255',
        // 例'email' => 'required',
    ]);
    //バリデーション:エラー
    if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
    }
        // Eloquentモデル
    $journeys = new Journeys;
    $journeys->departure = $request->departure;
    $journeys->dep_time = $request->dep_time;//←固定，可変は$request->item_number;とか
    $journeys->dep_comment = $request->dep_comment;//固定
    $journeys->route = $request->route;
    $journeys->r_comment = $request->r_comment;//固定
    $journeys->destination = $request->destination;
    $journeys->des_time = $request->des_time;//←固定，可変は$request->item_number;とか
    $journeys->des_comment = $request->des_comment;//固定
    $journeys->img1 = $request->img1;
    $journeys->img2 = $request->img2;
    $journeys->img3 = $request->img3;
    $journeys->img4 = $request->img4;
    $journeys->img5 = $request->img5;
    $journeys->img6 = $request->img6;
    $journeys->img7 = $request->img7;
    $journeys->img8 = $request->img8;
    $journeys->img9 = $request->img9;
    $journeys->img10 = $request->img10;
    $journeys->img11 = $request->img11;
    $journeys->img12 = $request->img12;
    $journeys->img13 = $request->img13;
    $journeys->img14 = $request->img14;
    $journeys->img15 = $request->img15;
    $journeys->save();   //「/」ルートにリダイレクト 
    return redirect('/');

});

Route::post('/booksedit/{books}', function(Books $books) {
    //{books}id 値を取得 => Books $books id 値の1レコード取得
    return view('booksedit', ['book' => $books]);
});

Route::post('/books/update', function(Request $request){
//バリデーション
    $validator = Validator::make($request->all(), [
        // 入力必須，最大最小入力長さを指定している
        'id' => 'required',
        'departure' => 'required|min:1|max:255',
        'dep_time' => 'required|min:1|max:255',
        'route' => 'required|min:1|max:255',
        'destination' => 'required|min:1|max:255',
        'des_time' => 'required|min:1|max:255',
        // 例'email' => 'required',
    ]);
    //バリデーション:エラー
    if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
    }
        // Eloquentモデル
    $journeys = Journeys::find($request->id);
    $journeys->departure = $request->departure;
    $journeys->dep_time = $request->dep_time;//←固定，可変は$request->item_number;とか
    $journeys->dep_comment = $request->dep_comment;//固定
    $journeys->route = $request->route;
    $journeys->r_comment = $request->r_comment;//固定
    $journeys->destination = $request->destination;
    $journeys->des_time = $request->des_time;//←固定，可変は$request->item_number;とか
    $journeys->des_comment = $request->des_comment;//固定
    $journeys->img1 = $request->img1;
    $journeys->img2 = $request->img2;
    $journeys->img3 = $request->img3;
    $journeys->img4 = $request->img4;
    $journeys->img5 = $request->img5;
    $journeys->img6 = $request->img6;
    $journeys->img7 = $request->img7;
    $journeys->img8 = $request->img8;
    $journeys->img9 = $request->img9;
    $journeys->img10 = $request->img10;
    $journeys->img11 = $request->img11;
    $journeys->img12 = $request->img12;
    $journeys->img13 = $request->img13;
    $journeys->img14 = $request->img14;
    $journeys->img15 = $request->img15;
    $books->save();   //「/」ルートにリダイレクト 
    return redirect('/');
});

// 本を削除 
// Booksがテーブル名
Route::delete('/journey/{journey}', function (Journeys $journey) {
	 $journey->delete();
	 return redirect('/');
});



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

