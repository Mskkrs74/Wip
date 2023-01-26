@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>アカウント削除</h3>
        <div class="my-5 py-5 boder">
            <p>アカウント削除するとお気に入り登録ができなくなります。<br></p>
            <p>本当にアカウントを削除しますか？</p>
        </div>
        <form method="POST" action="{{ route('delete_user_complete') }} " class="mt-3 mb-5">
        @csrf
            <!-- 削除するuser_id -->
            <input type="hidden" name="delete_user_id" value="{{ $delete_user_id }}">

            <!-- ～mdの表示画面 -->
            <div class="d-none d-md-flex justify-content-between">
                <div class="d-grid gap-2 col-md-5 my-3">
                    <button type="submit" class="text-center w-100 mt-4 py-3" value="back" name="action">戻る</button>
                </div>
                <div class="d-grid gap-2 col-md-5 my-3">
                    <button type="submit" class="text-center w-100 mt-4 py-3" value="delete" name="action">削除する</button>
                </div>
            </div>
            <!-- md～の表示画面 -->
            <div class="d-grid d-md-none gap-2 col-md-5 my-3">
                <button type="submit" class="text-center btn-lg mt-4 py-3" value="back" name="action">戻る</button>
            </div>
            <div class="d-grid d-md-none gap-2 col-md-5 my-3">
                <button type="submit" class="text-center btn-lg mt-4 py-3" value="delete" name="action">削除する</button>
            </div>
        </form>
    </div>
</main>
@endsection