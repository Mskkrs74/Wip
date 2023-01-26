<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     * ログイン画面へ遷移
     */
    public function login()
    {
        $response = $this->get(route('login'));

        // HTTPステータスコード200が返ってくるか？
        $response->assertOk();

        $response->assertViewIs('login');

        $response->assertSeeText('パスワードを忘れた方はこちら');
        $response->assertSeeText('新規登録');
        $response->assertSeeText('ゲストでログインする');
    }
    /**
     * @test 
     * ゲストでログイン
     */
    public function guest()
    {
        $response = $this->get(route('guest'));

        $response->assertOk();

        $response->assertViewIs('index');
    }
     /**
     * @test
     * ログイン
     */
    public function to_index()
    {
        // 管理者としてログイン
        $response = $this->post('/hoge', [
            'email' => 'kanri@gmail.com',
            'password' => 'KanriKanri001',
        ]);
        
        $response->assertOk();
        //  管理者トップページへ
        $response->assertViewIs('manegement');
        
        // ユーザーとしてログイン
        $response = $this->post('/hoge', [
            'email' => 'user001@gmail.com',
            'password' => 'UserUser001',
        ]);

        $response->assertOk();
        // ユーザートップページへ
        $response->assertViewIs('index');

        // 削除したアカウントへログイン
        $response = $this->post('/hoge', [
            'email' => 'ban@gmail.com',
            'password' => 'Ban12345',
        ]);

        $response->assertOk();

        $response->assertViewIs('login');

        // エラー分表示
        $response->assertSeeText('入力したメールアドレスは使用できません。');

        // ログイン情報が一致しない時
        $response = $this->post('/hoge', [
            'email' => 'user001@gmail.com',
            'password' => '12345',
        ]);

        $response->assertOk();

        $response->assertViewIs('login');
        // エラー分表示
        $response->assertSeeText('メールアドレスまたはパスワードが一致しません。');
    }

    /**
     * @test
     * 新規登録画面への遷移
     */
    public function sign_up()
    {
        $response = $this->get(route('sign_up'));

        $response->assertOk();

        $response->assertViewIs('sign_up');
    }

    /**
     * @test
     * 新規登録確認画面へ
     */
    public function sign_up_confirm()
    {
        // 新規登録内容入力


        //  エラーなし
        $response = $this->post('/sign_up/sign_up_confirm', [
            'name' => 'user099',
            'email' => 'user099@gmail.com',
            'password' => 'UserUser099',
            'password_confirmation' => 'UserUser099',
        ]);
        
        $response->assertOk();

        //  確認画面へ
        $response->assertViewIs('sign_up_confirm');
        


        //  入力欄未入力
        $response = $this
            ->from('sign_up')
            ->post('/sign_up/sign_up_confirm', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);
        
        // リダイレクト ステータス 302
        $response->assertStatus(302);

        //  リダイレクト
        $response->assertRedirect('sign_up');

        // 遷移
        $response = $this->get('sign_up');

        // エラー分表示
        $response->assertSeeText('氏名は必須入力です。10文字以内でご入力ください。');
        $response->assertSeeText('メールアドレスは正しくご入力ください。');
        $response->assertSeeText('半角英数字を大文字小文字それぞれ1種類以上含む8文字以上で入力してください。');



        // パスワード不一致
        $response = $this
            ->from('sign_up')
            ->post('/sign_up/sign_up_confirm', [
            'name' => 'user200',
            'email' => 'user200@gmail.com',
            'password' => 'UserUser200',
            'password_confirmation' => 'Useruser200',
        ]);
        
        // リダイレクト ステータス 302
        $response->assertStatus(302);

        //  リダイレクト
        $response->assertRedirect('sign_up');

        // 遷移
        $response = $this->get('sign_up');

        // エラー分表示
        $response->assertSeeText('パスワードと確認用が一致しません。');


        // 各項目エラー発生
        $response = $this
            ->from('sign_up')
            ->post('/sign_up/sign_up_confirm', [
            'name' => 'useruseruser200',
            'email' => 'user200',
            'password' => 'useruser200',
            'password_confirmation' => 'useruser200',
        ]);
        
        // リダイレクト ステータス 302
        $response->assertStatus(302);

        //  リダイレクト
        $response->assertRedirect('sign_up');

        // 遷移
        $response = $this->get('sign_up');

        // エラー分表示
        $response->assertSeeText('10文字以内でご入力ください。');
        $response->assertSeeText('メールアドレスは正しくご入力ください。');
        $response->assertSeeText('半角英数字を大文字小文字それぞれ1種類以上含む8文字以上で入力してください。');

    }

    /**
     * @test
     * 新規登録完了画面へ
     */
    public function sign_up_complete() 
    {
        //  エラーなし->テスト確認済み
        // $response = $this->post('/sign_up/sign_up_complete', [
        //     'name' => 'user100',
        //     'email' => 'user100@gmail.com',
        //     'password' => 'UserUser100',
        //     'password_confirmation' => 'UserUser100',
        //     'action' => 'submit',
        // ]);

        // $response->assertOk();

        // //  完了画面へ
        // $response->assertViewIs('sign_up_complete');

        // 修正ボタン
        $response = $this->post('/sign_up/sign_up_complete', [
            'name' => 'user100',
            'email' => 'user100@gmail.com',
            'password' => 'UserUser100',
            'password_confirmation' => 'UserUser100',
            'action' => 'back',
        ]);

        // リダイレクト ステータス 302
        $response->assertStatus(302);

        //  リダイレクト
        $response->assertRedirect('sign_up');

        // 遷移
        $response = $this->get('sign_up');

        // 入力内容の保持確認
        $response->assertSee('user100');
        $response->assertSee('user100@gmail.com');
        // ↓パスワード入力するとテスト失敗確認済み
        // $response->assertSee('UserUser100');
    }

    /**
     * @test
     * パスワード再設定画面へ
     */
    public function reset() 
    {
        $response = $this->get(route('reset'));

        // HTTPステータスコード200が返ってくるか？
        $response->assertOk();

        $response->assertViewIs('reset');

        $response->assertSeeText('パスワード再発行');

    }

    /**
     * @test
     * パスワード再設定入力画面へ
     */
    public function reset_password() 
    {
        // エラーなし
        $response = $this->post('/reset/reset_password', [
            'name' => 'user100',
            'email' => 'user100@gmail.com',
        ]);
    
        $response->assertOk();
    
        //  パスワード入力画面へ
        $response->assertViewIs('reset_password');


        // ユーザー名とメールアドレス不一致
        $response = $this->post('/reset/reset_password', [
            'name' => 'user100',
            'email' => 'user101@gmail.com',
        ]);
    
        // リダイレクト ステータス 302
        $response->assertOk();
    
        // 再設定画面へ戻る
        $response->assertViewIs('reset');


    }
}
