@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        @if($duplication_error != null || $count_error)
        <h3>お気に入り追加失敗</h3>
        @else
        <h3>お気に入り追加</h3>
        @endif
        <div class="my-5 py-5 boder">
            @if($count_error != null)
            <p>すでにお気に入りが上限の10個登録されています。</p>
            @elseif($duplication_error != null)
            <p>すでにこの駐車場はお気に入り登録されています。</p>
            @else
            <p>お気に入りに追加しました。</p>
            @endif
        </div>
        @if($count_error != null)
        <div class="d-grid gap-2 col-md-6 mx-auto my-5 p-4">
            <form method="get" action="{{ route('mypage') }}">
                <button class="p-3" type="submit">マイページ</button>
            </form>
        </div>
        @else
        <div class="d-grid gap-2 col-md-6 mx-auto my-5 p-4">
            <form method="get" action="{{ route('result_parking') }}">
                <input type="hidden" value="{{ $spot_id }}" name="spot_id">
                <button class="p-3" type="submit">検索結果に戻る</button>
            </form>
        </div>
        @endif
    </div>
</main>
@endsection