@extends('layout')
@section('content')
<main>
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        @if(Session::get('role') == 0 && Session::get('ban') == 0)
        <div class="d-grid gap-2 my-3"> 
            <a href="{{ route('mypage') }}" type="button" class="btn btn-outline-info fs-3 py-5">マイページ</a>
        </div>
        <div class="d-grid gap-2 my-3"> 
            <a type="button" class="btn btn-outline-info fs-3 py-5" id="serch">駐車場検索</a>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script src="{{ asset('/js/main.js') }}"></script>            
        </div>
        <div class="d-grid gap-2 my-3"> 
            <a href="{{ route('add_parking') }}" type="button" class="btn btn-outline-info fs-3 py-5">駐車場追加</a>
        </div>
        @endif
    </div>
    @if(Session::get('role') == 0 && Session::get('ban') == 0)
    <!-- ユーザー -->
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around d-none" id="prefectures">
        <h4 class="text-start">都道府県を選択</h4>
        <div class="d-grid gap-2 my-3">
            @foreach($prefectures as $prefecture)
            <a type="button" class="btn btn-outline-info fs-3 py-3 {{ $prefecture->id }}">{{ $prefecture->name }}</a>
            @endforeach
        </div>
    </div>
    @elseif(Session::get('role') == 2)
    <!-- ゲスト -->
    <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
        <h4 class="text-start">都道府県を選択</h4>
        <div class="d-grid gap-2 my-3">
            @foreach($prefectures as $prefecture)
            <a type="button" class="btn btn-outline-info fs-3 py-3 {{ $prefecture->id }}">{{ $prefecture->name }}</a>
            @endforeach
        </div>
    </div>
    @endif
    <form method="get" action="{{ route('result_parking') }}" id="spot_form" class="d-none">
        <div class="w-50 text-center mx-auto my-5 d-flex flex-column justify-content-around">
            <h4 class="text-start d-none spot_form_info" id="gunma">群馬県の観光地を選択</h4>
            <h4 class="text-start d-none spot_form_info" id="totigi">栃木県の観光地を選択</h4>
            <h4 class="text-start d-none spot_form_info" id="ibaraki">茨城県の観光地を選択</h4>
            <h4 class="text-start d-none spot_form_info" id="saitama">埼玉県の観光地を選択</h4>
            <h4 class="text-start d-none spot_form_info" id="tokyo">東京県の観光地を選択</h4>
            <h4 class="text-start d-none spot_form_info" id="kanagawa">神奈川県の観光地を選択</h4>
            <h4 class="text-start d-none spot_form_info" id="tiba">千葉県の観光地を選択</h4>
            @foreach($spots as $spot)
            @if($spot->prefecture_id == 1)
            <div class="d-grid gap-2 my-3 d-none spot_form_info gunma">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @elseif($spot->prefecture_id == 2)
            <div class="d-grid gap-2 my-3 d-none spot_form_info totigi">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @elseif($spot->prefecture_id == 3)
            <div class="d-grid gap-2 my-3 d-none spot_form_info ibaraki">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @elseif($spot->prefecture_id == 4)
            <div class="d-grid gap-2 my-3 d-none spot_form_info saitama">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @elseif($spot->prefecture_id == 5)
            <div class="d-grid gap-2 my-3 d-none spot_form_info tokyo">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @elseif($spot->prefecture_id == 6)
            <div class="d-grid gap-2 my-3 d-none spot_form_info kanagawa">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @elseif($spot->prefecture_id == 7)
            <div class="d-grid gap-2 my-3 d-none spot_form_info tiba">
                <button type="submit" class="btn btn-outline-info fs-3 py-2" value="{{ $spot->id }}" name="spot_id">{{ $spot->name }}</button>
            </div>
            @endif
            @endforeach
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            <script>
                jQuery(function(){
                    // 都道府県ボタンクリック後のアニメーション
                    const speed = 100;
                    // 群馬
                    $('.1').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#gunma').removeClass('d-none');
                        $('.gunma').removeClass('d-none');
                        const position = $('#gunma').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                    // 栃木県
                    $('.2').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#totigi').removeClass('d-none');
                        $('.totigi').removeClass('d-none');
                        const position = $('#totigi').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                    // 茨城県
                    $('.3').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#ibaraki').removeClass('d-none');
                        $('.ibaraki').removeClass('d-none');
                        const position = $('#ibaraki').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                    // 埼玉県
                    $('.4').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#saitama').removeClass('d-none');
                        $('.saitama').removeClass('d-none');
                        const position = $('#saitama').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                    // 東京都
                    $('.5').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#tokyo').removeClass('d-none');
                        $('.tokyo').removeClass('d-none');
                        const position = $('#tokyo').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                    // 神奈川県
                    $('.6').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#kanagawa').removeClass('d-none');
                        $('.kanagawa').removeClass('d-none');
                        const position = $('#kanagawa').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                    // 千葉県
                    $('.7').on('click', function(){
                        $('.spot_form_info').addClass('d-none');
                        $('#spot_form').removeClass('d-none');
                        $('#tiba').removeClass('d-none');
                        $('.tiba').removeClass('d-none');
                        const position = $('#tiba').offset().top;
                        $("html,body").animate({scrollTop:position},speed);
                    });
                });
            </script>
        </div>
    </form>
</main>
@endsection