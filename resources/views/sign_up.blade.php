@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>新規登録</h3>
        <form method="POST" action="{{ route('sign_up_confirm') }}" class="mt-3 mb-5">
        @csrf
            <div class="col text-start mb-3">
                <label for="name" class="form-label">ユーザー名（ニックネーム）</label>
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="col text-start mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                @if(isset($email_error))
                    <p class="text-danger">このメールアドレスは既に登録されています。</p>
                @endif
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            <div class="col text-start mb-3">
                <label for="password" class="form-label">パスワード</label>
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
                <input id="password" type="password" class="form-control" name="password">
            </div>
            <div class="col text-start mb-3">
                <label for="password_confirmation" class="form-label">パスワード（確認用）</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
            </div>
            
            <div class="d-grid gap-2 col-md-6 mx-auto my-3">
                <button type="submit" class="text-center btn-lg mt-4 py-3">確認画面</button>
            </div>
        </form>
    </div>
</main>
@endsection