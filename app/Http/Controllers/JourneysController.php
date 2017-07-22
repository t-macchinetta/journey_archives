<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
// ↓複数テーブルを使用する場合にはテーブルに対応したモデルをすべて読み込む必要がある
use App\Journeys;
// ↓条件指定のため必要
use Validator;

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
        $journeys = Journeys::orderBy('created_at', 'asc')->get();
        return view('journeys', ['journeys' => $journeys]);
    }
    // 登録処理
    public function store(Request $request){
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

    }
    public function edit(Journeys $journeys){
        //{journeys}id 値を取得 => Journeys $journeys id 値の1レコード取得
        return view('journeysedit', ['journey' => $journeys]);
    }
    public function update(Request $request){
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
        $journeys->save();   //「/」ルートにリダイレクト 
        return redirect('/');
   
    }
    public function destroy(Journeys $journey){
	 $journey->delete();
	 return redirect('/');
    }

}
