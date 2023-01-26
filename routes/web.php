<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// ログイン画面
Route::get('/', 'UserController@login')->name('login');
Route::get('/login', 'UserController@login');

// ログイン機能
Route::post('/hoge', 'UserController@to_index')->name('top');

// ゲストでログイン
Route::get('/index', 'UserController@guest')->name('guest');

// ロゴからトップページへ遷移
Route::get('/hoge', 'UserController@logo_top')->name('logo');

//ユーザー一覧
Route::get('/all_users', 'UserController@all_users')->name('all_users');

//駐車場一覧
Route::get('/all_parkings', 'SerchController@all_parkings')->name('all_parkings');

// マイページ
Route::get('/mypage', 'UserController@mypage')->name('mypage');

// お気に入り追加
Route::post('/add_favorite{id}', 'SerchController@add_favorite')->name('add_favorite');
// お気に入り削除
Route::get('/delete_favorite{id}', 'SerchController@delete_favorite')->name('delete_favorite');

// 新規登録
Route::get('/sign_up', 'UserController@sign_up')->name('sign_up');
// 新規登録確認
Route::post('/sign_up/sign_up_confirm', 'UserController@sign_up_confirm')->name('sign_up_confirm');
Route::get('/sign_up/sign_up_confirm', 'UserController@sign_up_confirm');
// 新規登録完了
Route::post('/sign_up/sign_up_complete', 'UserController@sign_up_complete')->name('sign_up_complete');

// ユーザー削除確認
Route::post('/delete_user_confirm', 'UserController@delete_user_confirm')->name('delete_user_confirm');
Route::get('/delete_user_confirm', 'UserController@delete_user_confirm');
// ユーザー削除完了
Route::post('/delete_user_complete', 'UserController@delete_user_complete')->name('delete_user_complete');

// パスワード再発行
Route::get('/reset', 'UserController@reset')->name('reset');
// パスワード再発行入力
Route::post('/reset/reset_password', 'UserController@reset_password')->name('reset_password');
Route::get('/reset/reset_password', 'UserController@reset_password');
// パスワード再発行完了
Route::post('/reset/reset_password_complete', 'UserController@reset_password_complete')->name('reset_password_complete');

// 駐車場検索結果
Route::get('/result_parking', 'SerchController@result_parking')->name('result_parking');
//駐車所詳細画面
Route::get('/detail{id}', 'SerchController@detail')->name('detail');

//駐車所編集
Route::post('/edit_parking{id}', 'SerchController@edit_parking')->name('edit_parking');
Route::get('/edit_parking{id}', 'SerchController@edit_parking');
//駐車所編集確認
Route::post('/edit_parking/edit_parking_confirm', 'SerchController@edit_parking_confirm')->name('edit_parking_confirm');
Route::get('/edit_parking/edit_parking_confirm', 'SerchController@edit_parking_confirm');
//駐車所編集完了
Route::post('/edit_parking/edit_parking_complete', 'SerchController@edit_parking_complete')->name('edit_parking_complete');

//駐車所追加
Route::get('/add_parking', 'SerchController@add_parking')->name('add_parking');
//駐車所追加確認
Route::post('/add_parking/add_parking_confirm', 'SerchController@add_parking_confirm')->name('add_parking_confirm');
Route::get('/add_parking/add_parking_confirm', 'SerchController@add_parking_confirm');
//駐車所追加完了
Route::post('/add_parking/add_parking_complete', 'SerchController@add_parking_complete')->name('add_parking_complete');

//駐車場削除完了
Route::post('/delete_parking_complete{id}', 'SerchController@delete_parking_complete')->name('delete_parking_complete');
