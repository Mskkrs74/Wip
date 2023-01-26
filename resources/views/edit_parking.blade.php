@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h3>駐車場詳細の変更&emsp;{{ $edit_parking_info[0]->name }}</h3>
        @if ($errors->has('distance'))
            <p class="text-danger">{{ $errors->first('distance') }}</p>
        @endif
        @if ($errors->has('lat'))
            <p class="text-danger">{{ $errors->first('lat') }}</p>
        @endif
        <form method="POST" action="{{ route('edit_parking_confirm') }}" class="mt-3 mb-5">
        @csrf
            <!-- 駐車場ID -->
            <input name="parking_id" type="hidden" value="{{ $edit_parking_info[0]->id }}">
            <div class="d-md-flex justify-content-between">
                <div class="col-md-5 text-start mb-3">
                    <!-- 都道府県ドロップダウンリスト -->
                    <label for="prefecture" class="form-label">都道府県</label>
                    @if ($errors->has('prefecture'))
                        <p class="text-danger">{{ $errors->first('prefecture') }}</p>
                    @endif
                    <select class="form-select prefecture" name="prefecture" id="prefecture" type="text">
                        <option value="{{ $edit_parking_info[0]->prefecture_id }}">{{ $edit_parking_info[0]->prefecture_name }}</option>
                        @foreach($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 text-start mb-3">
                    <!-- selected設定する。 -->
                    <label for="spot" class="form-label">観光地</label>
                    @if ($errors->has('spot'))
                        <p class="text-danger">{{ $errors->first('spot') }}</p>
                    @endif
                    <select class="form-select spot" name="spot" id="edit_spot" type="text">
                        <option value="{{ $edit_parking_info[0]->spot_id }}">{{ $edit_parking_info[0]->spot_name }}</option>
                    </select>
                    <!-- 選択された観光地の緯度 -->
                    @if (old('spot_lat'))
                    <input type="hidden" id="spot_lat" name="spot_lat" value="{{ old('spot_lat') }}">
                    @else
                    <input type="hidden" id="spot_lat" name="spot_lat" value="{{ $edit_parking_info[0]->spots_latitude }}">
                    @endif            
                    <!-- 選択された観光地の経度 -->
                    @if (old('spot_lng'))
                    <input type="hidden" id="spot_lng" name="spot_lng" value="{{ old('spot_lng') }}">
                    @else
                    <input type="hidden" id="spot_lng" name="spot_lng" value="{{ $edit_parking_info[0]->spots_longtude }}">
                    @endif            
                </div>
            </div>
            <!-- value設定する -->
            <div class="col text-start mb-3">
                <label for="name" class="form-label">駐車場名</label>
                @if ($errors->has('parking_name'))
                    <p class="text-danger">{{ $errors->first('parking_name') }}</p>
                @endif
                @if (old('parking_name'))
                <input type="text" name="parking_name" value="{{ old('parking_name') }}" class="form-control edit_name">
                @else
                <input type="text" name="parking_name" value="{{ $edit_parking_info[0]->name }}" class="form-control edit_name">
                @endif            
            </div>
            <div class="col text-start mb-3">
                <label for="post" class="form-label">郵便番号（-除くで7桁で入力）</label>
                @if ($errors->has('zip11'))
                    <p class="text-danger">{{ $errors->first('zip11') }}</p>
                @endif
                @if (old('zip11'))
                <input type="text" name="zip11" value="{{ old('zip11') }}" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" class="form-control edit_postal_code">
                @else
                <input type="text" name="zip11" size="10" maxlength="7" value="{{ $edit_parking_info[0]->postal_code }}" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" class="form-control  edit_postal_code">
                @endif
            </div>
            <!-- 住所 -->
            <div class="col text-start mb-3">
                <label for="adress" class="form-label">住所</label>
                @if ($errors->has('addr11'))
                    <p class="text-danger">{{ $errors->first('addr11') }}</p>
                @endif
                @if (old('addr11'))
                <input type="text" name="addr11" id="address" value="{{ old('addr11') }}" class="form-control edit_address">
                @else
                <input type="text" name="addr11" id="address" class="form-control edit_address" value="{{ $edit_parking_info[0]->address }}" size="60">
                @endif
                <!-- geocoding apiから得た緯度 -->
                <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">
                <!-- geocoding apiから得た経度 -->
                <input type="hidden" id="lng" name="lng" value="{{ old('lng') }}">
            </div>
            <!-- 利用時間、料金 -->
            <div class="col text-start mb-3">
                <label for="time_price" class="form-label">利用時間と料金</label>
                @if ($errors->has('time_price'))
                    <p class="text-danger">{{ $errors->first('time_price') }}</p>
                @endif
                @if (old('time_price'))
                    <textarea rows="5" id="time_price" class="form-control edit_time_price" name="time_price">{{ old('time_price') }}</textarea>
                @else
                    <textarea rows="5" id="time_price" class="form-control edit_time_price" name="time_price">{{ $edit_parking_info[0]->time_price }}</textarea>
                @endif
            </div>
            <!-- 台数 -->
            <div class="col text-start mb-3">
                <label for="capacity" class="form-label">台数</label>
                @if ($errors->has('capacity'))
                    <p class="text-danger">{{ $errors->first('capacity') }}</p>
                @endif
                @if (old('capacity'))
                <input type="text" name="capacity" value="{{ old('capacity') }}" class="form-control edit_capacity">
                @else
                <input type="text" name="capacity" value="{{ $edit_parking_info[0]->capacity }}" class="form-control edit_capacity">
                @endif 
            </div>
            <!-- 注意事項 -->
            <div class="col text-start mb-3">
                <label for="remarks" class="form-label">注意事項</label>
                @if (old('remarks'))
                    <textarea rows="5" class="form-control edit_remarks" name="remarks">{{ old('remarks') }}</textarea>
                @else
                    <textarea rows="5" class="form-control edit_remarks" name="remarks">{{ $edit_parking_info[0]->remarks }}</textarea>
                @endif
            </div>
            <!-- 距離 -->
            @if (old('distance'))
                <input type="hidden" id="distance" name="distance" value="{{ old('distance') }}" class="form-control">
            @else
                <input type="hidden" id="distance" name="distance" value="{{ $edit_parking_info[0]->distance }}" class="form-control">
            @endif
            <div class="d-grid gap-2 col-md-6 mx-auto my-3" id="caliculate"> 
                <button type="button" class="text-center btn-lg mt-5 py-3 bg-info">距離取得</button>
            </div>
            <div class="d-grid gap-2 col-md-6 mx-auto my-3 d-none" id="confirm_button">
                <button type="submit" class="text-center btn-lg mt-5 py-3">確認画面</button>
            </div>
        </form>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="{{ config('services.google-map.apikey') }}"></script>
        <script>
            jQuery(function(){

                //都道府県ドロップダウンリストが切り替わったら発動
                $('.prefecture').change(function() {

                    // optionリセット
                    $('.spot').children().remove();
                    // option追加
                    $('.spot').append('<option>' + '選択してください' + '</option>');
                    
                    // コントローラーから渡されたJSON $spotsをJavaScriptに変換
                    var spots = JSON.parse('<?php echo $spots; ?>');

                    // 選択された都道府県IDを格納
                    const prefecture_id = $('.prefecture').val();

                    // 都道府県IDが格納されたら
                    if(prefecture_id) {

                        for (let i = 0; i < spots.length; i++) {
                            // optionに選択肢となる観光地名を格納
                            option_i = '<option value="' + spots[i].id + '">' + spots[i].name + '</option>';

                            if(prefecture_id == spots[i].prefecture_id)  {

                                // option追加
                                $('.spot').append(option_i);
                            }                                        
                        };
                    }
                })

                $('.spot').change(function(){

                    // 選択された観光地IDを格納
                    const spot_id = $('.spot').val();

                    // コントローラーから渡されたJSON $spotsをJavaScriptに変換
                    var spots = JSON.parse('<?php echo $spots; ?>');

                    // 観光地の緯度経度をinput hiddenにそれぞれ格納する。
                    for (let i = 0; i < spots.length; i++) {

                        // 選択された観光地とコントローラーから渡されたspotsテーブルを比較
                        // 一致したらその後比較する必要ないためbreak
                        if (spot_id == spots[i].id) {
                            
                            // 緯度経度の値を設定
                            $('#spot_lat').val(spots[i].latitude);
                            $('#spot_lng').val(spots[i].longitude);

                            // 入力された観光地の緯度経度の取得
                            var spot_latInput = document.getElementById('spot_lat').value;
                            var spot_lngInput = document.getElementById('spot_lng').value;

                            // 確認用
                            console.log('観光地緯度');
                            console.log(spot_latInput);
                            console.log('観光地経度');
                            console.log(spot_lngInput);
                            break;
                        }
                    }

                })

            })         
        </script>
        <script src="{{ asset('/js/main.js') }}"></script>
    </div>
</main>
@endsection