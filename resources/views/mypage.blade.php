@extends('layout')
@section('content')
<main>
    <div class="w-75 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>マイページ</h3>
        <div class="text-start my-5 py-md-2">
            <h4>ユーザー情報</h4>
            <!-- ～md表示 -->
            <table class="text-center table table-bordered d-md-none">
                <tr>
                    <th>ユーザー名</th>
                </tr>
                <tr>
                    <td>{{ Session::get('name') }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                </tr>
                <tr>
                    <td>{{ Session::get('email') }}</td>
                </tr>
            </table>
            <!-- md～表示 -->
            <table class="table table-bordered d-none d-md-table">
                <tr>
                    <th>ユーザー名</th>
                    <td>{{ Session::get('name') }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ Session::get('email') }}</td>
                </tr>
            </table>
        </div>
        <div class="">
            <form method="POST" name="delete" action="{{ route('delete_user_confirm') }}">
            @csrf
                <input type="hidden" name="delete_user_id" value="{{ Session::get('id') }}">
                <td><button class="btn btn-link" type="submit" value="delete">アカウント削除</button></td>
            </form>
        </div>
        <div class="text-start my-5 py-2">
            <h4>お気に入りリスト（最大10ヶ所まで追加可能）</h4>
            <!-- ～md表示 -->
            <table class="text-center table table-bordered d-md-none">
                <thead>
                    @if(count($favorites[0]))
                    <tr>
                        <th class="align-middle">駐車場名</th>
                        <th class="align-middle">最寄り<br>観光地</th>
                        <th class="align-middle"></th>
                        <th class="align-middle"></th>
                    </tr>
                    @else
                    @endif
                </thead>
                <tbody>
                    @foreach ($favorites as $favorite)
                    @if(count($favorite))
                    <tr>
                        <td class="align-middle">{{ $favorite[0]->parking_name }}</td>
                        <td class="align-middle">{{ $favorite[0]->spot_name }}</td>
                        <form action="{{ route('detail', ['id'=>$favorite[0]->parking_id]) }}" method="get">
                        @csrf
                            <input type="hidden" name="detail_parking_id" value="{{ $favorite[0]->parking_id }}">
                            <td class="align-middle"><button class="btn btn-link p-0" type="submit" value="detail"><i class="bi bi-file-earmark-text"></i></button></td>
                        </form>
                        <form action="{{ route('delete_favorite', ['id'=>$favorite[0]->parking_id]) }}" method="get">
                        @csrf
                            <input type="hidden" name="parking_id" value="{{ $favorite[0]->parking_id }}">
                            <td class="align-middle"><button class="btn btn-link p-0" type="submit" value="delete"><i class="bi bi-file-earmark-x"></i></button></td>
                        </form>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <!-- md～表示 -->
            <table class="table table-bordered d-none d-md-table">
                <thead>
                    @if(count($favorites[0]))
                    <tr>
                        <th>駐車場名</th>
                        <th>最寄り観光地</th>
                        <th>距離</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @else
                    @endif
                </thead>
                <tbody>
                    @foreach ($favorites as $favorite)
                    <?php
                    $i = 1;
                    $parking_id = "parking_id_{$i}";
                    $i ++
                    ?>
                    @if(count($favorite))
                    <tr>
                        <td>{{ $favorite[0]->parking_name }}</td>
                        <td>{{ $favorite[0]->spot_name }}</td>
                        <td>{{ $favorite[0]->distance }}</td>
                        <form action="{{ route('detail', ['id'=>$favorite[0]->parking_id]) }}" method="get">
                        @csrf
                            <input type="hidden" name="detail_parking_id" value="{{ $favorite[0]->parking_id }}">
                            <td  class="align-middle"><button class="btn btn-link" type="submit" value="detail">詳細</button></td>
                        </form>
                        <form action="{{ route('delete_favorite', ['id'=>$favorite[0]->parking_id]) }}" method="get">
                        @csrf
                            <input type="hidden" name="parking_id" value="{{ $favorite[0]->parking_id }}">
                            <td  class="align-middle"><button class="btn btn-link" type="submit" value="delete">削除</button></td>
                        </form>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection