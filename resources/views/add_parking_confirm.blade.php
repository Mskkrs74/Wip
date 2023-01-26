@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>{{ $inputs['parking_name'] }}</h3>
        <!-- Google Maps APIにより距離表示!! -->
        <h4 class="text-md-start my-5">{{ $spot_info[0]->name }}まで{{ $inputs['distance'] }}</h4>
        <!-- ～md表示 -->
        <!-- tdは入力された値を表示!! -->
        <table class="text-center table table-bordered d-md-none">
            <tr>
                <th class="align-middle">駐車場名</th>
                <td>{{ $inputs['parking_name'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">郵便番号</th>
                <td>〒{{ $inputs['zip11'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">住所</th>
                <td>{{ $inputs['addr11'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">利用時間と料金</th>
                <td>{!! nl2br(e($inputs['time_price'])) !!}</td>
            </tr>
            <tr>
                <th class="align-middle">台数</th>
                <td>{{ $inputs['capacity'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">注意事項等</th>
                <td>{!! nl2br(e($inputs['remarks'])) !!}</td>
            </tr>
        </table>
        <!-- md～表示 -->
        <table class="table table-bordered d-none d-md-table text-center my-5">
            <tr>
                <th class="align-middle">駐車場名</th>
                <td class="align-middle">{{ $inputs['parking_name'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">郵便番号</th>
                <td class="align-middle">〒{{ $inputs['zip11'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">住所</th>
                <td class="align-middle">{{ $inputs['addr11'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">利用時間と料金</th>
                <td class="align-middle">{!! nl2br(e($inputs['time_price'])) !!}</td>
            </tr>
            <tr>
                <th class="align-middle">台数（台）</th>
                <td class="align-middle">{{ $inputs['capacity'] }}</td>
            </tr>
            <tr>
                <th class="align-middle">注意事項等</th>
                <td class="align-middle">{!! nl2br(e($inputs['remarks'])) !!}</td>
            </tr>
        </table>
        <form method="POST" action="{{ route('add_parking_complete') }}" class="mt-3 mb-5">
        @csrf
            <!-- 登録するデータ -->
            <!-- 観光地id -->
            <input type="hidden" value="{{ $inputs['spot'] }}" name="spot_id">
            <!-- 駐車場名 -->
            <input type="hidden" value="{{ $inputs['parking_name'] }}" name="parking_name">
            <!-- 郵便番号 -->
            <input type="hidden" value="{{ $inputs['zip11'] }}" name="zip11">
            <!-- 住所 -->
            <input type="hidden" value="{{ $inputs['addr11'] }}" name="addr11">
            <!-- 利用時間と料金 -->
            <input type="hidden" value="{{ $inputs['time_price'] }}" name="time_price">
            <!-- 台数 -->
            <input type="hidden" value="{{ $inputs['capacity'] }}" name="capacity">
            <!-- 注意事項 -->
            <input type="hidden" value="{{ $inputs['remarks'] }}" name="remarks">
            <!-- 観光地との距離 -->
            <input type="hidden" value="{{ $inputs['distance'] }}" name="distance">
            
            <!-- ～mdの表示画面 -->
            <div class="d-grid d-md-none gap-2 col-md-5 my-3">
                <button type="submit" class="text-center btn-lg mt-4" name="action" value="back">修正</button>
            </div>
            <div class="d-grid d-md-none gap-2 col-md-5 my-3">
                <button type="submit" class="text-center btn-lg mt-4" name="action" value="add">追加</button>
            </div>
            <!-- md～の表示画面 -->
            <div class="d-none d-md-flex justify-content-between">
                <div class="d-grid gap-2 col-md-5 my-3">
                    <button type="submit" class="text-center btn-lg mt-4 py-3" name="action" value="back">修正</button>
                </div>
                <div class="d-grid gap-2 col-md-5 my-3">
                    <button type="submit" class="text-center btn-lg mt-4 py-3" name="action" value="add">追加</button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection