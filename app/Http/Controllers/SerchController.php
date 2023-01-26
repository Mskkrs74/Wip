<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Validator;

class SerchController extends Controller
{
    // 駐車場一覧
    public function all_parkings() {
        if(Session::get('role') == 1 && Session::get('id')) {

            $parkings = DB::table('parkings')
                ->select('parkings.id', 'parkings.name', 'spots.name as spot_name', 'parkings.time_price', 'parkings.capacity', 'parkings.distance',)
                ->join('spots', 'parkings.spot_id', '=', 'spots.id')
                ->paginate(10);
            
            return view('all_parkings', compact('parkings'));
        }else{
            
            return view('login');
        }

    }

    // お気に入り追加
    public function add_favorite(Request $request, $id) {
        // エラー確認用
        $count_error = null;
        $duplication_error = null;

        // お気に入りの重複がないか確認
        for($i=1;$i<11;$i++) {
            $duplication_check = DB::table('favorites')->where('user_id', Session::get('id'))->where("parking_id_{$i}", $id)->get();

            if(count($duplication_check)) {

                // 観光地idを返して検索結果に戻れるようにする。
                $spot_id = $request->spot_id;
                
                // エラーメッセージをdetailで表示させる。
                $duplication_error = '1';
                return view('add_favorite', compact('spot_id', 'duplication_error', 'count_error'));
            }
        }

        // お気に入り登録
        for($i=1;$i<11;$i++) {

            // セッションidのユーザーのfavoritesテーブルの行の中でNotNullのカラムを探す
            $favorite = DB::table('favorites')->where('user_id', Session::get('id'))->whereNull("parking_id_{$i}")->get();
            if(count($favorite)) {

                // お気に入り登録
                DB::table('favorites')->where('user_id', Session::get('id'))->update([
                    "parking_id_{$i}" => $id,
                ]);

                break;
            }elseif($i == 10) {
                // 10個既に登録されていないか確認
                // 観光地idを返して検索結果に戻れるようにする。
                $spot_id = $request->spot_id;
                
                // エラーメッセージをdetailで表示させる。
                $count_error = '1';
                return view('add_favorite', compact('spot_id', 'duplication_error', 'count_error'));
            }
        }

        // 観光地idを返して検索結果に戻れるようにする。
        $spot_id = $request->spot_id;

        return view('add_favorite', compact('spot_id', 'duplication_error', 'count_error'));
    }
    // お気に入り削除
    public function delete_favorite(Request $request, $id) {
        for($i=1;$i<11;$i++) {
            // どのカラムのお気に入り登録か
            $favorite = DB::table('favorites')->where('user_id', Session::get('id'))->where("parking_id_{$i}", $id)->get();
            if(count($favorite)) {
                // 削除する駐車場をNullにUPDATEする
                DB::table('favorites')->where('user_id', Session::get('id'))->update([
                    "parking_id_{$i}" => Null,
                ]);

                return view('delete_favorite');
            }
        }

    }

    // 駐車場検索結果
    public function result_parking(Request $request) {

        // テーブルparkingsから検索されたspotの駐車場のみ抽出
        $parkings = DB::table('parkings')->where('spot_id', $request->spot_id)->paginate(10);;

        //テーブルspotsから検索された観光地名を取得
        $spot_name = DB::table('spots')->where('id', $request->spot_id)->get();

        return view('result_parking', compact('parkings', 'spot_name'));
    }
    // 駐車場詳細
    public function detail($id) {

        $detail = DB::table('parkings')
        ->select('parkings.id', 'parkings.name', 'spots.id as spot_id', 'spots.name as spot_name', 'parkings.postal_code', 'parkings.address', 'parkings.time_price', 'parkings.capacity', 'parkings.remarks', 'parkings.distance',)
        ->join('spots', 'parkings.spot_id', '=', 'spots.id')
        ->where('parkings.id', $id)
        ->get();
        return view('detail', compact('detail'));
    }

    // 駐車場編集   
    public function edit_parking($id) {

        //どの列かidを取得
        $edit_parking_info = DB::table('parkings')
            ->select('parkings.id', 'prefectures.id as prefecture_id', 'prefectures.name as prefecture_name', 'spots.id as spot_id', 'spots.name as spot_name', 'spots.latitude as spots_latitude', 'spots.longitude  as spots_longtude', 'parkings.name', 'parkings.postal_code', 'parkings.address', 'parkings.time_price', 'parkings.capacity', 'parkings.remarks', 'parkings.distance')
            ->join('spots', 'parkings.spot_id', '=', 'spots.id')
            ->join('prefectures', 'spots.prefecture_id', '=', 'prefectures.id')
            ->where('parkings.id', $id)
            ->get();

        // 都道府県ドロップダウンリスト
        $prefectures = DB::table('prefectures')->get();

        // 観光地ドロップダウンリスト
        $spots = DB::table('spots')->get();
        
        //$spotsをJavaScriptに変換
        $spots = json_encode($spots);

        return view('edit_parking', compact('edit_parking_info', 'prefectures', 'spots'));
    }
    // 駐車場編集確認
    public function edit_parking_confirm(Request $request) {

        // 駐車場編集バリデーション
        $request->validate([
            'prefecture' => 'required',
            'spot' => 'required',
            'parking_name' => 'required',
            'zip11' => 'required|integer',
            'addr11' => 'required',
            'time_price' => 'required',
            'capacity' => 'integer',
            'distance' => 'required',
        ]);

        //フォームからの入力値をすべて取得
        $inputs = $request->all();
        
        // 観光地名の取得
        $spot_info = DB::table('spots')->where('id', $inputs['spot'])->get();

        return view('edit_parking_confirm', compact('spot_info', 'inputs'));
    }
    // 駐車場編集完了
    public function edit_parking_complete(Request $request) {

        //actionの値を取得
        $action = $request->input('action');

        //action以外の値の取得
        $inputs = $request->except('action');

        if($action !== 'edit') {

            //戻るボタンの場合リダイレクト処理
            return redirect(route('edit_parking', ['id'=>$inputs['parking_id']]))
            ->withInput($inputs);
        }else {

            //新規登録ボタンの場合db挿入処理
            DB::table('parkings')->where('id', $inputs['parking_id'])->update([
                'spot_id' => $inputs['spot_id'],
                'name' => $inputs['parking_name'],
                'postal_code' => $inputs['zip11'],
                'address' => $inputs['addr11'],
                'time_price' => $inputs['time_price'],
                'capacity' => $inputs['capacity'],
                'remarks' => $inputs['remarks'],
                'distance' => $inputs['distance'],
            ]);
        }

        //二十送信対策のためのトークン発行
        $request->session()->regenerateToken();

        return view('edit_parking_complete');
    }

    // 駐車場追加
    public function add_parking() {

        // 都道府県ドロップダウンリスト
        $prefectures = DB::table('prefectures')->get();
        
        // 観光地ドロップダウンリスト
        $spots = DB::table('spots')->get();
        
        //$spotsをJavaScriptに変換
        $spots = json_encode($spots);

        return view('add_parking', compact('prefectures', 'spots'));
    }
    // 駐車場追加確認
    public function add_parking_confirm(Request $request) {

        // 駐車場追加バリデーション
        $request->validate([
            'prefecture' => 'required',
            'spot' => 'required',
            'parking_name' => 'required',
            'zip11' => 'required|integer',
            'addr11' => 'required',
            'time_price' => 'required',
            'capacity' => 'integer',
            'distance' => 'required',
        ]);

        //フォームからの入力値をすべて取得
        $inputs = $request->all();
        
        // 観光地名の取得
        $spot_info = DB::table('spots')->where('id', $inputs['spot'])->get();

        // 確認画面へ
        return view('add_parking_confirm', compact('spot_info', 'inputs'));
    }
    // 駐車場追加完了
    public function add_parking_complete(Request $request) {

        //actionの値を取得
        $action = $request->input('action');

        //action以外の値の取得
        $inputs = $request->except('action');

        if($action !== 'add') {

            //戻るボタンの場合リダイレクト処理
            return redirect('add_parking')
            ->withInput($inputs);
        }else {

            //新規登録ボタンの場合db挿入処理
            DB::table('parkings')->insert([
                'spot_id' => $inputs['spot_id'],
                'name' => $inputs['parking_name'],
                'postal_code' => $inputs['zip11'],
                'address' => $inputs['addr11'],
                'time_price' => $inputs['time_price'],
                'capacity' => $inputs['capacity'],
                'remarks' => $inputs['remarks'],
                'distance' => $inputs['distance'],
            ]);
        }

        //二十送信対策のためのトークン発行
        $request->session()->regenerateToken();

        return view('add_parking_complete');
    }

    // 駐車場削除完了
    public function delete_parking_complete($id) {

        // お気に入りから削除
        // ユーザー数のカウント
        $count_users_favorites = DB::table('favorites')->count();

        for ($i = 1; $i < $count_users_favorites + 1;$i++) {
            for ($j = 1; $j < 11 ;$j++) {
                // 各ユーザーのお気に入り登録に削除する駐車場のidがある場合Nullに更新する。
                $favorites = DB::table('favorites')->where('user_id', $i)->where("parking_id_{$j}", $id)->get();
                if(count($favorites)) {
                    DB::table('favorites')->where('user_id', $i)->update([
                        "parking_id_{$j}" => Null,
                    ]);
                }
            }
        }

        //どの列かidを取得
        DB::table('parkings')->where('id', $id)->delete();
        
        //削除完了画面へ
        return view('delete_parking_complete');
    }
    
}
