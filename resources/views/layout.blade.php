<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <title>Wip-Where is a parking?</title>
</head>
<body>
    <header class="bg-info py-5">
        <dvi class="container-mb">
            <div class="row align-items-center justify-content-between text-center lh-lg m-0">
                <div class="col-md-4 text-md-start ms-md-5">
                    <a href="{{ route('logo') }}" class="fs-4 text-light text-decoration-none mb-4">Wip-Where is a parking?</a>
                </div>
                @if(Session::get('role') == 0 && Session::get('ban') == 0)
                <!-- ユーザー -->
                <div class="col-md-5 text-md-end me-5">
                    <!-- ～mdまで表示 -->
                    <a class="text-dark text-decoration-none d-md-none">{{ Session::get('name') }}&nbsp;さん<br></a>
                    <a href="{{ route('login') }}" class="text-light text-decoration-none p-1 d-md-none">ログアウト</a>
                    <!-- md～表示 -->
                    <a class="text-dark text-decoration-none p-1 d-none d-md-inline">{{ Session::get('name') }}&nbsp;さん</a>
                    <a href="{{ route('login') }}" class="text-light text-decoration-none p-1 d-none d-md-inline">ログアウト<br></a>
                    <!-- すべて表示 -->
                    <a href="{{ route('logo') }}" class="text-light text-decoration-none p-1">駐車場を探す</a>
                    <a href="{{ route('mypage') }}" class="text-light text-decoration-none p-1">マイページ</a>
                </div>
                @elseif(Session::get('role') == 1)
                <!-- 管理人 -->
                <div class="col-md-5 text-md-end me-5">
                    <a class="text-dark text-decoration-none p-1">管理人</a>
                    <a href="{{ route('login') }}" class="text-light text-decoration-none p-1">ログアウト</a>
                </div>
                @elseif(Session::get('role') == 2)
                <!-- ゲスト -->
                <div class="col-md-5 text-md-end me-5">
                    <a href="{{ route('guest') }}" class="text-light text-decoration-none p-1">駐車場を探す</a>
                    <a href="{{ route('login') }}" class="text-light text-decoration-none p-1">ログイン</a>
                    <a href="{{ route('sign_up') }}" class="text-light text-decoration-none p-1">新規登録</a>
                </div>
                @endif
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="bg-secondary text-center text-light py-5 mt-5">
        <div>
            <p>2023 &copy;WiP-Where is a parking?</p>
        </div>
    </footer>
    </body>
</html>