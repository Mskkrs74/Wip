<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Validator;

class UserController extends Controller
{   
    //ログイン 画面へ遷移
    public function login() {
        
        // roleを3にする。
        Session::put('role', '3');
        
        return view('login');
    }

    // ロゴからトップページへ遷移
    public function logo_top() {

        $prefectures = DB::table('prefectures')->get();
        $spots = DB::table('spots')->get();

        if(Session::get('role') == 0 && Session::get('ban') == 0) {

            // ユーザー
            return view('index', compact('prefectures', 'spots'));
        }
        elseif(Session::get('role') == 1) {

            // 管理人
            return view('manegement');
        }
        else {
            return view('login');
        }
    }

    //ログイン機能
    public function to_index(Request $request) {
        
        // roleを3にする。(ページ更新、戻る対策)
        Session::put('role', '3');

        // usersテーブルからemail一致データ抽出
        $user_info = User::where('email', $request->email)->get();

        // アカウント削除したユーザーの判定
        if($user_info[0]->ban == 1){
            return view('login', ['ban_error' => '1']);
        }
        
        // 一致データないとき
        if(count($user_info) == 0) {
            return view('login', ['login_error' => '1']);
        }
        
        // パスワードが一致するかどうか。
        if(password_verify($request->password, $user_info[0]->password)) {

            //セッション
            $request->session()->put('id', $user_info[0]->id);
            $request->session()->put('name', $user_info[0]->name);
            $request->session()->put('email', $user_info[0]->email);
            $request->session()->put('role', $user_info[0]->role);
            $request->session()->put('ban', $user_info[0]->ban);

            // roleでユーザーと管理者の遷移先をコントロール
            if($user_info[0]->role == 1) {
                return view('manegement');
            }
            elseif($user_info[0]->role == 0 && $user_info[0]->ban == 0 ) {

                $prefectures = DB::table('prefectures')->get();
                $spots = DB::table('spots')->get();

                return view('index', compact('prefectures', 'spots'));
            }
        }else {
            //userテーブルと一致しない場合リダイレクト処理
            return view('login', ['login_error' => '1']);
        }
    }

    // ゲストでログイン
    public function guest() {

        // roleを2にする。
        Session::put('role', '2');

        $prefectures = DB::table('prefectures')->get();
        $spots = DB::table('spots')->get();


        return view('index', compact('prefectures', 'spots'));
    }
        
    // 新規登録への遷移
    public function sign_up() {
        return view('sign_up');
    }

    // 新規登録確認へバリデーションと遷移
    public function sign_up_confirm(Request $request) {
        // 新規登録バリデーション
        $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email',
            'password' => 'required|confirmed|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\-]{8,24}$/',
            'password_confirmation' => 'required',
        ]);

        //フォームからの入力値をすべて取得
        $inputs = $request->all();

        // 既に同じメールアドレスが登録されていないか
        $user_info =DB::table('users')->where('email', $inputs['email'])->get();
        if(count($user_info) > 0) {
            return view('sign_up',  ['email_error' => '1']);
        }
        
        // 登録されていないとき確認画面へ
        return view('sign_up_confirm', [
            'inputs' => $inputs
        ]);

    }

    // 新規登録DB登録
    public function sign_up_complete(Request $request) {

        //actionの値を取得
        $action = $request->input('action');

        //action以外の値の取得
        $inputs = $request->except('action');

        if($action !== 'submit') {

            //戻るボタンの場合リダイレクト処理
            return redirect('sign_up')
            ->withInput($inputs);
        }else {

            //新規登録ボタンの場合db挿入処理
            DB::table('users')->insert([
                'name' => $inputs['name'],
                'email' => $inputs['email'],
                'password' => password_hash($inputs['password'], PASSWORD_DEFAULT),
                'role' => 0,
                'created_at' => now(),
                'ban' => 0,
            ]);

            // お気に入り登録用
            DB::table('favorites')->insert([
                'parking_id_1' => null,
                'parking_id_2' => null,
                'parking_id_4' => null,
                'parking_id_5' => null,
                'parking_id_6' => null,
                'parking_id_7' => null,
                'parking_id_8' => null,
                'parking_id_9' => null,
                'parking_id_10' => null,
            ]);
        }

        //二十送信対策のためのトークン発行
        $request->session()->regenerateToken();

        return view('sign_up_complete');
    }

    //ユーザー一覧
    public function all_users() {
        if(Session::get('role') == 1 && Session::get('id')) {
            // アカウント削除されていない人のみ表示
            $users = User::where('ban', 0)->paginate(10);
    
            return view('all_users', compact('users'));
        }else {
            // ログイン画面
            return view('login');
        }
    }

    // ユーザー削除確認
    public function delete_user_confirm(Request $request) {
        if((Session::get('role') == 0 && Session::get('id')) || Session::get('role') == 1) {

            $delete_user_id = $request->delete_user_id;
      
            return view('delete_user_confirm', compact('delete_user_id'));
        }else {
            return view('login');
        }

    }
    // ユーザー削除完了
    public function delete_user_complete(Request $request) {
        if((Session::get('role') == 0 && Session::get('id')) || Session::get('role') == 1) {
            
            //actionの値を取得
            $action = $request->input('action');
    
            //action以外の値の取得
            $inputs = $request->except('action');
    
            if($action !== 'delete') {
    
                //戻るボタンの場合リダイレクト処理
                // roleごとに遷移先変更
    
                if(Session::get('role') == 0) {
                    
                    // ユーザー
                    return redirect('mypage');
                }
                else{
    
                    // 管理人
                    return redirect('all_users');
                }
    
            }else {
    
                //削除ボタンの場合
                // 削除するuser_idを取得しban = 1にupdateする。
                DB::table('users')->where('id', $inputs['delete_user_id'])->update([
                    'ban' => 1,
                ]);
    
                // ユーザーのみroleを変更する。
                if(Session::get('role') == 0) {
                    
                    // roleを3にする。
                    Session::put('role', '3');
                }
    
                return view('delete_user_complete');
            }
        }else {
            return view('login');
        }

    }

     // パスワード再発行へ遷移
     public function reset() {

        return view('reset');
    }
    // パスワード再発行入力
    public function reset_password(Request $request) {

        // ニックネームとメールアドレスを比較する。
        $user = DB::table('users')->where('name', $request->name)->where('email', $request->email)->get();

        if(count($user) == 1) {
            return view('reset_password', compact('user'));
        }
        else {
            return view('reset', ['user_error' => '1']);
        }
    }
    // パスワード再発行完了
    public function reset_password_complete(Request $request) {

        // パスワードバリデーション
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\-]{8,24}$/',
            'password_confirmation' => 'required',
        ],
        [
            'password.required' => '半角英数字を大文字小文字それぞれ1種類以上含む8文字以上で入力してください',
            'password.confirmed' => 'パスワードと確認用が一致しません。',
            'password.regex' => '半角英数字を大文字小文字それぞれ1種類以上含む8文字以上で入力してください',
        ]);
        
        // エラー時
        if($validator->fails()) {

            $user = DB::table('users')->where('id', $request->id)->get();
            
            return view('reset_password', compact('user'))->withErrors($validator);
        }
        
        // パスワードをupdateする。
        DB::table('users')->where('id', $request->id)->update([
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);
        
        return view('reset_password_complete');
    }

    // マイページ
    public function mypage() {

        if(Session::get('role') == 0 && Session::get('id')) {
            $favorites = array();
            for($i=1; $i<11;$i++) {
    
                $favorite = DB::table('favorites')->select("favorites.parking_id_{$i}",'parkings.id as parking_id', 'parkings.name as parking_name', 'spots.name as spot_name', 'parkings.distance as distance')
                ->join('parkings', "favorites.parking_id_{$i}", '=', 'parkings.id')
                ->join('spots', 'parkings.spot_id', '=', 'spots.id')
                ->where('favorites.user_id', Session::get('id'))
                ->get();
    
                $favorites[$i -1] = $favorite;
            }
    
            return view('mypage', compact('favorites'));
        }else {
            return view('login');
        }

    }
        
}
