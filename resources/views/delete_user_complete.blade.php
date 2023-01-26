@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>アカウント削除</h3>
        <div class="my-5 py-5 boder">
            <p>アカウントを削除しました。</p>
        </div>
        @if(Session::get('role') == 1)
        <!-- 管理者表示 -->
        <div class="d-grid gap-2 col-md-6 mx-auto my-5 p-4">
            <button class="p-3" onclick="location.href='{{ route('all_users') }}' ">ユーザー一覧</button>
        </div>
        @else
        <!-- ユーザー表示 -->
        <div class="d-grid gap-2 col-md-6 mx-auto my-5 p-4">
            <button class="p-3" onclick="location.href='{{ route('login') }}' ">ログイン</button>
        </div>
        @endif
    </div>
</main>
@endsection