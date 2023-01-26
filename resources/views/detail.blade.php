@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>{{ $detail[0]->name }}</h3>
        <h4 class="text-md-start my-5">{{ $detail[0]->spot_name }}まで{{ $detail[0]->distance }}</h4>
        @if(isset($favorite_error))
                    <p class="text-danger">既に10個お気に入り登録されています。</p>
        @endif
        @if(isset($duplication_error))
                    <p class="text-danger">既にこの駐車場はお気に入り登録されています。</p>
        @endif
        <!-- ～md表示 -->
        <table class="text-center table table-bordered d-md-none">
            <tr>
                <th class="align-middle">駐車場名</th>
                <td>{{ $detail[0]->name }}</td>
            </tr>
            <tr>
                <th class="align-middle">郵便番号</th>
                <td>〒{{ $detail[0]->postal_code }}</td>
            </tr>
            <tr>
                <th class="align-middle">住所</th>
                <?php
                $address = $detail[0]->address;
                if (!empty($address)) {
                    $address2 = urlencode($address.$detail[0]->name);
                    $zoom = 21;
                    $url ="https://www.google.com/maps/search/?api=1&query={$address2} ";
                    echo "<td>{$address}<a href=\"{$url}\" target=\"_blank\">(Google Map)</a></td>";
                }
                ?>
            </tr>
            <tr>
                <th class="align-middle">利用時間と料金</th>
                <td>{!! nl2br(e($detail[0]->time_price)) !!}</td>
            </tr>
            <tr>
                <th class="align-middle">台数</th>
                <td>{{ $detail[0]->capacity }}</td>
            </tr>
            <tr>
                <th class="align-middle">注意事項等</th>
                <td>{!! nl2br(e($detail[0]->remarks)) !!}</td>
            </tr>
        </table>
        <!-- md～表示 -->
        <table class="table table-bordered d-none d-md-table text-center my-5">
            <tr>
                <th class="align-middle">駐車場名</th>
                <td class="align-middle">{{ $detail[0]->name }}</td>
            </tr>
            <tr>
                <th class="align-middle">郵便番号</th>
                <td class="align-middle">〒{{ $detail[0]->postal_code }}</td>
            </tr>
            <tr>
                <th class="align-middle">住所</th>
                <?php
                $address = $detail[0]->address;
                if (!empty($address)) {
                    $address2 = urlencode($address.$detail[0]->name);
                    $zoom = 21;
                    $url ="https://www.google.com/maps/search/?api=1&query={$address2} ";
                    echo "<td>{$address}<a href=\"{$url}\" target=\"_blank\">(Google Map)</a></td>";
                }
                ?>
            </tr>
            <tr>
                <th class="align-middle">利用時間と料金</th>
                <td class="align-middle">{!! nl2br(e($detail[0]->time_price)) !!}</td>
            </tr>
            <tr>
                <th class="align-middle">台数（台）</th>
                <td class="align-middle">{{ $detail[0]->capacity }}</td>
            </tr>
            <tr>
                <th class="align-middle">注意事項等</th>
                <td class="align-middle">{!! nl2br(e($detail[0]->remarks)) !!}</td>
            </tr>
        </table>
        @if(Session::get('role') == 0 && Session::get('ban') == 0)
        <!-- ユーザーのみ表示 -->
            <!-- ～mdの表示画面 -->
            <div class="d-grid d-md-none gap-2 col-md-5">
                <form method="POST" action="{{ route('add_favorite', ['id'=>$detail[0]->id]) }}">
                @csrf
                    <input type="hidden" value="{{ $detail[0]->spot_id }}" name="spot_id">
                    <button type="submit" class="text-center w-100 py-3" value="favorite">お気に入り追加</button>
                </form>
            </div>
            <div class="d-grid d-md-none gap-2 col-md-5">
                <form method="POST" action="{{ route('edit_parking', ['id'=>$detail[0]->id]) }}">
                @csrf
                    <button type="submit" class="text-center w-100 py-3 mt-3" value="edit">駐車場詳細の変更</button>
                </form>
            </div>
            <!-- md～の表示画面 -->
            <div class="d-none d-md-flex justify-content-between">
                <div class="d-grid gap-2 col-md-5 my-3">
                    <form method="POST" action="{{ route('add_favorite', ['id'=>$detail[0]->id]) }}">
                    @csrf
                        <input type="hidden" value="{{ $detail[0]->spot_id }}" name="spot_id">
                        <button type="submit" class="text-center w-75 mt-4 py-3" value="favorite">お気に入り追加</button>
                    </form>
                </div>
                <div class="d-grid gap-2 col-md-5 my-3">
                    <form method="POST" action="{{ route('edit_parking', ['id'=>$detail[0]->id]) }}">
                    @csrf
                        <button type="submit" class="text-center w-75 mt-4 py-3" value="edit">駐車場詳細の変更</button>
                    </form>
                </div>
            </div>
        </form>
        @endif
    </div>
</main>
@endsection