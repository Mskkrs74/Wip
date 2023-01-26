@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>新しいパスワード</h3>
        <form method="POST" action="{{ route('reset_password_complete') }}" class="my-4 mb-5">
        @csrf
            <!-- id -->
            <input type="hidden" name="id" value="{{ $user[0]->id }}">

            <!-- 新パスワード -->
            <div class="col text-start my-4 mb-3">
                <label for="password" class="form-label">パスワード</label>
                <!-- エラー文 -->
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
                <input id="password" type="password" class="form-control" name="password">
            </div>
            <div class="col text-start my-4 mb-3">
                <label for="password_confirmation" class="form-label">パスワード（確認用）</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="d-grid gap-2 col-md-6 mx-auto my-4">
                <button type="submit" class="text-center btn-lg py-4 mt-4">パスワード変更</button>
            </div>
        </form>
    </div>
</main>
@endsection