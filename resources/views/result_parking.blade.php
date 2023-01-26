@extends('layout')
@section('content')
<main>
    <div class="w-75 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>検索結果</h3>
        <h4 class="my-5">{{ $spot_name[0]->name }}付近の駐車場</h4>
        <!-- ～md表示 -->
        <table class="text-center table table-bordered d-md-none">
                <thead>
                    <tr>
                        <th class="align-middle">駐車場名</th>
                        <th class="align-middle">台数（台）</th>
                        <th class="align-middle">距離（m）</th>
                        <th class="align-middle"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parkings as $parking) 
                    <tr>
                        <td class="align-middle">{{ $parking->name }}</td>
                        <td class="align-middle">{{ $parking->capacity }}</td>
                        <td class="align-middle">{{ $parking->distance }}</td>
                        <td class="align-middle"><a href="{{ route('detail', ['id'=>$parking->id]) }}"><i class="bi bi-file-earmark-text"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- md～表示 -->
            <table class="table table-bordered d-none d-md-table">
                <thead>
                    <tr>
                        <th>駐車場名</th>
                        <th>利用時間と料金</th>
                        <th>台数（台）</th>
                        <th>距離（m）</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parkings as $parking)                  
                    <tr>
                        <td class="align-middle">{{ $parking->name }}</td>
                        <td class="align-middle">{!! nl2br(e($parking->time_price)) !!}</td>
                        <td class="align-middle">{{ $parking->capacity }}</td>
                        <td class="align-middle">{{ $parking->distance }}</td>
                        <td class="align-middle"><a href="{{ route('detail', ['id'=>$parking->id]) }}">詳細</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="rounded mx-auto d-block">
                {{ $parkings->appends(request()->query())->links() }}
            </div>
    </div>
</main>
@endsection