@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5">
        <h3>ログイン</h3>
        <form method="POST" action="{{ route('top') }}" class="mt-3 mb-5">
        @csrf
            <!-- エラー文 -->
            @if(isset($login_error))
            <p class="text-danger">メールアドレスまたはパスワードが一致しません。</p>
            @endif
            @if(isset($ban_error))
            <p class="text-danger">入力したメールアドレスは使用できません。</p>
            @endif

            <!-- メールアドレス -->
            <div class="col text-start mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>

            <!-- パスワード -->
            <div class="col text-start mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input id="password" type="password" class="form-control" name="password">
            </div>

            <!-- ログインボタン -->
            <div class="d-grid gap-2 col-md-6 mx-auto my-3"> 
                <button type="submit" class="text-center btn-lg mt-5 py-3" value="login" name="action">ログイン</button>
            </div>
        </form>

        <!-- パスワード再発行 -->
        <a href="{{ route('reset') }}" class="row justify-content-center my-3">パスワードを忘れた方はこちら</a>
        
        <!-- 新規ユーザー登録 -->
        <a href="{{ route('sign_up') }}" class="row justify-content-center my-3">新規登録</a>
        
        <!-- ゲストでログイン -->
        <a href="{{ route('guest') }}" class="row justify-content-center my-3">ゲストでログインする</a>
    </div>
</main> 
@endsection
