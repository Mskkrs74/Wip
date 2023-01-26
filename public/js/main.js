'use strict';

jQuery(function(){

    // 都道府県ボタンクリック後のアニメーション
    $('#serch').on('click', function(){
        $('#prefectures').removeClass('d-none');

        const position = $('#prefectures').offset().top;
        const speed = 100;
        $("html,body").animate({scrollTop:position},speed);
    });
})
    // 緯度経度の取得
    function getLatLng() {
        
        // 入力された住所の取得
        var addressInput = document.getElementById('address').value;
        
        // geocoding api利用
        var geocoder = new google.maps.Geocoder();
        
        // 実行
        geocoder.geocode(
            {
                address: addressInput
            },
            function(results, status) {
                console.log(results, status)

                if (status == google.maps.GeocoderStatus.OK) {
                    // 成功したとき
                    // 結果をループで取得
                    for (var i in results) {
                        if (results[i].geometry) {
                            // 緯度
                            var lat = results[i].geometry.location.lat();                                    
                            // 経度
                            var lng = results[i].geometry.location.lng();
                            
                            // 緯度経度の値を設定
                            $('#lat').val(lat);
                            $('#lng').val(lng);
                            break;
                        }
                    }
                // エラーに対するアラート
                } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                    alert("住所が見つかりませんでした。");
                } else if (status == google.maps.GeocoderStatus.ERROR) {
                    alert("サーバ接続に失敗しました。");
                } else if (status == google.maps.GeocoderStatus.INVALID_REQUEST) {
                    alert("リクエストが無効でした。");
                } else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                    alert("リクエストの制限回数を超えました。");
                } else if (status == google.maps.GeocoderStatus.REQUEST_DENIED) {
                    alert("サービスが使えない状態でした。");
                } else if (status == google.maps.GeocoderStatus.UNKNOWN_ERROR) {
                    alert("原因不明のエラーが発生しました。");
                }
            }
        );
    }

    // 距離の取得
    function getDistance() {

        // 入力された観光地の緯度経度の取得
        var spot_lngInput = document.getElementById('spot_lng').value;
        var spot_latInput = document.getElementById('spot_lat').value;
        var parking_lng = document.getElementById('lng').value;
        var parking_lat = document.getElementById('lat').value;
        
        //  観光地と駐車場の緯度経度を格納
        var spot_latlng = new google.maps.LatLng(spot_latInput, spot_lngInput);
        var parking_latlng = new google.maps.LatLng(parking_lat, parking_lng);
        // Distance Matrix api インスタンス化
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: [spot_latlng],
                destinations: [parking_latlng],
                travelMode: 'WALKING',
            }, callback
        );
        
        function callback(response, status) {
            if(status == 'OK') {
                // 距離の取得
                var origins = response.originAddresses;
                for (var i = 0; i < origins.length; i++) {
                    var results = response.rows[i].elements;
                    for (var j = 0; j < results.length; j++) {
                        var distance = results[j].distance.text;
                        break;
                    }
                }
                // 距離をinput valueに入れる
                $('#distance').val(distance);
            }
        }
        document.getElementById("caliculate").classList.add("d-none");
        document.getElementById("confirm_button").classList.remove("d-none");
    }

jQuery(function(){
    
    // 編集画面用-読み込み時に住所の緯度経度を取得する。
    $('#edit_spot').on('change',getLatLng);
    $('.edit_name').on('change',getLatLng);
    $('.edit_address').on('change',getLatLng);
    $('.edit_time_price').on('change',getLatLng);
    $('.edit_capacity').on('change',getLatLng);
    $('.edit_remarks').on('change',getLatLng);
    
    $('#address').on('change', getLatLng);
    // 利用時間と料金を変更時に距離を取得する。
    $('#caliculate').on('click', getDistance);
})