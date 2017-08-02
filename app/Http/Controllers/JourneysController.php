<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// ↓複数テーブルを使用する場合にはテーブルに対応したモデルをすべて読み込む必要がある
use App\Journeys;
use App\Articles;
// ↓条件指定のため必要
use Validator;
// ↓セッションを使用するため
use Session;

class JourneysController extends Controller
{
    // ログイン処理
    public function __construct(){
        // 認証を必須とする処理
        $this->middleware('auth');
    }
    // 最初のページ
    public function index(){
        // ↓getをpagenateに変更できる
        // emailでユーザーを指定．新しい順に作成したもののリストを並べる
        $articles = Articles::where('email', '=', \Auth::user()->email)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('articles', ['articles' => $articles]);
    }
    // 新しい旅行を追加
    public function create(Request $request){
        //バリデーション，取得した内容をall関数で掴む
        $validator = Validator::make($request->all(), [
            // 入力必須，最大最小入力長さを指定している
            'title' => 'required|min:1|max:255',
            'dep_date' => 'required|min:1|max:255',
            'length' => 'required|min:1|max:255',
            'cost' => 'required|min:1|max:255',
            'traffic' => 'required|min:1|max:255',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        // Eloquentモデル
        $articles = new Articles;
        $articles->name = \Auth::user()->name;
        $articles->email = \Auth::user()->email;
        $articles->u_id = md5(uniqid(rand(),1));
        $articles->title= $request->title;
        $articles->dep_date = $request->dep_date;
        $articles->length = $request->length;
        $articles->cost = $request->cost;
        $articles->traffic = $request->traffic;
        $articles->save(); 
        return redirect('/');
    }
    // 全体の更新画面
    public function title_edit(Articles $articles){
        return view('articlesedit', ['article' => $articles]);
    }
    // 全体の更新処理
    public function title_update(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            // 入力必須，最大最小入力長さを指定している
            'title' => 'required|min:1|max:255',
            'dep_date' => 'required|min:1|max:255',
            'length' => 'required|min:1|max:255',
            'cost' => 'required|min:1|max:255',
            'traffic' => 'required|min:1|max:255',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/detail')
                    ->withInput()
                    ->withErrors($validator);
        }
        // Eloquentモデル
        $articles = Articles::find($request->id);
        $articles->title= $request->title;
        $articles->dep_date = $request->dep_date;
        $articles->length = $request->length;
        $articles->cost = $request->cost;
        $articles->traffic = $request->traffic;
        $articles->save(); 
        return redirect('/');
    }
    // 全体の削除処理
    public function delete(Articles $article){
	    $article->delete();
	    return redirect('/');
    }

    // 旅行詳細ページ
    public function detail(Request $request){
        // ↓getをpagenateに変更できる
        // ↓リクエストが飛んできた場合はセッションに保存
        if($request->u_id != ""){
            session::put('unique', $request->u_id);
        }
        // ↓セッションの値を変数に格納
        $unique = session::get('unique');
        // ↓セッションがからの場合はトップページにリダイレクト
        if($unique == ""){
    	    return redirect('/');
        }else{
            // ↓ユニークIDで検索し，合致するものを並べて表示
            $journeys = Journeys::where('u_id', '=', $unique)
                                ->orderBy('created_at', 'asc')
                                ->get();
            // ↓変数を持ったまま詳細表示へ移動，登録時にinput hddenに値に埋め込む
            return view('journeys', ['journeys' => $journeys])->with('unique',$unique);
        }
    }
    
    // 詳細の登録処理
    public function store(Request $request){
        //バリデーション，取得した内容をall関数で掴む
        $validator = Validator::make($request->all(), [
            // 入力必須，最大最小入力長さを指定している
            'dep_time' => 'required|min:1|max:255',
            'departure' => 'required|min:1|max:255',
            'route' => 'required|min:1|max:255',
            'des_time' => 'required|min:1|max:255',
            'destination' => 'required|min:1|max:255',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/detail')
                    ->withInput()
                    ->withErrors($validator);
        }
        // Eloquentモデル
        $journeys = new Journeys;
        $journeys->name = \Auth::user()->name;
        $journeys->email = \Auth::user()->email;
        $journeys->u_id = $request->u_id;
        $journeys->dep_time = $request->dep_time;
        $journeys->departure = $request->departure;
        $journeys->route = $request->route;
        $journeys->des_time = $request->des_time;
        $journeys->destination = $request->destination;
        $journeys->comment = $request->comment;
        $journeys->img1 = $request->img1;
        $journeys->img2 = $request->img2;
        $journeys->img3 = $request->img3;
        $journeys->img4 = $request->img4;
        $journeys->img5 = $request->img5;
        $journeys->save(); 
        return redirect('/detail');
    }
    // 詳細の更新ページ
    public function edit(Journeys $journeys){
        //{journeys}id 値を取得 => Journeys $journeys id 値の1レコード取得
        return view('journeysedit', ['journey' => $journeys]);
    }
    // 詳細の更新処理
    public function update(Request $request){
        // バリデーション
        $validator = Validator::make($request->all(), [
            // 入力必須，最大最小入力長さを指定している
            'id' => 'required',
            'dep_time' => 'required|min:1|max:255',
            'departure' => 'required|min:1|max:255',
            'route' => 'required|min:1|max:255',
            'des_time' => 'required|min:1|max:255',
            'destination' => 'required|min:1|max:255',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/detail')
                    ->withInput()
                    ->withErrors($validator);
        }
        // Eloquentモデル
        $journeys = Journeys::find($request->id);
        $journeys->dep_time = $request->dep_time;
        $journeys->departure = $request->departure;
        $journeys->route = $request->route;
        $journeys->des_time = $request->des_time;
        $journeys->destination = $request->destination;
        $journeys->comment = $request->comment;
        $journeys->img1 = $request->img1;
        $journeys->img2 = $request->img2;
        $journeys->img3 = $request->img3;
        $journeys->img4 = $request->img4;
        $journeys->img5 = $request->img5;
        $journeys->save(); 
        return redirect('/detail')->with('request->u_id',$request->u_id);
    }
    // 詳細の削除処理
    public function destroy(Journeys $journey){
	    $journey->delete();
	    return redirect('/detail');
    }

}
