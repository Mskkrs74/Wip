@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>新しいパスワード</h3>
        <div class="my-5 py-5 boder">
            <p>パスワードを再設定しました。</p>
        </div>
        <div class="d-grid gap-2 col-md-6 mx-auto my-5 p-4">
            <button class="p-3" onclick="location.href='{{ route('login') }}' ">ログイン</button>
        </div>
    </div>
</main>
@endsection