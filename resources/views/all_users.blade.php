@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>ユーザー一覧</h3>
        <div class="text-start my-5 py-md-2">
            <!-- ～md表示 -->
            <table class="text-center table table-bordered d-md-none">
                <tr>
                    <th>id</th>
                    <th>ユーザー名</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <form method="POST" name="delete_user" action="{{ route('delete_user_confirm') }}">
                    @csrf
                        <input type="hidden" name="delete_user_id" value="{{ $user->id }}">
                        <td><button class="btn btn-link" type="submit" value="delete"><i class="bi bi-file-earmark-x"></i></button></td>
                    </form>
                </tr>
                @endforeach                    
            </table>
            <!-- md～表示 -->
            <table class="table table-bordered d-none d-md-table">
                <tr class="text-center">
                    <th>id</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th></th>
                </tr>
                @foreach($users as $user)
                <tr class="text-center">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <form method="POST" name="delete" action="{{ route('delete_user_confirm') }}">
                    @csrf
                        <input type="hidden" name="delete_user_id" value="{{ $user->id }}">
                        <td><button class="btn btn-link" type="submit" value="delete">削除</button></td>
                    </form>
                </tr>
                @endforeach                    
            </table>
        </div>
        <div class="rounded mx-auto d-block">
            {{ $users->links() }}
        </div>
    </div>
</main>
@endsection