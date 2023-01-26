@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>パスワード再発行</h3>
        <form method="POST" action="{{ route('reset_password') }}" class="mt-4 mb-5">
        @csrf
            @if(isset($user_error))
            <p class="text-danger">ユーザー名とメールアドレスが一致しません。</p>
            @endif
            <div class="col text-start my-4">
                <label for="name" class="form-label">ユーザー名（ニックネーム）</label>
                <input id="name" type="text" class="form-control" name="name">
            </div>
            <div class="col text-start my-4">
                <label for="email" class="form-label">メールアドレス</label>
                <input id="email" type="email" class="form-control" name="email">
            </div>
            <div class="d-grid gap-2 col-md-6 mx-auto my-3">
                <button type="submit" class="text-center btn-lg my-5 px-4 py-3">入力画面</button>
            </div>
        </form>
    </div>
</main>
@endsection