@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <div class="d-grid gap-2 my-3 py-md-5"> 
            <a href="{{ route('all_users') }}" type="button" class="btn btn-outline-info fs-3 py-5">ユーザー一覧</a>
        </div>
        <div class="d-grid gap-2 my-3 py-md-5"> 
            <a href="{{ route('all_parkings') }}" type="button" class="btn btn-outline-info fs-3 py-5">駐車場一覧</a>
        </div>
    </div>
</main>
@endsection