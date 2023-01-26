@extends('layout')
@section('content')
<main>
    <div class="w-75 text-center mx-auto my-5 d-flex flex-column justify-content-around">
    <h3>駐車場一覧</h3>
        <div class="text-start my-5 py-md-2">
            <!-- ～md表示 -->
            <table class="text-center table table-bordered d-md-none">
                <tr>
                    <th class="align-middle">駐車場名</th>
                    <th class="align-middle">観光地名</th>
                    <th class="align-middle">詳細</th>
                    <th class="align-middle">編集</th>
                    <th class="align-middle">削除</th>
                </tr>
                @foreach($parkings as $parking)
                <tr>
                    <td>{{ $parking->name }}</td>
                    <td>{{ $parking->spot_name }}</td>
                    <form action="{{ route('detail', ['id'=>$parking->id]) }}" method="get">
                    @csrf
                        <input type="hidden" name="detail_parking_id" value="{{ $parking->id }}">
                        <td class="align-middle"><button class="btn btn-link" type="submit" value="detail"><i class="bi bi-file-earmark-text"></i></button></td>
                    </form>
                    <form action="{{ route('edit_parking', ['id'=>$parking->id]) }}" method="POST">
                    @csrf
                        <input type="hidden" name="edit_parking_id" value="{{ $parking->id }}">
                        <td class="align-middle"><button class="btn btn-link" type="submit" value="edit"><i class="bi bi-pencil"></i></button></td>
                    </form>
                    <form action="{{ route('delete_parking_complete', ['id'=>$parking->id]) }}" method="POST" onsubmit="return confirm('本当にこの駐車場を削除しますか?')">
                    @csrf
                        <input type="hidden" name="delete_parking_id" value="{{ $parking->id }}">
                        <td class="align-middle"><button class="btn btn-link" type="submit" value="delete"><i class="bi bi-file-earmark-x"></i></button></td>
                    </form>
                </tr>
                @endforeach                    
            </table>
            <!-- md～表示 -->
            <table class="table table-bordered d-none d-md-table text-center">
                <tr>
                    <th class="align-middle">駐車場名</th>
                    <th class="align-middle">最寄り観光地</th>
                    <th class="align-middle">利用時間と料金</th>
                    <th class="align-middle">台数（台）</th>
                    <th class="align-middle">距離（m）</th>
                    <th>&emsp;&emsp;</th>
                    <th>&emsp;&emsp;</th>
                    <th>&emsp;&emsp;</th>
                </tr>
                @foreach($parkings as $parking)
                <tr>
                    <td class="align-middle">{{ $parking->name }}</td>
                    <td class="align-middle">{{ $parking->spot_name }}</td>
                    <td class="align-middle">{!! nl2br(e($parking->time_price)) !!}</td>
                    <td class="align-middle">{{ $parking->capacity }}</td>
                    <td class="align-middle">{{ $parking->distance }}</td>
                    <form action="{{ route('detail', ['id'=>$parking->id]) }}" method="get">
                    @csrf
                        <input type="hidden" name="detail_parking_id" value="{{ $parking->id }}">
                        <td  class="align-middle"><button class="btn btn-link" type="submit" value="detail">詳細</button></td>
                    </form>
                    <form action="{{ route('edit_parking', ['id'=>$parking->id]) }}" method="POST">
                    @csrf
                        <input type="hidden" name="edit_parking_id" value="{{ $parking->id }}">
                        <td  class="align-middle"><button class="btn btn-link" type="submit" value="edit">編集</button></td>
                    </form>
                    <form action="{{ route('delete_parking_complete', ['id'=>$parking->id]) }}" method="POST" onsubmit="return confirm('本当にこの駐車場を削除しますか?')">
                    @csrf
                        <input type="hidden" name="delete_parking_id" value="{{ $parking->id }}">
                        <td  class="align-middle"><button class="btn btn-link" type="submit" value="delete">削除</button></td>
                    </form>
                </tr>
                @endforeach                    
            </table>
        </div>
        <div class="rounded mx-auto d-block">
            {{ $parkings->links() }}
        </div>
        <div class="d-grid gap-2 col-md-5 mx-auto mt-5 d-block">
            <form action="{{ route('add_parking') }}" method="get">
                <button type="submit" class="text-center w-100 py-3">駐車場追加</button>
            </form>
        </div>
    </div>
</main>
@endsection