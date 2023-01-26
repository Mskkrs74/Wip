@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>新規登録内容の確認</h3>
        <form method="POST" action="{{ route('sign_up_complete') }}" class="mt-3 mb-5">
        @csrf
            <div class="col text-start mb-3">
                <p class="ps-3">ユーザー名（ニックネーム）</p>
                <p class="border rounded p-3">{{ $inputs['name'] }}</p>
                <input id="name" type="hidden" name="name" value="{{ $inputs['name'] }}">
            </div>
            <div class="col text-start mb-3">
                <p class="ps-3">メールアドレス</p>
                <p class="border rounded p-3">{{ $inputs['email'] }}</p>
                <input id="email" type="hidden" name="email" value="{{ $inputs['email'] }}">
                <input id="password" type="hidden" name="password" value="{{ $inputs['password'] }}">
            </div>
            <div class="d-none d-md-flex justify-content-between">
                <div class="d-grid gap-2 col-md-5 my-3">
                    <button type="submit" class="text-center btn-lg mt-4 py-3" value="back" name="action">戻る</button>
                </div>
                <div class="d-grid gap-2 col-md-5 my-3">
                    <button type="submit" class="text-center btn-lg mt-4 py-3" value="submit" name="action">新規登録</button>
                </div>
            </div>
            <div class="d-grid d-md-none gap-2 col-md-5 my-3">
                <button type="submit" class="text-center btn-lg mt-4 py-3" value="back" name="action">戻る</button>
            </div>
            <div class="d-grid d-md-none gap-2 col-md-5 my-3">
                <button type="submit" class="text-center btn-lg mt-4 py-3" value="submit" name="action">新規登録</button>
            </div>
        </form>
    </div>
</main>
@endsection