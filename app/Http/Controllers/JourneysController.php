<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// ↓複数テーブルを使用する場合にはテーブルに対応したモデルをすべて読み込む必要がある
use App\Journeys;
use App\Articles;
use DB;
// ↓条件指定のため必要
use Validator;
// ↓セッションを使用するため
use Session;
// ↓写真のアップロードに使用
use Intervention\Image\Facades\Image; 

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
                            ->orderBy('dep_date', 'desc')
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
        // $articles->traffic = $request->traffic;
        $tra = $request->traffic;
        $traffic = implode(', ',$tra);
        $articles->traffic = $traffic;
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
        $tra = $request->traffic;
        $traffic = implode(', ',$tra);
        $articles->traffic = $traffic;
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
        if($request->email != ""){
            session::put('email', $request->email);
        }

        // ↓セッションの値を変数に格納
        $unique = session::get('unique');
        $email = session::get('email');
        // ↓セッションがからの場合はトップページにリダイレクト
        if($unique == ""){
    	    return redirect('/');
        }else{
            // ↓ユニークIDで検索し，合致するものを並べて表示
            $journeys = Journeys::where('u_id', '=', $unique)
            // numbers順(基本登録した順)で並べる
                                ->orderBy('numbers', 'asc')
                                ->get();
            // 並び順の配列を得る
            $num = Journeys::where('u_id', '=', $unique)
                                ->orderBy('numbers', 'asc')
                                ->pluck('numbers');
            // $email = $request->email;
        // return view('test', ['journeys' => $journeys])->with('num',$num);

            // ↓変数を持ったまま詳細表示へ移動，登録時にinput hddenに値に埋め込む
            // return view('journeys', ['journeys' => $journeys])->with('unique',$unique);
            return view('journeys', ['journeys' => $journeys],compact('unique','num', 'email'));
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
        
        // 写真の処理
        $input = $request->all();
        for($i = 1; $i <= 5; $i++){
            if(isset($input['img' . $i])){
                $fileName[$i] = $input['img' . $i]->getClientOriginalName();
                $fileName[$i]= time()."@".$fileName[$i];
                $image[$i] = Image::make($input['img' . $i]->getRealPath());
                $image[$i]->save(public_path() . '/images/' . $fileName[$i]);
                $path[$i] = '/images/' . $fileName[$i];
                $journeys->{'img'.$i} = 'images/' . $fileName[$i];
            }
        }
        
        $journeys->name = \Auth::user()->name;
        $journeys->email = \Auth::user()->email;
        $journeys->u_id = $request->u_id;
        $journeys->dep_time = $request->dep_time;
        $journeys->departure = $request->departure;
        $journeys->route = $request->route;
        $journeys->des_time = $request->des_time;
        $journeys->destination = $request->destination;
        $journeys->comment = $request->comment;
        $journeys->save();
        // numbersカラムにidの値をコピー
        $journeys->numbers = $journeys->id;
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
    
    // 検索の処理
    public function search(Request $request){
        // 最近を上にして並べておく
        $articles = Articles::orderBy('dep_date', 'desc');
        // それぞれ入力されている場合に検索式を実行する
        if($request->dep_date != ""){
            $articles = $articles->where('dep_date', '=', $request->dep_date);
        }
        if($request->length != ""){
            $articles = $articles->where('length', '=', $request->length);
        }
        if($request->cost != ""){
            $articles = $articles->where('cost', '=', $request->cost);
        }
        if($request->traffic != ""){
            $articles = $articles->where('traffic', 'like', "%{$request->traffic}%");
        }
        if($request->word != ""){
            // 詳細の出発地経路目的地の中から入力した単語の含まれるレコードを抽出する
            $journeys = Journeys::where('departure', 'like', "%{$request->word}%")
                                ->orwhere('route', 'like', "%{$request->word}%")
                                ->orwhere('destination', 'like', "%{$request->word}%")
                                // ユニークIDのみ配列で取得
                                ->pluck('u_id');
            // 得たユニークIDの配列で旅行一覧から検索
            $articles = $articles->whereIn('u_id', $journeys)
                                //  タイトルに検索ワードが含まれる場合も追加
                                 ->orwhere('title', 'like', "%{$request->word}%");
        }
        if($request->free != ""){
            // 詳細の出発地経路目的地コメントの中から入力した単語の含まれるレコードを抽出する
            $journeys = Journeys::where('departure', 'like', "%{$request->free}%")
                                ->orwhere('route', 'like', "%{$request->free}%")
                                ->orwhere('destination', 'like', "%{$request->free}%")
                                ->orwhere('comment', 'like', "%{$request->free}%")
                                // ユニークIDのみ配列で取得
                                ->pluck('u_id');
            // 得たユニークIDの配列で旅行一覧から検索
            $articles = $articles->whereIn('u_id', $journeys)
                                //  タイトルに検索ワードが含まれる場合も追加
                                 ->orwhere('title', 'like', "%{$request->free}%");
        }
        $articles = $articles->get();
        return view('result', ['articles' => $articles]);
    }

    // テストページの表示
    public function test(){
        $journeys = Journeys::orderBy('numbers', 'desc')
                            ->get();
        $num = Journeys::orderBy('numbers', 'desc')
                            ->pluck('numbers');
        return view('test', ['journeys' => $journeys])->with('num',$num);
    }
    
    // 詳細ページで順番を入れ替える処理
    public function sort(Request $request){
        // 変更するために必要な乱数(9桁，intの最大値を超えないように)
        $str="";
        for($i=0; $i<9; $i++){
            $str.=mt_rand(0,9);
        }
        // もともとの順番の配列(5,4,3,2,1)
        $now_num = explode (",", $request->now_num);
        // 入れ替えた順番の配列(3,4,5,2,1)
        $new_num = explode (",", $request->new_num);
        // 変更する配列分の長さ繰り返す
        for($i=0; $i<count($now_num); $i++){
            // 乱数から1ずつ足した数をつくる(小さい順に並べるため)
            $str_new_num = $str + $i;
            // 並び替えた配列(3,4,5,2,1)の最初からレコードを抽出する
            // $journeys = Journeys::find($new_num[$i])
            $journeys = Journeys::where('numbers', $new_num[$i])
            // 一時的に乱数を用いた数に変更する(3->99,4->98,5->97,2->96,1->95)(処理中の重複を防ぐため)
                        // ->update(['id' => $str_new_num]);
                        ->update(['numbers' => $str_new_num]);
        }

        // 順番を入れ替えて乱数を設定したレコードを，正しい順番に書き換える
        for($i=0; $i<count($now_num); $i++){
            // 再度前回の乱数から1ずつ足した数で検索
            $str_now_num = $str + $i;
            // $journeys = Journeys::find($str_new_num)
            $journeys = Journeys::where('numbers', $str_now_num)
            // もともとの順番に書き換え(99->5, 98->4, 97->3, 96->2, 95->1)
            // 結果(3->99->5, 4->98->4, 5->97->3, 2->96->2, 1->95->1)
                        ->update(['numbers' => $now_num[$i]]);
        }
        return redirect('/detail');

    }

}
