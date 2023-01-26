@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>お気に入り削除</h3>
        <div class="my-5 py-5 boder">
            <p>お気に入り削除完了しました。</p>
        </div>
        <div class="d-grid gap-2 col-md-6 mx-auto my-5 p-4">
            <form action="{{ route('mypage') }}" method="get">
                <button type="submit" class="px-5 py-3">マイページ</button>
            </form>
        </div>
    </div>
</main>
@endsection